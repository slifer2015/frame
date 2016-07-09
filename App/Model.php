<?php
namespace App;
class Model{

    private $_db;

    protected $_fields=[];

    protected $_table;

    public function __construct(){
        $this->_initDb();

    }

    private function _initDb(){
        $dbConf=Env::getConnection('mysql');
        $dsn=$dbConf['driver'].':host='.$dbConf['host'].';'.'dbname='.$dbConf['db'].';';
        try{
            $this->_db=new Db($dsn,$dbConf['username'],$dbConf['password']);
        }catch (\PDOException $e){
            die($e->getMessage());
        }
    }

    public function db(){
        return $this->_db;
    }

    public function save(){
        echo "<pre>";
        print_r($this->_fields);
        die();
    }

    public function __set($var,$val){
        if(in_array($var, $this->_fields)){ //the field exists
            $this->_fields[$var]=$val;
        }
    }
}