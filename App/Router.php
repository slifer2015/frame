<?php
namespace App;
class Router{

    private static $_routes=[];

    public static function route($url){

        $actionPart=self::checkRoute($url);
        
        if($actionPart!==false){
            //check if the action is callable function
            if(is_callable($actionPart['action'])){
                call_user_func_array($actionPart['action'],$actionPart['params']);
            }else{
                $actionNamePart=explode('@',$actionPart['action']);
                $className=$actionNamePart[0]; //controller name (class name)
                $methodName=$actionNamePart[1]; //method name (function)

                $params=$actionPart['params'];
                $className="App\\Controllers\\".$className;
                $ctrl=new $className;
                if(method_exists($ctrl,$methodName)){ //we check if the method exists
                    call_user_func_array([$ctrl,$methodName], $params);
                }else{ //the method not exists in the class
                    echo "Method <b>{$methodName}</b> not exists in <b>{$className}</b>";
                    exit();
                }
            }

        }else{
            echo "no match routes";
            exit();
        }
    }

    private static function checkRoute($url){

        foreach (self::$_routes as $name=>$config){
            if(ltrim($name,'/')===rtrim(substr($url,0,strlen($name)),'/')){ //the route name exists in the url;

                //we count the route param
                $optionalRouteParamCount=0;
                $strictRouteParamCount=0;
                foreach ($config['params'] as $key=>$configParam){
                    if(substr($configParam,-1)==='?'){ //the param is optional
                        $optionalRouteParamCount++;
                    }else{
                        $strictRouteParamCount++;
                    }
                }

                //now we find count of url params
                $urlParamPart = trim(substr($url,strlen($name)),'/');
                if(strlen($urlParamPart)>0){
                    $urlParamArray=explode('/',$urlParamPart);
                    $urlParamCount=count($urlParamArray);
                }else{
                    $urlParamCount=0;
                    $urlParamArray=[];
                }
                
                //now we check the url param VS route param
                if($urlParamCount>=$strictRouteParamCount && $urlParamCount<= $strictRouteParamCount+$optionalRouteParamCount && $_SERVER['REQUEST_METHOD']===$config['method']){
                    //return the url params
                    unset($config['params']);
                    $config['params']=$urlParamArray;
                    return $config;
                }
            }
        }
        return false;
    }

    public static function register($route,$routeAction,$option=[]){
        preg_match_all('/^([^{]+)\//',$route,$matches);
        $rName=isset($matches[1][0]) ? $matches[1][0] : $route; //the route url
        $rParams=[];
        if($rName!==$route){
            preg_match_all('/\/{([^}]+)}/U',$route,$matches);
            $rParams=$matches[1];
        }
        if(is_array($option) && count($option) > 0){
            $method=array_key_exists('method',$option) ? $option['method'] : 'GET';
        }else{
            $method='GET';
        }
        self::$_routes[$rName]=[
          'action'=>$routeAction,
            'params'=>$rParams,
            'method'=>$method
        ];
    }
}