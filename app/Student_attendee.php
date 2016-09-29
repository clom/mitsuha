<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student_attendee extends Model
{
    /*
     * $table->increments('id');
     * $table->integer('class_id');
     * $table->string('student_id');
     * $table->string('student_name');
     * $table->string('session');
     * $table->timestamps();
     */
    protected $fillable = [
        'class_id','student_id', 'student_name', 'session',
    ];

    public function getClassId(){
        return $this->class_id;
    }

    public function getStudentId(){
        return $this->student_id;
    }

    public function getStudentname(){
        return $this->student_name;
    }

    public function getSession(){
        return $this->session;
    }

    public function setClassId($id){
        $this->class_id = $id;
    }

    public function setStudentId($id){
        $this->student_id = $id;
    }

    public function setStudentname($name){
        $this->student_name = $name;
    }

    public function setSession($set){
        $this->session = $set;
    }
}
