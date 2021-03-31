<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show(){
        $all_users=User::all();
        return view('uzytkownicy',compact('all_users'));
    }
}
