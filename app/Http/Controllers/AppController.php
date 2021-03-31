<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\App;

class AppController extends Controller
{
    public function show(){
        $all_apps=App::all();
        return view('app',compact('all_apps'));
    }
    public function create(){
        return view('create_app');
    }
    public function store(Request $request){
        $request->validate([
            'nazwa' => 'required',
            'app_id' => 'required',
            'app_secret' => 'required',
        ]);
        App::create($request->all());
        return redirect('/aplikacje');
    }
}
