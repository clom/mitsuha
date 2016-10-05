<?php

namespace App\Http\Controllers;

use App\Student_attendee;
use Illuminate\Http\Request;

use App\Attend;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Response;
use App\Http\Requests;

class AttendController extends Controller
{

    public function __construct()
    {
    }


    public function index()
    {
        $attend = Attend::where('available', 1)->get();
        $value = Cookie::get('student_class');
        $length = 6;
        if ($value == null) {
            $value = substr(base_convert(md5(uniqid()), 16, 36), 0, $length);
        }

        //$cookie = Cookie::make('student_class', $value , 300);
        //return view('index', ['data' => $attend])->withCookie($cookie);
        $response = new Response(view('index', ['data' => $attend]));
        $response->withCookie(Cookie('student_class', $value , 300));
        return $response;
    }

    public function attend($id)
    {
        if(Attend::where('id', $id)->where('available', true)->exists()){
            $attend = Attend::find($id);
        }
        else{
            return redirect('/');
        }
        $attendee = Student_attendee::where('class_id', $id)->get();
        $value = Cookie::get('student_class');

        if($value == null)
            return redirect('/');
        if(Student_attendee::where('class_id', $id)->where('session', $value)->exists()){
            $flag = true;
        } else{
            $flag = false;
        }

        return view('view', ['data' => $attend, 'st_code' => $value, 'student' => $attendee, 'flag' => $flag]);

    }

    public function register(Requests\AttendeeRequest $req){
        $attend = new Student_attendee();
        $attend_class = Attend::find($req->input('class_id'));
        $attend->setStudentId($req->input('student_id'));
        $attend->setClassId($req->input('class_id'));
        $attend->setStudentname($req->input('student_name'));
        $attend->setSession($req->input('session_code'));
        if($attend_class->getKeyword() == $req->input('keyword'))
            $attend->save();
        else
            return redirect('/attend/'.$req->input('class_id'));

        return redirect('/attend/'.$req->input('class_id'));
    }

    public function getAttend($id){
        if(Attend::where('id', $id)->where('available', true)->exists()){
            $attendee = Student_attendee::where('class_id', $id)->get();
        }
        else{
            return abort(404, 'Not Found');
        }
        return response()->json($attendee);
    }

}
