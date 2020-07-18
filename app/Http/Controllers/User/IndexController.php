<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Model\UserModel;
use App\Model\TokenModel;
use Illuminate\Support\Str;

class IndexController extends Controller
{
//    //注册
//    public function reg(Request $request){
////       echo '<pre>';print_r($_POST);'</pre>>';
//        $user_name = $request->post('user_name');
//        $email = $request->post('email');
//        $pass = $request->post('pass');
//        $password = $request->post('password');
//
//        $pa = password_hash($pass,PASSWORD_BCRYPT);
//        $data = [
//            'user_name' => $user_name,
//            'email' => $email,
//            'password' => $pa,
//            'reg_time' => time()
//        ];
//
//        //验证email 用户 密码
//        $uid = UserModel::insertGetId($data);
////        var_dump($uid);
//        $response = [
//            'error' => 0,
//            'msg' => 'ok'
//        ];
//        return $response;
//    }
//
//
//    //登录
//    public function login(Request $request){
//        $user_name = $request->post('user_name');
//        $pa = $request->post('pass');
//
//        $u = UserModel::where(['user_name'=>$user_name])->first();
//        if($u){
//            //验证密码
//            if(password_verify($pa,$u->password)){
//                $response = [
//                    'error' => 0,
//                    'msg' => 'ok'
//                ];
//
//            }else{
//                $response = [
//                    'error' => 500001,
//                    'msg' => '密码错误'
//                ];
//            }
//
//
//        }else{
//            $response = [
//                'error' => 400001,
//                'msg' => '用户不存在'
//            ];
//        }
//        return $response;
//    }


    //注册
    public function reg(Request $request)
    {
        $user_name=$request->post('user_name');
        $email=$request->post('email');
        $pass1=$request->post('pass1');
        $pass2=$request->post('pass2');

        //todo  验证用户名  email   密码

        $pass=password_hash($pass1,PASSWORD_BCRYPT);

        $user_info=[
            'user_name'=>$user_name,
            'email'=>$email,
            'password'=>$pass,
            'reg_time'=>time()
        ];
        $uid=UserModel::insertGetId($user_info);
        $response=[
            'errno'=>0,
            'msg'=>"ok"
        ];
        return $response;
    }


    //登录
    public function login(Request $request)
    {
        $user_name=$request->post('user_name');
        $pass=$request->post('password');

        //验证登录信息
        $res=UserModel::where(['user_name'=>$user_name])->first();
        if($res){

            //验证密码
            if(password_verify($pass,$res->password)){

                //生成token
                $token = Str::random(32);

                $exprie_seconds = 3600;//token的有效时间
                $data=[
                    'token' => $token,
                    'uid' => $res->user_id,
                    'expire_at' => time() + $exprie_seconds
                ];

                //入库
                $tid = TokenModel::insertGetId($data);
                $response = [
                    'error' => 0,
                    'msg' => 'ok',
                    'data' => [
                        'token' => $token,
                        'exprie_in' => $exprie_seconds
                    ]
                ];

            }else{
                $response=[
                    'errno'=>50001,
                    'msg'=>'密码错误'
                ];
            }
        }else{
            $response=[
                'errno'=>'40001',
                'msg'=>'用户不存在'
            ];
        }
        return $response;
    }

    //个人中心
    public function center(Request $request){
        //验证是否有token

    }
}
