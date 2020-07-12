<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;
use App\GameService\Ship;
use App\GameService\Battle;

class CombatTest extends TestCase
{
	
	public function test_ship_health()
	{
	    $shipA = new Ship('offensive',100,15,5);
	    $shipB = new Ship('defensive',100,5,15);

	    $this->assertTrue(Battle::canShipsBattle($shipA,$shipB));

	}

	public function test_ship_when_sunk()
	{
		  $shipA = new Ship('offensive',0,15,5);
		  $shipB = new Ship('offensive',100,15,5);
		  $this->assertFalse(Battle::CanShipsBattle($shipA,$shipB));
	}
}
