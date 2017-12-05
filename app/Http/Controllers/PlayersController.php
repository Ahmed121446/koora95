<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\player as Player;

class PlayersController extends Controller
{
    
    public function create()
    {
       	Player::create(Request::all());
    }
}
