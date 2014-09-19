<?php
/**
 * @package Make_It_So
 * @version 1.0
 */
/*
Plugin Name: Make It So
Plugin URI: http://blog.kjodle.net/
Description: Can't get enough of "He's Dead, Jim"? Then here's "Make It So" where you get lines from Star Trek: The Next Generation. 
Most of the quotations were taken from: http://en.wikiquote.org/wiki/Star_Trek:_The_Next_Generation
Author: Kenneth John Odle
Version: 1.0
Author URI: http://blog.kjodle.net/
*/

function make_it_so_get_line() {
	/** These are famous lines from "Star Trek: The Next Generaation" */
	$lines = "Make it so.
	Tea, Earl Grey, hot.
	Fascinating.
	Engage!
	I am Locutus of Borg.
	Resistance is futile.
	Nice to meet you...Pinocchio.
	I don't understand their humor, either.
	Fear is the true enemy, the only enemy.
	Surely you don't see your species like that, do you?
	Could you please continue the petty bickering? I find it most intriguing.
	You can't rescue a man from the place he calls his home.
	If you had an off switch, Doctor, would you not keep it secret?
	What's a knock-out like you doing in a computer-generated gin joint like this?
	Klingons are born, live as warriors, and die.
	Why do you mock me? Why do you wish to anger me?
	History has proven again and again that whenever mankind interferes with a less developed civilization,<br />no matter how well intentioned that interference may be, the results are invariably disastrous.
	If you prick me...do I not...leak?
	Well, so much for my dramatic exit.
	Our lives just became a lot more complicated.
	No being is so important that he can usurp the rights of another.
	Do not be deceived by her looks. The body is just a shell.
	I cannot deactivate the auto-destruct, but at least I have the satisfaction that you will die with us.
	Flair is what marks the difference between artistry and mere competence.
	The game's not big enough unless it scares you a little.
	Protect yourself, Captain, or they'll destroy you.
	I <em>am</em> relaxed.
	You will never come up against a greater adversary than your own potential, my young friend.
	Things are only impossible until they're not.
	Maybe if we felt any human loss as keenly as we feel one of those close to us, human history would be far less bloody.
	I was never a boy.
	You know, if this doesn't work, the thought of spending the rest of my life in here is none too appealing.
	In a world where children blow up children, everyone's a threat.
	It's easy. Just change the gravitational constant of the universe.
	I'm not good in groups. It's hard to work in groups when you're omnipotent.
	This is getting on my nerves, now that I have them!
	We'll make it one for the history books.
	I'd like my death to count for something.
	There are times, sir, when men of good conscience cannot blindly follow orders.
	I believe there are two ensigns stationed on deck 39 who know nothing about it.
	We will add your biological and technological distinctiveness to our own.
	Freedom is irrelevant. Self-determination is irrelevant. You must comply.
	We will start with the assumption that I am <em>not</em> crazy.
	If this were a bad dream, would you tell me?
	I could be pursuing an untamed ornithoid without cause.
	Some days you get the bear, and some days the bear gets you.
	I'll accept the judgment of history.
	We have to dream in order to survive.
	As my final duty as acting captain, I order you to bed.
	I perceive the entire universe as a single equation and it's so <em>simple</em>.
	Sir, I protest! I am <em>not</em> a merry man!
	Villains who twirl their moustaches are easy to spot.<br />Those who clothe themselves in good deeds are well-camouflaged.
	Please restate request.
	The unidirectional nature of the time continuum makes that an unlikely possibility.
	I have written a subroutine specifically for you. A programme within the programme.<br />I have devoted a considerable share of my internal resources to its development.
	I cannot condone violence against people who are not our enemy.
	We live in different universes, you and I. Yours is about diplomacy, politics, strategy. Mine is about blankets!
	You look like someone who wants to be disturbed.
	You're not like any bartender I've met before.
	Congratulations. You are now fully dilated to ten centimeters. You may now give birth.
	The computer simulation was not like this.
	I assume your handprint will open this door whether you are conscious or not.
	I study people carefully, in order to more closely approximate human behavior.
	I would gladly risk feeling bad at times, if it also meant that I could taste my dessert.
	I believe what you are seeing is the effect of the fluid dynamic processes<br />inherent in the large scale motion of rarefied gas.
	It is interesting that people try to find meaningful patterns in things that are essentially random.
	There are no civilians among the Borg.
	Seize the time...Live now. Make now always the most precious time. Now will never come again.
	It is green.
	Program complete. Enter when ready.
	There...are...four...lights!
	The universe is not so badly designed!
	For all we know, this might just be a recipe for biscuits!
	Isn't there something else you have to do?
	Have I been dreaming again?
	Do not approach me unannounced, especially while I am eating.
	I should have done this a long time ago.
	Today is a good day to die!
	Theoretically, it is possible...
	So, five-card stud, nothing wild...and the sky's the limit.
	I do not feel pleasure. I am only an android.
	Your culture will adapt to service ours.
	They're cutting us up like a roast.
	If we're going to be damned, let's be damned for what we really are.
	Shut up, Wesley!";

	// Here we split them into individual lines
	$lines = explode( "\n", $lines );

	// And then randomly choose a line
	return wptexturize( $lines[ mt_rand( 0, count( $lines ) - 1 ) ] );
}

// Echo the chosen line and make sure it stays out of the way of "Hello, Dolly" and "He's Dead, Jim"
function make_it_so() {
	$chosen = make_it_so_get_line();
	// If "Hello, Dolly" is activated, move the output of this plugin to a new line
	if (is_plugin_active('hello.php')) {
		echo "<div style=\"clear:both;\"></div>";
	}
	// If "He's Dead, Jim" is activated and "Hello, Dolly" is not, move the output of this plugin to a new line
	elseif (is_plugin_active('hes_dead_jim.php')) {
		echo "<div style=\"clear:both;\"></div>";
	}
	echo "<p id='makeitso'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'make_it_so' );

// We need some CSS to position the paragraph
function make_it_so_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#makeitso {
		float: $x;
		padding: 5px 15px 2px 15px;
		padding-left: 15px;
		padding-top: 5px;
		padding-bottom: 2px;		
		margin: 0 12px 0;
		font-size: 11px;
		font-family:\"Lucida Console\", monospace;
		text-align: right;
		text-stretch: 120%;
		background: #000000;
		color: #eeee00;
		border-radius: 18px;	
	}
	</style>
	";
}

add_action( 'admin_head', 'make_it_so_css' );

?>
