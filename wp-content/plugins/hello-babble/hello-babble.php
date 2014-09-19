<?php
/*
Plugin Name: Hello Babble
Plugin URI: http://www.artiss.co.uk/hello-babble
Description: Add a line of techno babble to admin
Version: 1.0
Author: David Artiss
Author URI: http://www.artiss.co.uk
*/

/**
* Hello Babble
*
* Generate some random techno babble
* Based upon Hello Dolly plugin by Matt Mullenweg
*
* @package	Hello-Babble
*/

/**
* Add meta to plugin details
*
* Add options to plugin meta line
*
* @since	1.0
*
* @param	string  $links	Current links
* @param	string  $file	File in use
* @return   string			Links, now with settings added
*/

function set_babble_plugin_meta( $links, $file ) {

	if ( false !== strpos( $file, 'hello-babble.php' ) ) {
		$links = array_merge( $links, array( '<a href="http://www.artiss.co.uk/forum">' . __( 'Support', 'hello-babble' ) . '</a>' ) );
		$links = array_merge( $links, array( '<a href="http://www.artiss.co.uk/donate">' . __( 'Donate', 'hello-babble' ) . '</a>' ) );
	}

	return $links;
}

add_filter( 'plugin_row_meta', 'set_babble_plugin_meta', 10, 2 );

/**
* Create babble item
*
* Extract an item of techno babble from the passed array
*
* @since	1.0
*
* @param    string      $text		Text array
* @return   string                  Babble item
*/

function create_babble( $text ) {
	$number = mt_rand( 0, count( $text ) - 1 );
	$babble_item = $text[ $number ];

	if ( '*' != substr( $babble_item, 0, 1 ) ) {
		$babble_item .= ' ';
	} else {
		$babble_item = substr( $babble_item, 1 );
	}

	return $babble_item;
}

/**
* Hello Babble
*
* Build a line of techno babble and echo it out
*
* @since	1.0
*
* @uses		create_babble			Extract an item of babble
*/

function hello_babble() {

	// Get the first word

	$babble = ltrim( create_babble( explode( ',', '*,*ana-,*anti,*auto-,*bio-,*di,*duo-,*dyna-,*electro-,*hepta-,*hexa-,*hyper,*inter,*intra,*iso-,*magna-,*meta,*mono-,*multi-,*nano-,*nona-,*octa-,*penta-,*phased-,*poly,*posi,*quad,*sub-,*tetra-,*trans-,*tri,*uni,alternating,ambient,annular,anomalous,artificial,asymmetrical,linear,microscopic,modulated,quantum,rapid,self,spatial,unknown' ) ) );

	// Loop around for the 2nd word until the beginning doesn't match the first word

	$first_word = rtrim( ltrim( $babble, '*' ), '-' );
	$second_word = $first_word;

	while ( $first_word == substr( $second_word, 0, strlen( $first_word ) ) ) {
		$second_word = create_babble( explode( ',', '*,actinium,adaptive,ambient,anaphasic,anion,annular,axionic,biometric,bismuth,cadmium,caesium,cobalt,cosmic,crystalline,curium,dendritic,duodynetic,dynamic,dynetic,frequency,generative,genetic,genic,harmonic,interphasic,inverted,ionic,isomiatic,linear,lithium,magnascopic,magnatomic,magnetic,matter,metagenic,metaphasic,metric,miatic,mimetic,nadion,neural,neutrino,nucleonic,osmotic,phased,photonic,plasmonic,positronic,quantum,regenerative,scopic,space,spatial,static,subharmonic,subspace,tronic' ) );
	}
	$babble .= $second_word;

	// Now just grab words 3 and 4

	$babble .= create_babble( explode( ',', '*,alignment,amplification,articulation,atmospheric,attenuation,attraction,auxiliary,baryon,chroniton,confinement,constriction,containment,dampening,deflection,differential,dimensional,e-m,energy,exhaust,flow,fluidic,flux,focal,force,fusion,gel,gravimetric,gravity,impulse,matrix,optical,oscillating,particle,phase,phasic,photon,plasma,power,reaction,reciprocating,slipstream,sonic,space-time,stream,temporal,tetryon,thermal,transfer,verteron,warp,wave,wavefront' ) );

	$babble .= create_babble( explode( ',', '*,accelerator,actuator,array,assembly,assimilator,beacon,beam,being,bubble,burst,capacitent,capacitor,chamber,chip,cloak,cluster,coil,collector,collider,compensator,conditioner,conduit,configuration,continuum,controller,converter,cooler,core,coupling,cradle,cylinder,deflector,device,director,discriminator,disruptor,distortion,drive,driver,echogram,effect,emissions,emitter,field,flux,frame,generator,grid,guide,harmonic,inducer,initiator,injector,intake,interference,interface,inverter,inversion,lift,manifold,matrix,net,network,node,pack,pathway,pattern,phaser,phenomenon,platform,pulse,radiation,reactor,refractor,repulser,resin,scanner,sensor,separator,shaft,shell,shield,shift,singularity,sink,stabilizer,stimulator,stream,string,sublimater,suppressor,system,torpedo,unit,variance,wave' ) );

	// Return the final sentence, all nicely formatted and wrapped in cosy XHTML

	echo "<p id='babble'>" . wptexturize( ucfirst( $babble ) ) . "</p>";
}

add_action( 'admin_notices', 'hello_babble' );

/**
* Babble CSS
*
* Position the paragraph using CSS
*
* @since	1.0
*/

function babble_css() {

	// This makes sure that the positioning is also good for right-to-left languages

	$x = is_rtl() ? 'left' : 'right';

	// Add the inline CSS to the header

	echo "
	<style type='text/css'>
	#babble {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

add_action( 'admin_head', 'babble_css' );
?>