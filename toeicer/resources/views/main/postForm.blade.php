@extends('layout')
@section('title','TOEICER投稿画面')

@section('content')
<div class="text-center mt-5">
    <h3>Post Form</h3>
</div>
<form class="first_form" method="post" action="{{ route('postRegister') }}" class="w-75 mx-auto" enctype="multipart/form-data">
    @csrf

    <input type="hidden" value="{{ Auth::user()->id }}" id="user_id" name="user_id" enctype="multipart/form-data">

    <div class="mb-3">
        <label class="form-label">参考書名<span class="badge bg-secondary mx-2">必須</span></label>
        <input type="text" class="form-control" value="{{ old('name')}}" id="name" name="name">
        <div id="textHelp" class="form-text">なるべく正確に書いてください。</div>
        @if($errors->has('name'))
            <div class="text-danger">
                {{ $errors->first('name') }}
            </div>
        @endif
    </div>

    
    <div class="mb-3">
        <label class="form-label">レベル<span class="badge bg-secondary mx-2">必須</span></label>
        <select class="form-select" aria-label="Default select example" name="level">
        <option selected></option>
        
        <option value="初学者">初学者</option>
        <option value="目標点数:600点">目標点数:600点</option>
        <option value="目標点数:750点">目標点数:750点</option>
        <option value="目標点数:850点">目標点数:850点</option>
        <option value="目標点数:999点">目標点数:999点</option>
        </select>
        <div id="emailHelp" class="form-text">分からない場合は、この参考書を使った時の自分の点数にしてください。</div>
        @if($errors->has('level'))
            <div class="text-danger">
                {{ $errors->first('level') }}
            </div>
        @endif
    </div>

    <div class="mb-3">
        <label class="form-label">対象パート</label>
        <select class="form-select" aria-label="Default select example" name="part">
        <option selected></option>
        <option value="単語帳">単語帳</option>
        <option value="L&R">L&R</option>
        <option value="リスニング">リスニング</option>
        <option value="リーディング">リーディング</option>
        <option value="part1.2">part1.2</option>
        <option value="part3.4">part3.4</option>
        <option value="part5.6">part5.6</option>
        <option value="part7">part7</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">取組期間</label>
        <input type="text" class="form-control" value="{{ old('period')}}" id="period" name="period">
        <div id="textHelp" class="form-text">取り組んだ日数や何周したなど</div>
    </div>

    <div class="mb-3">
    <label class="form-label">写真</label>
    
        <div>
            <input class="form-control me-3" name="image" type="file" id="formFile">
            </div>
    </div>

    <div class="mb-3">
        <label class="form-label">販売URL</label>
        <input type="text" class="form-control" name="url" value="{{ old('url')}}">
        <div id="textHelp" class="form-text">メルカリやヤフオクで自分が販売しているURLを添付してください。</div>
        @if($errors->has('url'))
            <div class="text-danger">
                {{ $errors->first('url') }}
            </div>
        @endif
    </div>
    <div class="mb-3">
        
        <label class="form-label">販売価格</label>
        <div class="input-group">
        <input type="text" class="form-control" name="price" value="{{ old('price')}}"><span class="input-group-text" id="basic-addon1">円</span>
        </div>
        <div id="textHelp" class="form-text">販売している場合、半角数字で価格を記載してください。</div>
        @if($errors->has('price'))
            <div class="text-danger">
                {{ $errors->first('price') }}
            </div>
        @endif
    </div>

    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">レビュー</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="review"></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">投稿</button>
</form>
@endsection