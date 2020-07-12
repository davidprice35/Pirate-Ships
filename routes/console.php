<?php

use Illuminate\Support\Facades\Artisan;

use App\GameService\Ship;
use App\GameService\Battle;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('playgame', function () {

	$shipA = new Ship('attack',100,15,5);
	$shipB = new Ship('defend',100,5,15);

	$response = Battle::Play($shipA,$shipB);

	dd($response);

})->describe('Play Pirate Ships');



