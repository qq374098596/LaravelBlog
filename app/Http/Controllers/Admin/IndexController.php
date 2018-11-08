<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Model\User;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //测试数据库连接
        // $pdo = DB::connection()->getPdo();
        // dd($pdo);
        //dd(session('admin'));
        // if (!session('admin')) {
        //     return redirect('login');
        // }
        return view('admin.index');
    }

    public function pass()
    {
        if ($input = Input::all()) {
            //dd($input);
            $rules = [
                'password'=>'required|between:6,20|confirmed',
            ];
            $message = [
                'password.required'=>'新密码不能为空',
                'password.between'=>'新密码必须6-20位',
                'password.confirmed'=>'新密码和确认密码不一致',
            ];

            $valid = Validator::make($input,$rules,$message);
            //dd($valid);
            if ($valid->passes()) {
                $user = User::first();
                //dd($user);
                //$_pass = Crypt::decrypt($user->password);
                // echo $_pass;
                if (Crypt::decrypt($user->password) == $input['password_o']) {
                    $user->password = Crypt::encrypt($input['password']);
                    $user->update();
                    return redirect('/');
                }else{
                    return back()->with('errors','原密码错误');
                }
            }else{
                return back()->withErrors($valid);
            }
        }else{
            return view('admin.pass');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
