<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index(){
      $admin_count = Admin::all()->count();
      $user_count = User::all()->count();   
    return view('Dashboard.index' , compact(['admin_count' , 'user_count'])); 
   }
}
