<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class RegistrationController extends Controller
{
    public function create(){
        return view('registration.create');
    }
    public function store(\App\Http\Requests\RegistrationRequest $request){
        
        $request->persist();

        session()->flash('message','thanks so much for signing uo');

        return redirect()-> home();
    }
}
