<?php

error_reporting(E_ALL);

require_once(dirname(dirname(__FILE__)) . '/service/lib.php');

// Read a file of specimen codes, one per line, and reconcile

$filename = 'test.txt';

$file_handle = fopen($filename, "r");
	
while (!feof($file_handle)) 
{
	$line = trim(fgets($file_handle));
	
	$code = $line;
	
	$url = 'http://localhost/~rpage/material-examined/service/api.php?code=' . urlencode($code) . '&match';
	
	$json = get($url);
		
	$hits = array();
	
	if ($json != '')
	{
		$obj = json_decode($json);
		
		if (isset($obj->hits))
		{		
			foreach ($obj->hits as $occurrence)
			{
				$hits[] = $occurrence->key;
			}
		}
	}
	
	echo $code . "\t" . "[" . join(',', $hits) . "]" . "\n";
}

?>