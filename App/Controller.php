<?php
namespace App;
class Controller{

    public function __construct(){
        
    }

    protected function render($viewPath,$data){
        View::render($viewPath,$data);
    }

}