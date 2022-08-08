<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BasicSalaryController extends Controller
{
    public function index(){
        return view('admin.salary.basic-salary.index');
    }
}
