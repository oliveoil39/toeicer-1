<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    //
    //ログイン画面を表示
    public function showLogin()
    {
        return view('login.top');
    }

    public function newLogin()
    {
        return view('login.newLog');
    }
    //ユーザを新規登録
    public function register(UserRequest $request){
        
        $request['password'] = Hash::make($request['password']);
            
        $inputs = $request->all();
        
        DB::beginTransaction();
        try{
            User::create($inputs);
            DB::commit();
        } catch(\Throwable $e) {
            DB::rollback();
            echo $e->getMessage();
        }

        return view('login.completeLog');
    }
    //ログイン処理
    public function login(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required | max:50' 
        ]);

        $credentials = $request->only('email','password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('myPage')->with('login_success','ログイン成功しました!');
        }

        return back()->with([
            'login_error' => 'メールアドレスかパスワードが間違っています。',
        ]);

       

    }
    //ログアウト処理
        public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('loginForm')->with('logout','ログアウトしました');;
    }
    //パス再設定画面表示
    public function reset()
    {
        return view('reset.email_form');
    }
    //パス再設定処理
    public function resetRegister(Request $request)
    {   
        $request->validate([
        'email' => 'required|email',
        'password' => 'required | max:50' 
        ]);
        
        $user = User::where('email', '=', $request['email'])->first();
        if ($user === null) {
            return back()->with([
                'reset_error' => 'そのメールアドレスは登録されていません',
            ]);
        }
        $request['password'] = Hash::make($request['password']);
        
        $user->password = $request['password'];
        $user->save();
        
        return view('reset.send_complete');
    }

    //ユーザの投稿記録の取得


    
}
