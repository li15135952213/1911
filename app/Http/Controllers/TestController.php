<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function getwxToken(){
        $appid = 'wx815bc65a7b56df0b';
        $appsec = '2c7cd8d787a22618865e1241705cdb23';
        $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsec;
        $cont = file_get_contents($url);
        echo $cont;
    }

}
