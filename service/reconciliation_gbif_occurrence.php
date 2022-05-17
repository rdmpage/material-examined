<?php

// Match specimen codes to GBIF occurrences

require_once (dirname(__FILE__) . '/reconciliation_api.php');


//--------------------------------------------------------------------------------------------------
class GBIFOccurrenceService extends ReconciliationService
{
	//----------------------------------------------------------------------------------------------
	function __construct()
	{
		$this->name 			= 'GBIF Occurences';
		
		$this->identifierSpace 	= 'https://www.gbif.org/';
		$this->schemaSpace 		= 'http://rdf.freebase.com/ns/type.object.id';
		$this->Types();
		
		$view_url = 'https://www.gbif.org/occurrence/{{id}}';

		$preview_url = '';	
		$width = 430;
		$height = 300;
		
		if ($view_url != '')
		{
			$this->View($view_url);
		}
		if ($preview_url != '')
		{
			$this->Preview($preview_url, $width, $height);
		}
	}
	
	//----------------------------------------------------------------------------------------------
	function Types()
	{
		$type = new stdclass;
		$type->id = 'http://rs.tdwg.org/dwc/terms/Occurrence';
		$type->name = 'Occurrence';
		$this->defaultTypes[] = $type;
	} 	
		
	//----------------------------------------------------------------------------------------------
	// Handle an individual query
	function OneQuery($query_key, $text, $limit = 1, $properties = null)
	{
		$url = 'http://localhost/~rpage/material-examined/service/api.php?code=' . urlencode($text) . '&match';
	
		$json = get($url);
		
		if ($json != '')
		{
			$obj = json_decode($json);
			
			foreach ($obj->hits as $occurrence)
			{
				$hit = new stdclass;
				$hit->id 	= $occurrence->key;
				$hit->name 	= $occurrence->institutionCode . ' ' . $occurrence->catalogNumber . '(' . $occurrence->scientificName . ')';
				//similar_text($text, $hit->name, $hit->score);
				//$hit->match = ($hit->score == 1);
				$hit->match = true;
				$this->StoreHit($query_key, $hit);
			}
		}
		
	}
	
	
}

$service = new GBIFOccurrenceService();

if (0)
{
	file_put_contents(dirname(__FILE__) . '/tmp/gbif_occurrence.txt', $_REQUEST['queries'], FILE_APPEND);
}

$service->Call($_REQUEST);

?>