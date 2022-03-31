

@extends('layout')
@section('title','TOEICER投稿一覧')

@section('scripts')
<script>
    $(document).ready(function (){
        
        $('#js-category-select').on('change', function(){
            console.log('unko');
            var category = $(this).val();
            if(category == 0){
                fetchBook();
            }else{
                fetchCertainBook(category);
            }
        });
        function fetchCertainBook(category)
        {   
            $.ajax({
                type: "GET",
                url: "/fetchCertainBooks/"+category,
                dataType: "json",
                success: function(response) {
                    $('tbody').children().remove();
                    $.each(response.books, function(key, item){
                       
                        if(item.price === null){
                            item.price = 'ー';
                        }
                        if(item.part === null){
                            item.part = 'ー';
                        }
                        if(item.image === null){
                            item.image = 'noimage.jpg';
                        }
                        if(!response.isAuth){
                            $('tbody').append('<tr>\
                                        <td>\
                                        <img src="/img/'+item.image+'" class="img-thumbnail img-fluid">\
                                        </td>\
                                        <td class="h5">'+item.name+'</td>\
                                        <td>'+item.level+'</td>\
                                        <td>'+item.part+'</td>\
                                        <td>'+item.price+'円</td>\
                                        <td><a href=/detail/'+item.id+'"><button type="button" class="detail btn btn-secondary tbn-sm">詳細</button></a></td>\
                                    </tr>')
                        }else{
                            
                        $.ajax({
                            headers: { 
                                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                            },  
                            url: '/isLike', 
                            method: 'POST', 
                            dataType: "json",
                            async: false,
                            data: { 
                                'item_id': item.id 
                            },
                            success: function(response) {
                                console.log(response.isLike);
                                if(!response.isLike){
                                    $('tbody').append('<tr>\
                                        <td>\
                                        <img src="/img/'+item.image+'" class="img-thumbnail img-fluid">\
                                        </td>\
                                        <td class="h5">'+item.name+'</td>\
                                        <td>'+item.level+'</td>\
                                        <td>'+item.part+'</td>\
                                        <td>'+item.price+'円</td>\
                                        @auth\
                                        <td><i class="fas fa-heart heart like-toggle" data-book-id="'+item.id+'"></i></td>\
                                        @endauth\
                                        @guest\
                                        <td></td>\
                                        @endguest\
                                        <td>'+response.book_likes_count+'</td>\
                                        <td><a href=/detail/'+item.id+'"><button type="button" class="detail btn btn-secondary tbn-sm">詳細</button></a></td>\
                                    </tr>')
                                }else{
                                    $('tbody').append('<tr>\
                                        <td>\
                                        <img src="/img/'+item.image+'" class="img-thumbnail img-fluid">\
                                        </td>\
                                        <td class="h5">'+item.name+'</td>\
                                        <td>'+item.level+'</td>\
                                        <td>'+item.part+'</td>\
                                        <td>'+item.price+'円</td>\
                                        @auth\
                                        <td><i class="fas fa-heart heart like-toggle liked" data-book-id="'+item.id+'"></i></td>\
                                        @endauth\
                                        @guest\
                                        <td></td>\
                                        @endguest\
                                        <td>'+response.book_likes_count+'</td>\
                                        <td><a href=/detail/'+item.id+'"><button type="button" class="detail btn btn-secondary tbn-sm">詳細</button></a></td>\
                                    </tr>')
                                }
                            }
                        })
                        }


                        
                    });
                }
            });

        }
        fetchBook();
        function fetchBook()
        {
            $.ajax({
                type: "GET",
                url: "/fetch-books",
                dataType: "json",
                success: function(response) {
                    console.log('------')
                    $('tbody').children().remove();
                    $.each(response.books, function(key, item){
                        console.log(item);
                        if(item.price === null){
                            item.price = 'ー';
                        }
                        if(item.part === null){
                            item.part = 'ー';
                        }
                        if(item.image === null){
                            item.image = 'noimage.jpg';
                        }
                        
                        if(!response.isAuth){
                            $('tbody').append('<tr>\
                                        <td>\
                                        <img src="/img/'+item.image+'" class="img-thumbnail img-fluid">\
                                        </td>\
                                        <td class="h5">'+item.name+'</td>\
                                        <td>'+item.level+'</td>\
                                        <td>'+item.part+'</td>\
                                        <td>'+item.price+'円</td>\
                                        <td><a href=/detail/'+item.id+'"><button type="button" class="detail btn btn-secondary tbn-sm">詳細</button></a></td>\
                                    </tr>')
                        }else{
                            
                            
                            $.ajax({
                                headers: { 
                                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                                },  
                                url: '/isLike', 
                                method: 'POST', 
                                dataType: "json",
                                async: false,
                                data: { 
                                    'item_id': item.id 
                                },
                                success: function(response) {
                                    console.log(item);
                                    if(!response.isLike){
                                        $('tbody').append('<tr>\
                                            <td>\
                                            <img src="/img/'+item.image+'" class="img-thumbnail img-fluid">\
                                            </td>\
                                            <td class="h5">'+item.name+'</td>\
                                            <td>'+item.level+'</td>\
                                            <td>'+item.part+'</td>\
                                            <td>'+item.price+'円</td>\
                                            @auth\
                                            <td><i class="fas fa-heart heart like-toggle" data-book-id="'+item.id+'"></i></td>\
                                            @endauth\
                                            <td class="like-counter">'+response.book_likes_count+'</td>\
                                            <td><a href=/detail/'+item.id+'"><button type="button" class="detail btn btn-secondary tbn-sm">詳細</button></a></td>\
                                        </tr>')
                                    }else{
                                        $('tbody').append('<tr>\
                                            <td>\
                                            <img src="/img/'+item.image+'" class="img-thumbnail img-fluid">\
                                            </td>\
                                            <td class="h5">'+item.name+'</td>\
                                            <td>'+item.level+'</td>\
                                            <td>'+item.part+'</td>\
                                            <td>'+item.price+'円</td>\
                                            @auth\
                                            <td><i class="fas fa-heart heart like-toggle liked" data-book-id="'+item.id+'"></i></td>\
                                            @endauth\
                                            <td>'+response.book_likes_count+'</td>\
                                            <td><a href=/detail/'+item.id+'"><button type="button" class="detail btn btn-secondary tbn-sm">詳細</button></a></td>\
                                        </tr>')
                                    }
                                }
                            });
                           
                            
                            
                        
                        }
                        console.log('一回修了')
                        

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
<div class="text-center mt-5">
    <h3>Recommend Page</h3>
</div>
<div class="card my-5">
    <div class="card-header">
        <h4>投稿一覧</h4>
    </div>

    <div class="w-20 text-center">
        <select name="position" id="js-category-select" class="select-box mx-3 my-3">
            <option value="0">全ての学習者</option>
            <option value="1">初学者</option>
            <option value="2">目標点数:600点</option>
            <option value="3">目標点数:750点</option>
            <option value="4">目標点数:850点</option>
            <option value="5">目標点数:999点</option>
        </select>
    </div>
    <div class="my-1 text-center text-muted"><h6>*いいね数は再リロードで反映します</h6></div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="15%">画像</th>
                    <th>参考書名</th>
                    <th>レベル</th>
                    <th>パート</th>
                    <th>販売価格</th>
                    @if(Auth::user())
                    <th></th>
                    <th>♡数</th>
                    @endif
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-center">
                
            </tbody>
        </table>
    </div>
</div>

@endsection
