<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>フォームテスト</title>
</head>
<body>
  <form method="POST" action="{{ route('register.step1.post') }}">
    @csrf
    <label>名前</label>
    <input type="text" name="name"><br>

    <label>メール</label>
    <input type="email" name="email"><br>

    <label>パスワード</label>
    <input type="password" name="password"><br>

    <button type="submit">送信</button>
  </form>
</body>
</html>
