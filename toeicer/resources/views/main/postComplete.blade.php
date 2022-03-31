@extends('layout')
@section('title','TOEICERいいね一覧')

@section('content')
<div class="text-center mt-5">
    <h3>投稿が完了しました!</h3>
    <p>「多くの人と高め合い目標の点数を目指して努力」</p>
</div>
<a href="{{ route('postList') }}" class="w-100 btn btn-lg btn-outline-secondary  mt-3">投稿一覧へ</a>
@endsection