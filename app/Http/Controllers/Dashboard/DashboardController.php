<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Company;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index(){
      $admin_count = Admin::all()->count();
      //dd(auth()->user()->getAllPermissions()->toArray());    
    return view('Dashboard.index' , compact(['admin_count'])); 
   }
}
