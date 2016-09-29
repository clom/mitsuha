<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Attend;
use App\Http\Requests;

class AttendController extends Controller
{

    public function __construct()
    {
    }


    public function index()
    {
        $attend = Attend::where('available', 1)->get();
        return view('index', ['data' => $attend]);
    }

    public function attend($id)
    {

    }

}
