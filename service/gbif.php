<?php

// GBIF API

//--------------------------------------------------------------------------------------------------
// Search for a specimen in GBIF using the GBIF API
// $specimen is an object that represents the parsed and processed specimen code
// If we supply a $scientificName then we filter the search by that taxon, useful
// when specimen codes are used for multiple taxa
function search ($specimen, $scientificName = '')
{
	global $config;
	
	$hits = array();
	
	$hit_keys = array();
	
	if ($specimen->parsed)
	{
		foreach ($specimen->parameters as $parameters)
		{
			$url = 'http://api.gbif.org/v1/occurrence/search?';
						
			if ($scientificName != '')
			{
				$parameters['scientificName'] = $scientificName;
			}
						
			foreach ($parameters as $k => $v)
			{
				$url .= $k . '=' . urlencode($v) . '&';
			}
			
			$json = get($url);
			
			if ($json != '')
			{
				$obj = json_decode($json);
				foreach ($obj->results as $occurrence)
				{
					// We may encounter the same record more than once, so ensure uniqueness
					if (!in_array($occurrence->gbifID, $hit_keys))
					{
						$hit_keys[] = $occurrence->gbifID;
						$hits[] = $occurrence;
					}
				
					//$hits[$occurrence->gbifID] = $occurrence;
					
				}
			}

		}
	}
	
	return $hits;	
}

?>