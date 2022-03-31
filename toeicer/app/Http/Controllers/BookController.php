<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Like;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BookRequest;

use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    //投稿をデータベースに登録
    public function register(BookRequest $request){
        
        $inputs = $request->all();
        
        
            if ($file = $request->image) {
                $fileName = time() . $file->getClientOriginalName();
                $target_path = public_path('img/');
                $file->move($target_path, $fileName);

                $inputs['image'] = $fileName;
            } else {
                $fileName = "";
            }
        

    
        DB::beginTransaction();
        try{
            Book::create($inputs);
            DB::commit();
        } catch(\Throwable $e) {
            DB::rollback();
            echo $e->getMessage();
        }

        return view('main.postComplete');
        
    }

    public function fetchBook(){

        $books = Book::withCount('likes')->orderBy('likes_count', 'desc')->get();
        $isAuth = false;
        if(Auth::user()){
            $isAuth = true;
        }
        
        return response()->json([
            'books' => $books,
            'isAuth' => $isAuth,
        ]);
    }

    public function search($category){
        
        switch ($category) {
            
            case '1':
                $category = '初学者';
            break;
            case '2':
                $category = '目標点数:600点';
            break;
            case '3':
                $category = '目標点数:750点';
            break;
            case '4':
                $category = '目標点数:850点';
            break;
            case '5':
                $category = '目標点数:950点';
            break;
        }
        $books = Book::withCount('likes')->where('level', $category)->orderBy('likes_count', 'desc')->get();
       
        $isAuth = false;
        if(Auth::user()){
            $isAuth = true;
        }

        return response()->json([
            'books' => $books,
            'isAuth' => $isAuth,
        ]);
    }
    
    

    public function viewDetail($id){
        
        $book = Book::find($id);

        if(is_null($book)) {
            return redirect(route('postList'));
        }

        $user_name = $book->user->name;

        $isLike = false;
        if(Auth::user()){
            $like = new Book;
            if($like->isLikedBy(Auth::user()->id, $id)){
                $isLike = true;
            }
        }
        return view('main.detail', ['book' => $book, 'user_name' => $user_name, 'isLike' => $isLike,]);
    }

    public function like(Request $request){
           
        $user_id = Auth::user()->id;
        $book_id = $request->book_id; 
        $already_liked = Like::where('user_id', $user_id)->where('book_id', $book_id)->first(); 

        if (!$already_liked) { 
            $like = new Like; 
            $like->book_id = $book_id; 
            $like->user_id = $user_id;
            $like->save();
        } else { 
            Like::where('book_id', $book_id)->where('user_id', $user_id)->delete();
        }
        
        $book_likes_count = Book::withCount('likes')->findOrFail($book_id)->likes_count;
        $param = [
            'book_likes_count' => $book_likes_count,
        ];
        return response()->json($param); 
    }

    public function fetchLike(){
       
        $user = Auth::user();
        $books = Like::with('book')->where('user_id', $user->id)->get(); 
        
        return response()->json([
            'books' => $books,
        ]);
    }

    public function postList(){
        $nice = Book::withCount('likes');

        return view('main.postList',[
            'nice' => $nice
        ]);
    }

    public function isLike(Request $request){

        $user_id = Auth::user()->id;
        $book_id = $request->item_id;
        $book = new Book;
        $isLike = $book->isLikedBy($user_id, $book_id);
        
        $book_likes_count = Book::withCount('likes')->findOrFail($book_id)->likes_count;
        return response()->json([
            'isLike' => $isLike,
            'book_likes_count' => $book_likes_count,
        ]);
    }

}
