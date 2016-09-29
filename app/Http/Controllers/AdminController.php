<?php

namespace App\Http\Controllers;

use App\Attend;
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
        $attend->setKeyword($req->input('keyword'));
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
        return view('admin.view', ['data' => $attend]);
    }

    public function ListAttend(){
        $attend = Attend::all();
        return view('admin.list', ['data' => $attend]);

    }

}
