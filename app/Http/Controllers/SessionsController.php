<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{

    public function __construct(){
        $this->middleware('guest');
    }

    public function create(){
        return view('sessions.create');
    }

    public function destroy(){
        auth() -> logout();
        return redirect()-> home();
    }

    public function store(){
        
        if(! auth() -> attempt(['email' => 'kanishkarj@hotmail.com', 'password' => 'kani'])){
            
            return back() -> withErrors([
                'message' => 'please Check your credentials'
            ]);
        }
        session()->flash('message','succesfully logged in');

        return redirect()->home();
    }
}
