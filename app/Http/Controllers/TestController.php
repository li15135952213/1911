<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//引入guzzle类
use GuzzleHttp\Client;
use Illuminate\Support\Str;

class TestController extends Controller
{
//获取access_token方法
    public function getwxToken(){
        $appid = 'wx815bc65a7b56df0b';
        $appsec = '2c7cd8d787a22618865e1241705cdb23';
        $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsec;
        $cont = file_get_contents($url);
        echo $cont;
    }

//使用curl获取access_token
    public function getwxToken2(){
        $appid = 'wx815bc65a7b56df0b';
        $appsec = '2c7cd8d787a22618865e1241705cdb23';
        $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsec;

        //创建一个新的CURL资源
        $ch = curl_init();

        //设置URL和相应的选项
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

        //抓取url并把它传递给浏览器
        $response  = curl_exec($ch);

        //关闭CURL资源，并释放系统资源
        curl_close($ch);

        echo $response;

    }

//使用Guzzle获取access_token
    public function getGuzzleToken(){
        //appid
        $appid = 'wx815bc65a7b56df0b';
        //appsecret
        $appsec = '2c7cd8d787a22618865e1241705cdb23';
        //获取access_token的接口
        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsec;
        //实例化guzzle
        $client = new Client();
        //发送请求
        $response = $client->request('GET',$url);
        //获取响应的主体部分
        $body = $response->getBody();
        //打印 输出
        echo $body;
    }

    //自己生成token
    public function getAccessToken(){
        $token = Str::random(32);
        echo $token;

        $data=[
            'token' => $token,
            'expire_in' => 7200
        ];
        echo json_encode($data);
    }
}
