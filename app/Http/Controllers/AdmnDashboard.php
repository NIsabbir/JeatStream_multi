<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
class AdmnDashboard extends Controller
{
   
    public function dashboard(Request $request){
        if(auth()->user()->hasRole('admin')){
            return redirect()->route('admin.dashboard');
           //return Inertia::render('admin.Dashboard');
        }

        elseif(auth()->user()->hasRole('user')){
            return redirect()->route('user.dashboard');
        }
        
    }
    public function Homeadmin(){
        return view('admin.homeadmin');
    }
  
}
