<?php

/**
 * Player vs Theme
 * 
 * Player can choose to fight Man, Machine, or Nature.
 * 
 * A fight is conducted by generating random numbers between 1 and a character's
 * power, and subtracting a random number between 1 and the other character's 
 * defense.
 */

$player_character = array(
	'name' => "Player One",
	'description' => "Fresh off the boat, this player won't last long.",
	'power' => 20,
	'defense' => 10,
	'hp' => 25,
);

$themes = array( 
	'man' => array(
		'name' => "Gruff Veteran",
		'description' => "She's seen many wars and the horrors they bring. She will cut you.",
		'power' => 30,
		'defense' => 5,
		'hp' => 30,
	),
	'machine' => array(
		'name' => "Killbot5000 v3.1",
		'description' => "Beware, this killbot has the new firmware update. It won't fall the the same old tricks again.",
		'power' => 25,
		'defense' => 10,
		'hp' => 30,
	),
	'nature' => array(
		'name' => "SwampThingnado",
		'description' => "That tornado is full of Swamp Things!",
		'power' => 20,
		'defense' => 20,
		'hp' => 30,
	),
);

?><html>
<body>
	<h1>Player vs Theme</h1>
	<div>
	<?php
		// if the player has made a choice, execute the game
		if ( isset( $_GET['choice'] ) ) {
			// the player's choice becomes the computer's character
			$legal_choices = array_keys( $themes );
			
			if ( in_array( $_GET['choice'], $legal_choices ) ) {
				// get the computer's character as its own variable.
				$computer_character = $themes[ $_GET['choice'] ];
				
				// and array of text messages we can display to the user
				$messages = array();
				
				// the final result of the battle
				$result = "";
				
				// we have a player_character and a computer_character,
				// time to make them fight!
				$keep_fighting = true;
				
				// our game loop doesn't end until the game is over
				while( $keep_fighting ){
					// attacks are a random numbers between 1 and power 
					$player_attack = rand( 1, $player_character['power']  );
					$computer_attack = rand( 1, $computer_character['power'] );

					// defenses are random numbers between 1 and defense
					$player_defense = rand( 1, $player_character['defense'] );
					$computer_defense = rand( 1, $computer_character['defense'] );
					
					// determine how much damage (if any) the characters take
					$player_damage = $computer_attack - $player_defense;
					$computer_damage = $player_attack - $computer_defense;
					
					// if damage is taken, subtract it from the  character hp
					if ( $player_damage > 0 ) {
						$player_character['hp'] -= $player_damage;
						$messages[] = "{$player_character['name']} took {$player_damage} damage!  Remaining HP: {$player_character['hp']}";
					}
					
					if ( $computer_damage > 0 ) {
						$computer_character['hp'] -= $computer_damage;
						$messages[] = "{$computer_character['name']} took {$computer_damage} damage!  Remaining HP: {$computer_character['hp']}";
					}
					
					// if a character has zero or less hp, then they are dead  
					// and the game is over
					if ( $player_character['hp'] <=0 ) {
						$result = "Oh no! {$computer_character['name']} defeated {$player_character['name']}. You must retreat and heal up.";
						$keep_fighting = false;
					}
					else if ( $computer_character['hp'] <= 0 ) {
						$result = "Fantastic! {$player_character['name']} defeated the infamous {$computer_character['name']}.";
						$keep_fighting = false;
					}
				}
				
				
				// if we made it here, then the fight is over and the only
				// thing left is to show our messages and the result.
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
		}
		// else, the game is ready to be played
		else {
			?>
			<p><strong>Welcome <?php echo $player_character['name']; ?>!</strong></p>
			<p><em>(<?php echo $player_character['description']; ?></em>)</p>
			
			<h3>Time to fight!</h3>
			<form method="get">
				<label>Choose your opponent: </label>
				<select name="choice">
				<?php foreach ( $themes as $key => $theme ){ ?>
					<option value="<?php echo $key; ?>"><?php echo $theme['name']; ?></option>	
				<?php } ?>
				</select>
				<button type="submit">Fight!</button>
			</form>
			
			<h3>A little about your opponents:</h3>
			<?php
				foreach( $themes as $key => $theme ){
					?>
					<div>
						<strong><?php echo $theme['name']; ?></strong>
					</div>
					<p><em>(<?php echo $theme['description']; ?>)</em></p>
					<?php
				}
			?>
			<?php
		}
	?>
	</div>
</body>
</html>
