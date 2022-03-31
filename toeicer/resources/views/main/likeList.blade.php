

@extends('layout')
@section('title','TOEICER投稿一覧')

@section('scripts')
<script>
    $(document).ready(function (){
        
        
        fetchLike();
        function fetchLike()
        {
            $.ajax({
                type: "GET",
                url: "/fetch-likes",
                dataType: "json",
                success: function(response) {
                    $('tbody').children().remove();
                    $.each(response.books, function(key, item){
                        console.log(response.books);
                        if(item.book.price === null){
                            item.book.price = 'ー';
                        }
                        if(item.book.part === null){
                            item.book.part = 'ー';
                        }
                        if(item.book.image === null){
                            item.book.image = 'noimage.jpg';
                        }

                        $.ajax({
                            headers: { 
                                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                            },  
                            url: '/isLike', 
                            method: 'POST', 
                            dataType: "json",
                            async: false,
                            data: { 
                                'item_id': item.book.id 
                            },
                            success: function(response) {
                                if(!response.isLike){
                                    $('tbody').append('<tr>\
                                        <td>\
                                        <img src="/img/'+item.book.image+'" class="img-thumbnail img-fluid">\
                                        </td>\
                                        <td class="h5">'+item.book.name+'</td>\
                                        <td>'+item.book.level+'</td>\
                                        <td>'+item.book.part+'</td>\
                                        <td>'+item.book.price+'円</td>\
                                        @auth\
                                        <td><i class="fas fa-heart heart like-toggle" data-book-id="'+item.book.id+'"></i></td>\
                                        @endauth\
                                        @guest\
                                        <td></td>\
                                        @endguest\
                                        <td>'+response.book_likes_count+'</td>\
                                        <td><a href=/detail/'+item.book.id+'"><button type="button" class="detail btn btn-secondary tbn-sm">詳細</button></a></td>\
                                    </tr>')
                                }else{
                                    $('tbody').append('<tr>\
                                        <td>\
                                        <img src="/img/'+item.book.image+'" class="img-thumbnail img-fluid">\
                                        </td>\
                                        <td class="h5">'+item.book.name+'</td>\
                                        <td>'+item.book.level+'</td>\
                                        <td>'+item.book.part+'</td>\
                                        <td>'+item.book.price+'円</td>\
                                        @auth\
                                        <td><i class="fas fa-heart heart like-toggle liked" data-book-id="'+item.book.id+'"></i></td>\
                                        @endauth\
                                        @guest\
                                        <td></td>\
                                        @endguest\
                                        <td>'+response.book_likes_count+'</td>\
                                        <td><a href=/detail/'+item.book.id+'"><button type="button" class="detail btn btn-secondary tbn-sm">詳細</button></a></td>\
                                    </tr>')
                                }
                            }
                        })

                        
                        

                    });
                }
            });

        }

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
<div class="text-center mt-5">
    <h3>Your Select</h3>
</div>

<div class="card my-5">
    <div class="card-header">
        <h4>いいね一覧</h4>
    </div>
    
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="15%">画像</th>
                    <th>参考書名</th>
                    <th>レベル</th>
                    <th>パート</th>
                    <th>販売価格</th>
                    <th></th>
                    <th>♡数</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-center">
                
            </tbody>
        </table>
    </div>
</div>

@endsection
