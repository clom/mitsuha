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


    public function dashboard(){
        if(Auth::user()->checkAdmin()){
            return view('admin.top');
        } else{
            return abort(403, 'Forbitten!');
        }

    }

}
