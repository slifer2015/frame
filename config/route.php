<?php
App\Router::register('/salam/ahmad/{ali?}',"IndexController@salam",['method'=>'GET']);
App\Router::register('x/y/{p1}/{p2?}/{p3?}',"IndexController@xy");
App\Router::register('func/{name}/{age?}',function($name,$age=0){
    echo "You are $name and $age years old";
},['method'=>'GET']);