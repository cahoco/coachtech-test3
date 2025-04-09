<?php

namespace App\Http\Controllers;

use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\WeightLogRequest;
use Illuminate\Http\Request;

class WeightLogController extends Controller
{
    public function index(Request $request)
{
    $user = Auth::user();
    $latestLog = $user->weightLogs()->orderBy('date', 'desc')->first();
    $target = $user->weightTarget;
    $difference = ($target && $latestLog)
        ? round($latestLog->weight - $target->target_weight, 1)
        : null;
    $logs = $user->weightLogs()->orderBy('date', 'desc')->paginate(8);

    $modal = $request->query('modal');

    return view('weight_logs.index', compact(
        'user', 'latestLog', 'target', 'difference', 'logs', 'modal'
    ));
}

    public function store(WeightLogRequest $request)
    {
        $validated = $request->validated();
        WeightLog::create([
            'user_id' => Auth::id(),
            'date' => $validated['date'],
            'weight' => $validated['weight'],
            'calories' => $validated['calories'],
            'exercise_time' => $validated['exercise_time'],
            'exercise_content' => $validated['exercise_content'] ?? null,
        ]);
        return redirect('/weight_logs?modal=open')
            ->with('success', '体重ログを追加しました！');
    }

    public function create()
    {
        $today = date('Y-m-d');
        return view('weight_logs.show', [
            'log' => null,
            'today' => $today,
        ]);
    }

    public function show($id)
    {
        $log = WeightLog::where('user_id', Auth::id())->findOrFail($id);
        return view('weight_logs.show', compact('log'))
            ->with('page', request()->query('page'));
    }

    public function update(WeightLogRequest $request, $id)
    {
        $log = WeightLog::where('user_id', Auth::id())->findOrFail($id);
        $log->update($request->validated());
        $page = $request->input('page');
        return redirect('/weight_logs' . ($page ? '?page=' . $page : ''))
            ->with('success', '体重ログを更新しました');
    }

    public function goalSetting(Request $request)
    {
        $user = Auth::user();
        if ($request->isMethod('post')) {
            $request->validate([
                'target_weight' => ['required', 'numeric', 'between:10,300'],
            ]);
            $target = $user->weightTarget;
            if ($target) {
                $target->update(['target_weight' => $request->target_weight]);
            } else {
                WeightTarget::create([
                    'user_id' => $user->id,
                    'target_weight' => $request->target_weight,
                ]);
            }
            return redirect('/weight_logs')->with('success', '目標体重を更新しました！');
        }
        $target = $user->weightTarget;
        return view('weight_logs.goal_setting', compact('target'));
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $start = $request->input('start_date');
        $end = $request->input('end_date');
        $query = $user->weightLogs()->orderBy('date', 'desc');

        if ($start && $end) {
            $query->whereBetween('date', [$start, $end]);
        }

        $logs = $query->paginate(8);
        $target = $user->weightTarget;
        $latestLog = $user->weightLogs()->orderBy('date', 'desc')->first();
        $difference = ($target && $latestLog)
            ? round($latestLog->weight - $target->target_weight, 1)
            : null;

        $modal = $request->query('modal');

        return view('weight_logs.index', compact(
            'logs', 'target', 'latestLog', 'difference', 'start', 'end', 'modal'
        ));
    }
}
