<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOEICERパスワード再設定</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/login.css">
    <script src="/js/app.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    
</head>
<body class="text-center">
  <main class="form-signin">
    <form method="POST" action="{{ route('resetComplete') }}">
        @csrf
      <h1>TOEICER</h1>
      <i class="bi bi-sun"></i>
      <h1 class="h3 mb-4 mt-2 fw-normal">パスワード再設定</h1>


      @if(session('reset_error'))
        <div class="alert alert-danger">
          {{ session('reset_error') }}
        </div>
      @endif
      <div class="form-floating">
        <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Emailアドレス</label>

        @error('email')
            <span class="error">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-floating">
        <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="パスワード">
        <label for="floatingPassword">新しいパスワード</label>
        @error('password')
            <span class="error">{{ $message }}</span>
        @enderror
      </div>
      

      <button class="w-100 btn btn-lg btn-outline-secondary mt-3" type="submit">再設定する</button>
      <a href="{{ route('loginForm') }}" class="w-100 btn btn-lg btn-outline-secondary  mt-3">ログイン画面へ戻る</a>
   </form>
  </main>
</body>


</body>
</html>