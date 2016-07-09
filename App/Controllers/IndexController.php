<?php
namespace App\Controllers;
use App\Controller;
use App\Env;
use App\Models\User;
use App\View;

class IndexController extends Controller{

    public function salam($param1='reza'){
        $user=new User();
        $user->name="reza";
        $user->email="shams";
        $user->password="123456";
        $user->save();
    }

    public function xy($param1,$param2){
        echo $param1." ".$param2;
    }

}