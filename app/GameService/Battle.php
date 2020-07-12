<?php

/**
 * Battle
 *
 * @version 1.0
 * @author David Price
 */


namespace App\GameService;

class Battle
{

	//Ship damage types
	private const ship_damage = [
		[
		   'name' => 'hit',
		   'chance' => 65,
		   'damage' => 1
	   ],
	   [
		   'name' => 'miss',
		   'chance' => 25,
		   'damage' => 0
	   ],
	   [
		   'name' => 'lucky_shot',
		   'chance' => 10,
		   'damage' => 3
	   ],

   ];

	/**
	 * Play the Game
	 * @param	int $ship1 - attack
	 * @param	int $ship2 - defence
	 * @return	array
	 */
	public static function Play($ship1, $ship2, array $shipImpactTypes = null)
    {
        try {

            if(!self::canShipsBattle($ship1, $ship2))
			{
                throw new Exception('Ship is sunk. Game Over');
            }

			//Create damage value
            $damageValue = self::CreateDamageValue($ship1->attack, $ship2->defence);

			//Generate damage of ship
            $shipDamage = self::attackType(Self::ship_damage);

			//Caculate ship damage
            $damageOnShip = self::MakeDamage($damageValue, $shipDamage['damage'],$ship2);

            return ['ship_impact' => $shipDamage, 'damage_control' => $damageOnShip];

        }
		catch (Exception $e) {
            return $e->getMessage();
        }
    }

	/**
	 * Check if both ships are able to battle
	 * @param	$ship1
	 * @param	$ship2
	 * @throws	Exception
	 * @return	bool
	 */
    public static function canShipsBattle($ship1, $ship2)
    {
		//Check health of ship
        if (!$ship1->IsShipSunk() || !$ship2->IsShipSunk())
		{
            return false;
        }

        return true;
    }

	/**
	 * Generates attack type
	 * @param	array $availableAttackTypes
	 * @return	array
	 */
    public static function attackType(array $availableAttackTypes) : array
    {
		$startChanceValue = 0;
        $currentChance = 0;

		// random number 0 to 100
        $rand_number = rand(0, 100);

        // check random number
        foreach ($availableAttackTypes as $availableAttackType)
		{
			//Get chance value
            $currentChance += $availableAttackType['chance'];

            if ($rand_number >= $startChanceValue && $rand_number <= $currentChance)
			{
                return $availableAttackType;
            }

            $startChanceValue += $availableAttackType['chance'];
        }

    }	   	  

	/**
	 * Create Ship Damage
	 * @param	int	$attackShip
	 * @param	int	$defenceShip
	 * @param	return int
	 */
    public static function CreateDamageValue(int $attackShip, int $defenceShip)
    {
        if($attackShip <= 0)
		{
            return 0;
        }

        $defence_health = round($defenceShip / 2, 0);

        // Ship damage can not be negative
        return max($attackShip - $defence_health, 0);
    }


	/**
	 *
	 * Generate ship damage
	 *
	 * @param int $damage
	 * @param float $damageValue
	 * @param Ship
	 * @return ship
	 */
    public static function MakeDamage(int $damage, float $damageValue , $ship)
    {
        $resultingDamage =  round($damage * $damageValue, 0);

		$ship->health = max($ship->health - $resultingDamage, 0);

        return $ship;
    }

}
