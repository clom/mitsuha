<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;;


class Attend extends Eloquent
{

    protected $fillable = [
        'name','keyword', 'userid', 'available',
    ];


    public function getName(){
        return $this->name;
    }

    public function getKeyword(){
        return $this->keyword;
    }

    public function getUserid(){
        return $this->userid;
    }

    public function isavailable(){
        return $this->available;
    }

    public function setUserid($userid){
        $this->userid = $userid;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setKeyword($keyword){
        $this->keyword = $keyword;
    }

    public function setIsavailable($flag){
        $this->available = $flag;
    }

}
