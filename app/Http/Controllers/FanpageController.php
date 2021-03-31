<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fanpage;
use App\Models\App;

class FanpageController extends Controller
{
    public function index(){
        $all_fanpages=Fanpage::all();
        return view('fanpage',compact('all_fanpages'));
    }
    public function statystyki($id){
        $stat=Fanpage::where('fanpage_id',$id)->firstOrFail();
        $app=App::where('app_id', $stat->app_id)->firstOrFail();
        return view('statystyki',compact('stat','app'));
    }
    public function create(){
        $all_apps=App::all();
        return view('create',compact('all_apps'));
    }
    public function store(Request $request){
        $request->validate([
            'nazwa' => 'required',
            'app_id' => 'required',
            'fanpage_id' => 'required',
            'fanpage_token' => 'required',
        ]);
        Fanpage::create($request->all());
        return redirect('/fanpage');
    }
}
