<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class AdminController extends Controller
{
    public function index(){
        $adminList = User::where('role', 'admin')->get();
        /* dd($adminList); */

        return view('admin.index', compact('adminList'));
    }
    
}
