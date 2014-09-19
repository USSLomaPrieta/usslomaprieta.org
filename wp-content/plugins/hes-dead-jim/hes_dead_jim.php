<?php
/**
 * @package Hes_Dead_Jim
 * @version 1.0
 */
/*
Plugin Name: He's Dead, Jim
Plugin URI: http://blog.kjodle.net/
Description: Do you like the idea behind Matt's "Hello, Dolly" plugin, but feel that it doesn't feed your inner nerd? Then here's "He's Dead, Jim" which has been shamelessly ported from Matt's plugin. The concept is the same, except that instead of lines from "Hello, Dolly" you get lines from Star Trek: The Original Series. 
Most of the quotations were taken from: http://en.wikiquote.org/wiki/Star_Trek:_The_Original_Series
Author: Kenneth John Odle
Version: 1.0
Author URI: http://blog.kjodle.net/
*/

function hes_dead_jim_get_line() {
	/** These are famous lines from "Star Trek: The Original Series" */
	$lines = "He's dead, Jim.
	They'll be no tribble at all.
	Computer, compute to the last digit the value of pi.
	Now this is a drink for a man.
	You may find that having is not so pleasing a thing as wanting.<br />This is not logical, but it is often true.
	The best diplomat that I know is a fully-loaded phaser bank.
	I signed aboard this ship to practice medicine, <br />not to have my atoms scattered back and forth across space by this gadget.
	You will die of suffocation, in the icy cold of space.
	Shut-up, Spock! We're rescuing you!
	Evil does seek to maintain power by suppressing the truth.
	How many more men must die before you two begin to act like military men instead of fools?
	Brain and brain!  What is brain?
	Random chance seems to have operated in our favor.
	Mr. Spock, the women on your planet are logical.<br />That's the only planet in the galaxy that can make that claim.
	I'm a doctor, not a bricklayer.
	My dear girl, I'm a doctor. When I peek, it is in the line of duty.
	I'm a doctor, not a mechanic.
	I'm a doctor, not an engineer.
	I'm a doctor, not a coal miner.
	Instruments register only those things they're designed to register.<br />Space still contains infinite unknowns.
	Our spectro-readings showed no contamination, no unusual elements present.
	Don't risk your life on a theory!
	Are you aware it's the captain's guts you're analyzing?
	Computer, go to sensor probe. Any unusual readings?
	The fact that my internal arrangement differs from yours, Doctor, pleases me to no end.
	We humans are full of unpredictable emotions that logic cannot solve.
	You and I are of a kind. In a different reality, I could have called you friend.
	Life and death are seldom logical.
	Oh, how absolutely typical of your species!<br />You don't understand something so you become fearful.
	I object to intellect without discipline.<br />I object to power without constructive purpose.
	I made an error in my computations.
	Oh, I like them fine, but a computer takes less space.
	Your statement is irrelevant.
	Without freedom of choice there is no creativity.
	You'd make a splendid computer, Mr Spock.
	Aye, the haggis is in the fire, for sure.
	I have never understood the female capacity to avoid a direct answer to any question.
	Annihilation Jim. Total, complete, absolute annihilation.
	Insults are effective only where emotion is present.
	You can't evaluate a man by logic alone.
	Immortality consists largely of boredom.
	I'm a doctor, not an escalator.
    In the strict scientific sense, Doctor, we all feed on death, even vegetarians.
	Brace yourself. The area of penetration will no doubt be sensitive.
	I'm trying to thank you, you pointy-eared hobgoblin!
	It would be illogical to assume that all conditions remain stable.
	Live long and prosper.
	There's another way to survive: mutual trust and help.
	The prejudices people feel about each other disappear when they get to know each other.
	Change is the essential process of all existence.
	Death, when unnecessary, is a tragic thing.
	Violence in reality is quite different from theory.
	I am pleased to see that we have differences.<br />May we together become greater than the sum of both of us.
	History tends to exaggerate.
	There is nothing good in war except its ending. 
	Youth doesn't excuse everything.
	Sometimes, a man will tell his bartender things he'll never tell his doctor.
	Fascinating.";

	// Here we split them into individual lines
	$lines = explode( "\n", $lines );

	// And then randomly choose a line
	return wptexturize( $lines[ mt_rand( 0, count( $lines ) - 1 ) ] );
}

// Echo the chosen line and make sure it stays out of the way of "Hello, Dolly" 
function hes_dead_jim() {
	$chosen = hes_dead_jim_get_line();
	// If "Hello, Dolly" is activated, move the output of this plugin to a new line
	if (is_plugin_active('hello.php')) {
		echo "<div style=\"clear:both;\"></div>";
	}
	echo "<p id='hesdeadjim'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'hes_dead_jim' );

// We need some CSS to position the paragraph
function dead_jim_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#hesdeadjim {
		float: $x;
		padding: 5px 15px 2px 15px;
		padding-left: 15px;
		padding-top: 5px;
		padding-bottom: 2px;		
		margin: 0 12px 3px 0;
		font-size: 11px;
		font-family:\"Lucida Console\", monospace;
		text-align: right;
		background: #003;
		border: solid 4px #ffd;
		color: #ffffd9;
		border-radius: 9px;	
	}
	</style>
	";
}

add_action( 'admin_head', 'dead_jim_css' );

?>
