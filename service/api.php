<?php

error_reporting(E_ALL);

require_once (dirname(__FILE__) . '/lib.php');
require_once (dirname(__FILE__) . '/api_utils.php');
require_once (dirname(__FILE__) . '/parse.php');
require_once (dirname(__FILE__) . '/gbif.php');

//--------------------------------------------------------------------------------------------------
function default_display()
{
	echo '<html>
	<head>
		<meta charset="utf-8" /> 
		
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	
		  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
		  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.css">
		  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.js"></script>
	
	   <!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
		<script src="https://cdn.jsdelivr.net/npm/ejs@2.6.1/ejs.min.js" integrity="sha256-ZS2YSpipWLkQ1/no+uTJmGexwpda/op53QxO/UBJw4I=" crossorigin="anonymous"></script>	
	
		<title>Material Examined API</title>
	</head>
	<body>
		<main>
		<div class="container">

	<h1>Simple API to search for specimens</h1>
	
	<p>The <a href="../">Material Examined</a> API does three things. Firstly it tries to parse the specimen code to extract 
	collection codes, catalogue numbers, etc. If you just want to parse a code, then don\'t set the
	<code>match</code> parameter (i.e., <code>&match</code>).
	
	<table>
	<tr>
		<th>Parameter</th>
		<th>Value</th>
	</tr>
	<tr>
		<td>code</td>
		<td>Specimen code, e.g. BMNH 1891.6.13.25</td>
	</tr>
	<tr>
		<td>match</td>
		<td>If not set the API just parses the specimen code, otherwise it will also try and find the specimen in GBIF. 
		For example, <a href="./api.php?code=UF+121176">api.php?code=UF+121176</a> displays the parsed code and 
		possible alternative codes that can be searched for.
		</td>
	</tr>
	<tr>
		<td>extend</td>
		<td>An integer value, e.g. 10. This uses the GBIF API to try and find variations on the catalogue number.</td>
	</tr>
	
	</div>
	</main>
	</body>
	</html>';
}

//--------------------------------------------------------------------------------------------------
// Parse a specimen code
function display_parse_code ($code, $extend = 0, $callback = '')
{
	$obj = parse($code, $extend);
	$obj->status = 200; // for now	
	
	api_output($obj, $callback);
}

//--------------------------------------------------------------------------------------------------
// Parse a specimen code and lookup in GBIF
function display_match_code_gbif ($code, $extend = 0, $scientificName = '', $callback = '')
{
	$obj = parse($code, $extend);
	$obj->status = 200; // for now
	
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