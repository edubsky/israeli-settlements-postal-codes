<?php
/**
 * api.php
 *
 * JSONP API to identify Israel's illegal settlements by postal code.
 *
 * @author     Eoin Dubsky <eoin@eko.org>
 * @license    https://en.wikipedia.org/wiki/MIT_License MIT License
 * @version    1.0
 * @link       https://wwwdot.org/settlements/
 */

// show file source if asked to, then exit
if(isset($_GET['show_source'])) {
	ini_set('highlight.comment', '#CCCCCC; font-weight: bold;');
	highlight_file('./api.php');
	exit;
}

// check for errors first, give useful feedback, then exit
if(!isset($_GET['postal_code']) OR !isset($_GET['callback'])) {
    echo '<b>ERROR:</b> Please supply a postal code to check, and a callback like <a href="api.php?postal_code=1093000&callback=is_it_illegal">api.php?postal_code=1093000&callback=is_it_illegal</a>';
	exit;
} 

// get input from querystring	  
$postal_code = $_GET['postal_code'];
$jsonp_callback = $_GET['callback'];

// return error if postcode is not exactly 7-digits long, then exit
if (!preg_match('/^\d{7}$/',$postal_code)) {
    echo '<b>ERROR:</b> Please verify that you have a 7 digit postal code.';
	exit;
}

// all good? Then check the postal codes file and return jsonp function with data
if( strpos(file_get_contents("./israeli-settlements-postal-codes.txt"),$postal_code) !== false) {
	// Illegal settlement postal code!
	header("Content-Type: application/json");
    echo $jsonp_callback . '(' . "{'postal_code' : " . $postal_code .", 'is_settlement' : TRUE, 'occupying_power' : 'Israel', 'information_source' : 'European Commission', 'further_information' : 'https://taxation-customs.ec.europa.eu/eu-israel-technical-arrangement_en'}" . ')';
} else {
	// Not an illegal settlement postal code
	header("Content-Type: application/json");
    echo $jsonp_callback . '(' . "{'postal_code' : " . $postal_code .", 'is_settlement' : FALSE, 'further_information' : 'https://taxation-customs.ec.europa.eu/eu-israel-technical-arrangement_en'}" . ')';	
}
?>