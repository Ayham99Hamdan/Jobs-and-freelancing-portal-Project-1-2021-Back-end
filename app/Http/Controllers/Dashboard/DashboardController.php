<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Company;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index(){
      $admin_count = Admin::all()->count();
      $user_count = User::all()->count();   
      $post_count = Post::all()->count();   
      $post_count_approved = Post::where('is_approved' , 1)->count();   
      $post_count_unapproved = Post::where('is_approved' , 0)->count();   
    return view('Dashboard.index' , compact(
      [
      'admin_count',
      'user_count',
      'post_count',
      'post_count_approved',
      'post_count_unapproved', ])); 
   }
}
