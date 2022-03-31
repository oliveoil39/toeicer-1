
@extends('layout')
@section('title','TOEICERマイページ')

@section('content')

<div class="text-center mt-5">
    <h3>My Page</h3>
</div>
<div class="card text-center mt-5">
    <div class="card-header">
        ユーザ情報
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">名前: {{ Auth::user()->name }}</li>
        <li class="list-group-item">メールアドレス: {{ Auth::user()->email }}</li>
        
    </ul>
    <form action="{{ route('logout') }}" method="POST">
    @csrf
        <button class="btn btn-outline-secondary mx-3 my-3">ログアウト</button>
    </form>
</div>



@endsection
