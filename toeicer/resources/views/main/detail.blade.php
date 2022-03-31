@extends('layout')
@section('title','TOEICERいいね一覧')

@section('scripts')
<script>
  $(document).ready(function (){
        let like = $('.like-toggle'); 
        let likeBookId;
        
        $(document).on('click', '.heart',function(){
            
            let $this = $(this); 
            likeBookId = $this.data('book-id');
            console.log(likeBookId);

            $.ajax({
            headers: { 
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            },  
            url: '/like', 
            method: 'POST', 
            data: { 
                'book_id': likeBookId 
            },
            })
            //通信成功した時の処理
            .done(function (data) {
                console.log(data.book_likes_count);
            $this.toggleClass('liked'); //likedクラスのON/OFF切り替え。
            })
            //通信失敗した時の処理
            .fail(function () {
            console.log('fail'); 
            });
        });
  });
</script>
@endsection
@section('content')
<div class="text-center my-5">
    <h3>投稿詳細</h3>
</div>

<?php 
$level =$book->level;
$period = $book->period;
$url = $book->url;
$image = $book->image;
?>
<div class="card mb-3">
  <div class="row g-0">
    <div class="col-md-4">
      @if(is_null($image))
      <img src="/img/noimage.jpg" class="img-thumbnail 
      img-fluid mt-3">
      @else
      <img src="/img/{{ $book->image }}" class="img-thumbnail img-fluid mt-3">
      @endif
      @if(is_null($url))
      @else
        <ul class="container">       
            <li class="list-group-item text-center">
                <a href="{{ $book->url }}"><button type="button" class="detail btn btn-secondary tbn-sm">投稿者の販売へ</button></a>
            </li>
            <li class="list-group-item text-center">
                販売価格: {{ $book->price }}円
            </li>
        </ul>
                
      @endif
    </div>
    <div class="col-md-8">
      <div class="card-body"> 

        <div class="card mt-2">
            <div class="card-header lead">
            参考書名: {{ $book->name }}
            </div>

            <ul class="list-group list-group-flush">
                <li class="list-group-item">投稿者: {{ $user_name }}</li>
                <li class="list-group-item">
                    @if(is_null($level))
                    レベル: -
                    @else
                    レベル: {{ $book->level }}
                    @endif
                </li>
                <li class="list-group-item">対象パート: {{ $book->part }}</li>
                <li class="list-group-item">
                    @if(is_null($period))
                    取組期間: -
                    @else
                    取組期間: {{ $book->period }}
                    @endif
                </li>
                
                
            </ul>
    
        </div>
        <div class="mt-3">
        <h4>レビュー:</h4>
        <div class="p-3 border bg-light"><p>{{ $book->review }}</p></div>
        </div>

        @auth
        @if($isLike)
        <div class="mt-3 mx-3">
        <td><i class="fas fa-heart heart like-toggle h2 liked" data-book-id= {{ $book->id }}></i></td>
        </div>
        @else
        <div class="mt-3 mx-3">
        <td><i class="fas fa-heart heart like-toggle h2" data-book-id= {{ $book->id }}></i></td>
        @endif
        @endauth
    
      </div>
    </div>
  </div>
</div>


@endsection