<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReactionResource;
use App\Models\Reaction;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    
    public function index()
    {
        $reactions = Reaction::paginate();
        return new ReactionResource($reactions);
    }


    public function show($id)
    {
        $reaction = Reaction::find($id);
        return new ReactionResource($reaction);
    }


   
}
