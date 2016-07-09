<?php
namespace App;
class View{

    public static function render($viewPath,$data=[]){
        $viewPath=str_replace('.',DS,$viewPath).VIEWEXTENSION;
        //die($viewPath);
        $loader = new \Twig_Loader_Filesystem(VIEWPATH);
        $twig = new \Twig_Environment($loader);
        echo $twig->render($viewPath,$data);
    }
}