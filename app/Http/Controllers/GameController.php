<?php

namespace App\Http\Controllers;

use App\GameService\Ship;
use App\GameService\Battle;


class GameController extends Controller
{

	public function index()
    {

		$shipA = new Ship('attack',100,15,5);
		$shipB = new Ship('defend',100,5,15);

		$response = Battle::Play($shipA,$shipB);

		dd($response);


	}


}
