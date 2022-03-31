<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOEICERログイン画面</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/login.css">
    <script src="/js/app.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    
</head>
<body class="text-center">
  <main class="form-signin">
    <form method="POST" action="{{ route('login') }}">
        @csrf
      <h1>TOEICER</h1>
      <i class="bi bi-sun"></i>
      <h1 class="h3 mb-4 mt-2 fw-normal">ログイン画面</h1>
      
      @if(session('login_error'))
        <div class="alert alert-danger">
          {{ session('login_error') }}
        </div>
      @endif
      @if(session('logout'))
        <div class="alert alert-danger">
          {{ session('logout') }}
        </div>
      @endif

      <div class="form-floating">
        <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Emailアドレス</label>
        @if($errors->has('email'))
            <div class="text-danger">
                {{ $errors->first('email') }}
            </div>
        @endif
      </div>
      <div class="form-floating">
        <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="パスワード">
        <label for="floatingPassword">パスワード</label>
        @if($errors->has('password'))
            <div class="text-danger">
                {{ $errors->first('password') }}
            </div>
        @endif
      </div>
      <a href="{{ route('resetForm') }}" class="link-secondary">パスワードを忘れた方はこちら</a>

      
      <button class="w-100 btn btn-lg btn-outline-secondary mt-3" type="submit">ログイン</button>
      <a href="{{ route('newLog') }}" class="w-100 btn btn-lg btn-outline-secondary  mt-3">新規登録をする</a>
      <a href="{{ route('gene_postList') }}" class="w-100 btn btn-lg btn-outline-secondary  mt-3">ログインせずに利用</a>
      <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
   </form>
  </main>

</body>


</body>
</html>