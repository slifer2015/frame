<?php
namespace App;
class Env{
    
    public static $_conf=null;
    
    public static function getConnection($conf){
        self::$_conf['connection']=self::$_conf['connection'][$conf] ? self::$_conf['connection'][$conf] : json_decode(file_get_contents(ROOTPATH.DS.'env'),true)['connection'][$conf];
        return self::$_conf['connection'];
    }
}