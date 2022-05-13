<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $user = Auth::user();
            if( $user->role != 'admin' ){
                return redirect(route('dashboard'));
            }
            return $next($request);
        });
    }


    public function userList(Request $request){
        // $users = User::all();

        $records_on_page = 15;

        if($request->method() == 'GET'){
            $name = $request->name;

            $users = User::orderBy('id', 'desc')
                                ->where('name', 'LIKE', '%'.$name.'%')
                                ->paginate($records_on_page);

        }



        return view('user_list',[
            'users' => $users
        ]);
    }


    public function userForm($id = null){
        $user = null;
        if ($id != null ){
            $user = User::where('id', $id)->first();
        }

        return view('user_form',[
            'user' => $user
        ]);
    }


    public function userSave(Request $request){

        if($request->id){
            $user       = User::find($request->id);
        }
        else{
            $user       = new User();
        }

        if($request->password != ''){
            $user->password = Hash::make($request->password);
        }

        $user->username = $request->username;
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->role     = $request->role;

        $user->save();

        return redirect(route('user.list'))->with('message','Success!');
    }


    public function userDelete(Request $request){
        if( $request->id ){
            User::find($request->id)->delete();
            $message    = 'Success';
            $msg_status = '';
        }else{
            $message    = 'Error!';
            $msg_status = 'error';
        }

        return redirect(route('user.list'))->with('message', $message, $msg_status);
    }
}
