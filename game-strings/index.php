<?php

/**
 * Paper, Rock, Scissors
 * 
 * The player chooses one of three strings: 'paper', 'rock', or 'scissors'.
 * The computer selects one of the three above strings randomly.
 * 
 * The game compares the player's choice with the computer's random selection 
 * and determines the winner.
 *
 * Rules:
 * 
 * - rock beats scissors
 * - scissors beat paper
 * - paper beats rock
 * 
 * Nine possible outcomes:
 *
 * - Player and computer both choose Rock
 * - Player chooses Rock, Computer chooses Paper
 * - Player chooses Rock, Computer chooses Scissors
 * 
 * - Player and computer both choose Paper
 * - Player chooses Paper, Computer chooses Rock
 * - Player chooses Paper, Computer chooses Scissors
 * 
 * - Player and computer both choose Scissors
 * - Player chooses Scissors, Computer chooses Rock
 * - Player chooses Scissors, Computer chooses Paper
 * 
 * Three of these outcomes can be tested with a single conditional statement 
 * to determine if there is a tie, leaving only six cases left to test. 
 * 
 * ex:   if ( player's choice == computer's choice )
 */

?><html>
<body>
<h1>Paper, Rock, Scissors</h1>
<div>
	<?php
		// if the player has made a choice, execute the game
		if ( isset( $_GET['choice'] ) ) {
			// player's choice
			$player_choice = $_GET['choice'];
			
			// Note: It's good practice to define variables that you use alter within
			// conditional statements. This ensures they always have a value.

			// The $result string is where we'll write a simple message that
			// explains game's outcome.
			$result = '';
			
			// random number used to determine the computer's choice
			$random_number_between_1_and_3 = rand( 1, 3 );

			// depending on the random number, set the computer's choice
			switch ( $random_number_between_1_and_3 ){
				case 1: 
					$computer_choice = 'paper';
					break;
				
				case 2:
					$computer_choice = 'rock';
					break;
				
				case 3:
					$computer_choice = 'scissors';
					break;
			}
			
			/**
			 * Now we have both a player and computer choice. we just need to
			 * compare them and determine the winner (if there is one).

			 * We have 2 top level cases to deal with:
			 *  - The player or computer wins
			 *  - Tie
			 * 
			 * Tie is the easiest to determine, so let's look for it first
			 */
			if ( $player_choice == $computer_choice ) {
				$result = 'Tie. You both chose ' . ucfirst( $player_choice ) ;
			}
			else {
				/**
				 * The result is not a tie, so we must determine the winner.
				 * Now we're dealing with many more cases.
				 * 
				 * What we know:
				 * - there are only 3 possible choices
				 * - there is not a tie
				 * 
				 * Compare the player's and computer's choices 
				 * until we've satisfied all possibilities.
				 */
				if ( $player_choice == "rock" ) {
					// Note: since we"re checking player"s choice as rock,
					// and there is not a tie, then the computer could have
					// only chosen paper or scissors.
					if ( $computer_choice == "paper" ){
						// paper beats rocks, player loses
						$result = "Computer WINS!";
					}
					else if ( $computer_choice == "scissors" ) {
						// rock beats scissors, player wins
						$result = "You WIN!";
					}
				}
				else if ( $player_choice == "paper" ) {
					// paper beats rock, player wins
					if ( $computer_choice == "rock" ) {
						$result = "You WIN!";
					}
					// scissors beats paper, player loses
					else if ( $computer_choice == "scissors" ) {
						$result = "Computer WINS!";
					}
				}
				else if ( $player_choice == "scissors" ) {
					// rock beats scissors, player loses
					if ( $computer_choice == "rock" ) {
						$result = "Computer WINS!";
					}
					// scissors beats paper, player wins
					else if ( $computer_choice == "paper" ) {
						$result = "You WIN!";
					}
				}

				// append the details of the match to the result
				$result.= " - You chose $player_choice and the Computer chose $computer_choice.";
			}
			
			?>
			<p><?php echo $result; ?></p>
			<p><a href="index.php">Play Again</a></p>
			<?php
		}
		// else, the game is ready to be played
		else {
			?>
			<p>Choose one:</p>
			<p><a href="?choice=paper">Paper</a></p>
			<p><a href="?choice=rock">Rock</a></p>
			<p><a href="?choice=scissors">Scissors</a></p>
			<?php
		}
	?>
</div>
</body>
</html>