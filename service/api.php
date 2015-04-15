<?php

require_once (dirname(__FILE__) . '/lib.php');
require_once (dirname(__FILE__) . '/api_utils.php');
require_once (dirname(__FILE__) . '/parse.php');
require_once (dirname(__FILE__) . '/gbif.php');

//--------------------------------------------------------------------------------------------------
function default_display()
{
	echo "hi";
}

//--------------------------------------------------------------------------------------------------
// Parse a specimen code
function display_parse_code ($code, $extend = 0, $callback = '')
{
	$obj = parse($code, $extend);
	
	api_output($obj, $callback);
}

//--------------------------------------------------------------------------------------------------
// Parse a specimen code and lookup in GBIF
function display_match_code_gbif ($code, $extend = 0, $scientificName = '', $callback = '')
{
	$obj = parse($code, $extend);
	
	if ($obj->parsed)
	{
		$obj->hits = search($obj, $scientificName);
	}
	
	api_output($obj, $callback);
}


//--------------------------------------------------------------------------------------------------
function main()
{
	$callback = '';
	$handled = false;
	
	// If no query parameters 
	if (count($_GET) == 0)
	{
		default_display();
		exit(0);
	}
	
	if (isset($_GET['callback']))
	{	
		$callback = $_GET['callback'];
	}
	
	// Submit job
	if (!$handled)
	{
		if (isset($_GET['code']))
		{	
			$code = $_GET['code'];
			
			$extend = 0;
			if (isset($_GET['extend']))
			{
				$user_extend = $_GET['extend'];
				if (is_numeric($user_extend))
				{
					$extend = max(10, $user_extend);
				}
			}
			
			// Are we going to match code?
			$match = false;
			if (isset($_GET['match']))
			{
				$match = true;
			}
			
			$scientificName = '';
			if (isset($_GET['scientificName']))
			{
				$scientificName = $_GET['scientificName'];
			}
			
			if ($match)
			{
				display_match_code_gbif($code, $extend, $scientificName, $callback);
				$handled = true;			
			}
			else
			{
				display_parse_code($code, $extend, $callback);
				$handled = true;
			}
		}
	}
		

}


main();

?>