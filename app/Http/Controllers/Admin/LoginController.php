<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use App\Http\Model\User;

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if ($input = Input::all()) {
            //var_dump(\Session::get('code'));die;
            if ($input['code'] != \Session::get('code')) {
                return back()->with('msg','验证码错误！');
            }

            $user = User::first();

            if ($user->name != $input['user_name'] || Crypt::decrypt($user->password) != $input['user_password']) {
                return back()->with('msg','账号/密码错误！');
            }

            session(['admin'=>$user]);
            //var_dump(session('admin.name'));die;
            return redirect('/');
        }else{
            return view('admin.login');
        }
    }

    /**
     * 生成验证码
     * @return [type] [description]
     */
    public function code()
    {
        $phrase = new PhraseBuilder;
        // 设置验证码位数
        $code = $phrase->build(4);
        // 生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder($code, $phrase);
        // 设置背景颜色
        $builder->setBackgroundColor(123, 203, 230);
        $builder->setMaxAngle(25);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        // 可以设置图片宽高及字体
        $builder->build($width = 90, $height = 35, $font = null);
        // 获取验证码的内容
        $phrase = $builder->getPhrase();
        // 把内容存入session
        \Session::flash('code', $phrase);
        // 生成图片
        // header("Cache-Control: no-cache, must-revalidate");
        ob_end_clean();
        header("Content-Type:image/jpeg");
        $builder->output();
    }

    /*
     *加密/解密
     */
    // public function crypt()
    // {
    //     $str = '123456';
    //     $str1 = '54asdsdsaf23123';
    //     $str_p = 'eyJpdiI6Ilhqd0JydXpRRmZON29ZWVRXaVM5UWc9PSIsInZhbHVlIjoibFM3NEJuNFpWak9ReFY1NVI5WjVEUT09IiwibWFjIjoiMzQ1MjQ5ZDBkNWU2M2JmYzQ1YjUzYzgwMjY3NzdlNmI5M2MwOTZmNzExYzkzNjBlYzFlYzFmMTNlOGM0ZDUzNSJ9';
    //     echo Crypt::encrypt($str);
    //     echo "<br/>";
    //     echo Crypt::encrypt($str1);
    //     echo '<br/>';
    //     echo Crypt::decrypt($str_p);
    // }

    /*
     *验证码验证
     */
    // public function getcode(Request $request)
    // {
    //     //var_dump($request->get('captcha'));die;
    //     $userInput = $request->get('captcha');
    //     if (\Session::get('code') == $userInput) {
    //         return 'zhengque';
    //     }else{
    //         return 'cuowu';
    //     }
    //     //var_dump(\Session::get('code'));die;
    // }

    public function quit()
    {
        session(['admin'=>null]);

        return redirect('login');
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
