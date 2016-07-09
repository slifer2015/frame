<?php
namespace App\Models;
use App\Model;

class User extends Model{
    
	public function __construct(){
		$this->_table="users";
		$this->_fields=['name','email','password','id'];
	}

}