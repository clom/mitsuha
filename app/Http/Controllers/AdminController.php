<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Http\Requests;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function isAdmin(){
        $user = Auth::user()->is_admin;
        if($user)
            return true;
        else
            return false;
    }

    public function dashboard(){
        if($this->isAdmin()){
            return view('admin.top');
        } else{
            return abort(403, 'Forbitten!');
        }

    }

}
