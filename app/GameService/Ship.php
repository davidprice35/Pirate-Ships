<?php

/**
 * Ship Class
 *
 * @version 1.0
 * @author David Price
 */

namespace App\GameService;

class Ship
{

	private $ShipType;
	private $Health;
	private $Attack;
	private $Defence ;

	/**
	 *	Ship - Set up ship with values
	 */
	public function __construct($ShipType,$Health,$Attack,$Defence)
    {
        $this->shipType = $ShipType;
		$this->health = $Health;
		$this->attack = $Attack;
		$this->defence = $Defence;
    }


	/**
	 * Check Ship health. When health is 0 its sunk
	 */
    public function IsShipSunk () : bool
    {
        if($this->health <= 0) {
            return false;
        }
		return true;
    }

}
