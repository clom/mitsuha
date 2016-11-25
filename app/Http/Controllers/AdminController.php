<?php

namespace App\Http\Controllers;

use App\Attend;
use App\Student_attendee;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Http\Requests;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function dashboard(){
        if(Auth::user()->checkAdmin()){
            return view('admin.top');
        } else{
            return abort(403, 'Forbitten!');
        }

    }

    public function addAttend(){
        return view('admin.add');
    }

    public function add(Requests\AttendRequest $req){
        $attend = new Attend();
        $attend->setName($req->input('name'));
        $attend->setKeyword('disable');
        $attend->setUserid(Auth::user()->id);
        if($req->input('available') == 'on')
            $attend->setIsavailable(1);
        else
            $attend->setIsavailable(0);
        $attend->save();

        return redirect('/admin');

    }

    public function available(Requests\AvailableRequest $req){
        $id = $req->input('nameid');
        $attend = Attend::find($id);
        if($attend->isavailable()){
            $attend->setIsavailable(0);
        } else{
            $attend->setIsavailable(1);
        }
        $attend->save();
        return redirect('/admin/view');
    }

    public function viewAttend($id){
        $attend = Attend::find($id);
        $attendee = Student_attendee::where('class_id', $id)->get();
        return view('admin.view', ['data' => $attend, 'student' => $attendee]);
    }

    public function ListAttend(){
        $attend = Attend::all();
        return view('admin.list', ['data' => $attend]);

    }

    public function AdminUser(){
        return view('admin.user');
    }

    public function getUserdata(){
        $user = User::all();
        return response()->json($user);
    }

    public function changeAPI($id){
        $user = User::where('id', $id)->first();
        if(!$user->checkAdmin()) {
            User::where('id', $id)->update(['is_admin' => 1]);
            $msg = "Update Admin";
        } else {
            User::where('id', $id)->update(['is_admin' => 0]);
            $msg = "Update NonAdmin";
        }
        return response()->json($msg);
    }

    public function EditAttendee($id){
        $attend = Student_attendee::find($id);
        return response()->json($attend);
    }

    public function updateAttendee(Requests\AttendeeRequest $req, $id){
        $attend = Student_attendee::find($id);
        if(empty($attend))
            return abort(404, []);
        $attend->setStudentId($req->input('student_id'));
        $attend->setStudentname($req->input('student_name'));
        $attend->save();

        return response()->json([],204);
    }

}
