<?php

/**
 * Goblin Assault!
 *
 * Goblins are assaulting your homeland and only you can stop them.
 *
 * The player and goblins will attack each other every round. The player gets
 * one attack, while all alive goblins each get their own attacks.
 *
 * Starting with 3 goblins, when a goblin's hit points are consume, they stop
 * attacking.
 */
$player = array(
	'name' => "Player One",
	'description' => "Fresh off the boat, this player won't last long.",
	'power' => 10,
	'defense' => 1,
	'hp' => 25,
);

$items = array(
	'sword' => array(
		'name' => "Sword of the Ancients",
		'description' => "You quested hard for this legendary weapon, and you plan to use it.",
		'power' => 20,
		'defense' => 3,
	),
	'gun' => array(
		'name' => "Gatling Gun of Wisdom",
		'description' => "This high-powered device will lay waste to your enemies, but you'll feel bad about it.",
		'power' => 30,
		'defense' => 2,
	),
	'gundam' => array(
		'name' => "Mega-Zord Power-Zord!",
		'description' => "This titanic humanoid machine can only be piloted by the best. And you're the best!",
		'power' => 10,
		'defense' => 5,
	),
);

/**
 * Three identical goblins
 */
$goblins = array(
	'Nasty Blug' => array(
		'hp' => 12,
		'power' => 8,
		'defense' => 1
	),
	'Evil Gurb' => array(
		'hp' => 12,
		'power' => 8,
		'defense' => 1
	),
	'Sinister Lurg' => array(
		'hp' => 12,
		'power' => 8,
		'defense' => 1
	)
);

// an array of text messages we can display to the user
$messages = array();

// the final result of the battle
$result = "";

// if the player has made a choice, execute the game
if ( isset( $_GET['choice'] ) ) {
	$legal_choices = array_keys( $items );

	if ( in_array( $_GET['choice'], $legal_choices ) ) {
		// get the item chosen by the player and apply its bonuses
		$player_item = $items[ $_GET['choice'] ];

		$player['power'] += $player_item['power'];
		$player['defense'] += $player_item['defense'];

		// keep track of the player and goblins overall status
		$player_is_dead = false;
		$total_goblins = count( $goblins );
		$dead_goblins = 0;

		// we have a player_character and a computer_character,
		// time to make them fight!
		$keep_fighting = true;

		// our game loop doesn't end until the game is over
		while( $keep_fighting ){

			// players attacks once per round
			$player_has_attacked = false;
			$player_attack = rand( 1, $player['power']  );

			foreach ( $goblins as $goblin_name => $goblin ){
				if ( $goblin['hp'] <= 0 ) {
					continue;
				}

				$goblin_attack = rand( 1, $goblin['power'] );

				// defenses are random numbers between 1 and defense
				$player_defense = rand( 1, $player['defense'] );
				$goblin_defense = rand( 1, $goblin['defense'] );

				// determine how much damage (if any) the characters take
				$player_damage = $goblin_attack - $player_defense;
				$goblin_damage = $player_attack - $goblin_defense;

				// if damage is taken, subtract it from the character hp
				if ( $player_damage > 0 ) {
					$player['hp'] -= $player_damage;
					$messages[] = "{$goblin_name} the goblin did {$player_damage} damage to {$player['name']}!  Remaining HP: {$player['hp']}";

					if ( $player['hp'] <= 0 ) {
						$player_is_dead = true;
					}
				}

				if ( ! $player_has_attacked && $goblin_damage > 0 ) {
					$player_has_attacked = true;
					// modify the goblin within the array
					$goblin['hp'] -= $goblin_damage;
					$messages[] = "{$goblin_name} took {$goblin_damage} damage!  Remaining HP: {$goblin['hp']}";

					if ( $goblin['hp'] <= 0 ) {
						$messages[] = "{$player['name']} killed $goblin_name !!!";
						$dead_goblins += 1;

						$messages[] = ( $total_goblins - $dead_goblins ) ." goblins remaining.";
					}
				}

				// update this goblin in the the $goblins array
				$goblins[ $goblin_name ] = $goblin;
			}

			// if a character has zero or less hp, then they are dead
			// and the game is over
			if ( $player_is_dead ) {
				$result = "Oh no! The goblins overwhelmed and defeated {$player['name']}. You must retreat and heal up.";
				$keep_fighting = false;
			}
			else if ( $dead_goblins == $total_goblins ) {
				$result = "Fantastic! {$player['name']} defeated the goblin assault!";
				$keep_fighting = false;
			}
		}
	}
}
?><html>
<body>
	<h1>Goblin Assault!</h1>
	<div>
	<?php
		// if there are messages and a result, show them
		if ( !empty( $messages ) && !empty( $result ) ) {
			?>
			<div>
				<?php foreach( $messages as $message ){ ?>
					<p><?php echo $message;?></p>
				<?php } ?>
			</div>
			<h4><?php echo $result; ?></h4>
			<p><a href="index.php">Play Again</a></p>
			<?php
		}
		// else, the game is ready to be played
		else {
			?>
			<p><strong>Welcome <?php echo $player['name']; ?>!</strong></p>
			<p><em>(<?php echo $player['description']; ?></em>)</p>
			
			<h3>The doom of the goblins is upon us. Time to fight!</h3>
			<form method="get">
				<label>Choose your item: </label>
				<select name="choice">
				<?php foreach ( $items as $key => $item ){ ?>
					<option value="<?php echo $key; ?>"><?php echo $item['name']; ?></option>	
				<?php } ?>
				</select>
				<button type="submit">Fight!</button>
			</form>
			
			<h3>A little about your items:</h3>
			<?php
				foreach( $items as $key => $item ){
					?>
					<div>
						<strong><?php echo $item['name']; ?></strong>
					</div>
					<p><em>(<?php echo $item['description']; ?>)</em></p>
					<?php
				}
			?>
			<?php
		}
	?>
	</div>
</body>
</html>
