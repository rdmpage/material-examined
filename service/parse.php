<?php

error_reporting(E_ALL);

// Parse specimen codes

require_once(dirname(__FILE__) . '/lib.php');

//--------------------------------------------------------------------------------------------------
$patterns = array(

	// specific
	
	// 00729059; Smithsonian National Museum of Natural History
    //    570895-Smithsonian National Museum of Natural History-USA

	'/^[0]*(?<catalogNumber>\d+)[;|-]\s*(?<institutionCode>Smithsonian National Museum of Natural History)/i',
	
	
	// Start note AM\s*[A-Z] will also catch AMNH, breaking code! Use \s+ and be more specific 
	// AM
	'/^(?<institutionCode>AM)(\s+|:)uta(?<catalogNumber>[A-Z]\.\d+)$/',
	
	// AM C.478013a
	'/^(?<institutionCode>AM)(\s+|:)(?<catalogNumber>[A-Z]\.\d+)[a-z]?$/',
	
	// AM I.29316-002
	'/^(?<institutionCode>AM)\s+(?<catalogNumber>[A-Z]\.\d+-\d+)$/',
	
	// AM KS 57959
	'/^(?<institutionCode>AM)\s+(?<catalogNumber>[A-Z]+\.?\s*\d+)$/',
	
	// End note 
	
	
	// AM-M. 5786
	'/^(?<institutionCode>AM)-(?<catalogNumber>[A-Z]\.\s+\d+)$/',
	
	// A.M.N.H. No. 708117
	'/^(?<institutionCode>A.M.N.H.)\s+[N|n]o\.\s+(?<catalogNumber>\d+)$/',
	
	// AMNH:466.236 (e.g., JN574453)
	'/^(?<institutionCode>AMNH):(?<catalogNumber>\d+\.\d+)$/',
	
	// AMNH DOT 12634
	'/^(?<institutionCode>AMNH)\s+(?<collectionCode>[A-Z]+)\s*(?<catalogNumber>\d+)$/',
	
	// AMNH Herpetology 123029
	'/^(?<institutionCode>AMNH)\s+(?<collectionCode>[A-Z][a-z]+)\s+(?<catalogNumber>\d+)$/',
	
	// AM:AMR134930
	'/^(?<institutionCode>AM):AM(?<catalogNumber>[A-Z]\d+)$/',
	
	// AMR124799
	'/^(?<institutionCode>AM)(?<catalogNumber>[R]\d+)$/',
	
	// AMS AMSE2844
	'/^(?<institutionCode>AMS)\s*(?<catalogNumber>[A-Z]\d+)$/',
	
	// AMS:W.35546
	// AMS:R 173230
	'/^(?<institutionCode>AMS):(?<catalogNumber>[A-Z]\s*[\.]?\d+)$/',
	
	// AMS I.16979-002
	'/^(?<institutionCode>AMS)\s+(?<catalogNumber>[A-Z]\s*[\.]?\s*\d+(-\d+)?)$/',
	
	
	// ASIZP-057643
	'/^(?<institutionCode>ASIZ)P-(?<catalogNumber>\d+)$/',
	
	// Australian Museum M24737
	'/^(?<institutionCode>Australian Museum)\s+(lot\s+)?(?<catalogNumber>[A-Z]\s*\d+)$/',
	
	// B_10_0278204
	'/^(?<institutionCode>B)_(?<catalogNumber>\d+_\d+)$/',
	
	// BIOUG<CAN>:10BBEPT-0185
	'/^(?<institutionCode>BIOUG)<CAN>:(?<catalogNumber>.*)$/',
	
	// BM 1860.3.18.18
	'/^(?<institutionCode>BM)\s*(?<catalogNumber>[0-9]{1,4}(\.\d+)+)$/',
	'/^(?<institutionCode>BM\(NH\))\s*(?<catalogNumber>[0-9]{1,4}(\.\d+)+)$/',
	
	// BM000566339 NHM plant barcode
	'/^(?<institutionCode>BM)(?<catalogNumber>0\d+)$/',

	// BMNH 1946.8.21.7
	'/^(?<institutionCode>BMNH)\s+(?<catalogNumber>[0-9]{1,4}(\.\d+)+)$/',
	
	// BMNH reg. no.1898.9.1.1233
	'/^(?<institutionCode>BMNH)\s*reg.\s*no.\s*(?<catalogNumber>[0-9]{1,4}(\.\d+)+)$/',
	
	// BMNH No. 1997.7.7
	'/^(?<institutionCode>BMNH)\s*[N|n]o.\s*(?<catalogNumber>[0-9]{1,4}(\.\d+)+)$/u',

	// BMNH 2005.8.9.105-106 (not a range FFS)
	'/^(?<institutionCode>BMNH)\s+(?<catalogNumber>[0-9]{1,4}(\.\d+)+([-|–]\d+))$/u',
	
	// BM(NH) 1981.5.26: 11-14 not a range
	'/^(?<institutionCode>BM\(NH\))\s+(?<catalogNumber>[0-9]{1,4}(\.\d+)+:\s*(\d+)+([-|–]\d+)?)$/u',
	
	// BM (NH) 1938:5:7: 89–91 not a range
	'/^(?<institutionCode>BM\s+\(NH\))\s+(?<catalogNumber>[0-9]{1,4}(:\d+)+:\s*(\d+)+([–|-]\d+)?)$/u',
	

	// BMNH (E) 1009503
	'/^(?<institutionCode>BMNH\s*\(E\))\s*(?<catalogNumber>\d+)$/',
	
	// CAS:192888
	'/^(?<institutionCode>CAS):(?<catalogNumber>\d+)$/',
	
	// CAS:CASIZ 12093
	'/^CAS:(?<institutionCode>[A-Z]+)\s*(?<catalogNumber>\d+)$/',
	

	// CASENT0012887
	'/^(?<institutionCode>CASENT)(?<catalogNumber>\d+(-[D|d]\d+))$/',
	
	// CBM-ZC 10275
	'/^(?<institutionCode>CBM)\-(?<collectionCode>[A-Z]+)\s+(?<catalogNumber>\d+)$/',
	
	
	// CSIRO H 4027-03
	'/^(?<institutionCode>CSIRO)\s+(?<catalogNumber>[A-Z]\s*\d+\s*-\s*\d+)$/',
	
	
	// European Molecular Biology Laboratory Australian Mirror DQ107962
	'/^(?<institutionCode>European Molecular Biology Laboratory Australian Mirror)\s+(?<catalogNumber>[A-Z]+\d+)$/',
	
	// F0BN009917	
	'/^(?<institutionCode>F0BN)0*(?<catalogNumber>\d+)$/',
	
	// F0041602F
	'/^(?<institutionCode>F)(?<catalogNumber>\d+F)$/',
	
	// FishBase
	'/^(?<institutionCode>FishBase)\s+(?<catalogNumber>.*)$/',
	
	// FLMNH 171012c';
	'/^(?<institutionCode>FLMNH) (?<catalogNumber>\d+)[a-z]$/',
	
	// KU Natural History Museum 109963
	'/^(?<institutionCode>KU) Natural History Museum (?<catalogNumber>\d+)$/',
	
	// KU:IT:00312	
	'/^(?<institutionCode>KU):(<collectionCode>IT):(?<catalogNumber>\d+)$/',

	// LACM
	'/^(?<institutionCode>LACM)\s*(?<catalogNumber>\d+)$/',
	
	// LAE
	'/^(?<institutionCode>LAE)\s*(?<catalogNumber>LAE\d+)$/',
	
	
	
	// MCZ:A-138404
	'/^(?<institutionCode>MCZ):(?<catalogNumber>[A|R][\.|\-]\d+)$/',

	// MCZR-192365
	'/^(?<institutionCode>MCZ)(?<catalogNumber>[A|R][\.|\-]\d+)$/',
	
	
	//MCZ-R49129
	'/^(?<institutionCode>MCZ)-(?<catalogNumber>[A|R]\d+)$/',

	//MCZ R.782
	'/^(?<institutionCode>MCZ)\s+(?<catalogNumber>[A|R]\.\d+)$/',
	
	// MNHN 1974-244
	'/^(?<institutionCode>MNHN)(\s*|_)(?<catalogNumber>[0-9]{4}[-|_]\d+)$/',
	
	
	// MNHN:ENSIF 2664
	'/^(?<institutionCode>MNHN):(?<catalogNumber>[A-Z]+\s*[0-9]\d+)$/',
	
	// MNHN-IM-2009-21805
	// MNHN:IM-2009-10376
	// MNHN IM-2009-10376
	'/^(?<institutionCode>MNHN)[\-|:|\s](?<collectionCode>[A-Z]+)\-(?<catalogNumber>.*)$/',
	
	// MNHN:IM:20098733
	'/^(?<institutionCode>MNHN):(?<collectionCode>[A-Z]+):(?<catalogNumber>.*)$/',
	
	// MNHN IC.1986-0015
	'/^(?<institutionCode>MNHN)\s+(?<collectionCode>[A-Z]+)\.(?<catalogNumber>.*)$/',
	
	// MVZ Herp 228860
	'/^(?<institutionCode>MVZ) (?<collectionCode>\w+) (?<catalogNumber>\d+)$/',
	
	// MZLU L920/3021
	'/^(?<institutionCode>MZLU)\s+(?<catalogNumber>[A-Z]\d+\/\d+)$/',
	
	// NHM 1882.1.20.933
	'/^(?<institutionCode>NHM)\s+(?<catalogNumber>[0-9]{1,4}(\.\d+)+)$/',
	
	// NHMUK:1822.9.1.932
	// NHM-UK 1956.60.9
	'/^(?<institutionCode>NHM[-]?UK)(:|\s*)(?<catalogNumber>[0-9]{1,4}(\.\d+)+)$/',
	
	// NHMUK 1896.1.25.7-8
	'/^(?<institutionCode>NHMUK)(:|\s*)(?<catalogNumber>[0-9]{1,4}(\.\d+)+(-\d+)?)$/',
	
	
	
	// NHM:BMNH20100253
	'/^NHM:(?<institutionCode>BMNH)(?<catalogNumber>\d+)$/',
	
	// NTM S.10623-001
	'/^(?<institutionCode>NTM)\s+(?<catalogNumber>[A-Z]\.\d+(-\d+)?)$/',
	
	// NMNH #00729059
	'/^(?<institutionCode>NMNH)\s+(?<catalogNumber>#\d+)$/',
	
	
	// NMV<AUS>:B18114
	'/^(?<institutionCode>NMV)<AUS>:(?<catalogNumber>[A-Z]\d+)$/',

	// NMV A 25127-001
	'/^(?<institutionCode>NMV)\s+(?<catalogNumber>[A-Z]\s+\d+(-\d+)?)$/',
	
	// NMVD73979
	'/^(?<institutionCode>NMV)(?<catalogNumber>D\d+)$/',
	
	// NMV B.19428
	'/^(?<institutionCode>NMV)\s+(?<catalogNumber>[A-Z][\.|\s]\d+)$/',
	
	// NMV<AUS>:A29352-011
	'/^(?<institutionCode>NMV<AUS>):(?<catalogNumber>[A-Z]\d+(-\d+)?)$/',
	
	// NMV<AUS>:NMVD71314
	'/^(?<institutionCode>NMV<AUS>):NMV(?<catalogNumber>[A-Z]\d+(-\d+)?)$/',
	
	// NSMT-Cr 16019	
	'/^(?<institutionCode>NSMT)-(?<collectionCode>\w+)\s+(?<catalogNumber>\d+)$/',
	
	// NSMT:Mo.72212
	'/^(?<institutionCode>NSMT):(?<collectionCode>\w+)(\s+|\.|\-)(?<catalogNumber>\d+)$/',
	
	// NSMT Cr-14112
	'/^(?<institutionCode>NSMT)\s+(?<collectionCode>\w+)-(?<catalogNumber>\d+)$/',
	
	// OMNH<USA-OK>:23758
	'/^(?<institutionCode>OMNH)<USA-OK>:(?<catalogNumber>\d+)$/',
	
	
	// OMNH-P 21175
	'/^(?<institutionCode>OMNH)-(?<collectionCode>[P])\s+(?<catalogNumber>\d+)$/',
	
	// RMCA A.68708
	'/^(?<institutionCode>RMCA)\s+(?<collectionCode>A)\.(?<catalogNumber>\d+)$/',
	
	// RMNH.INS.13836
	'/^(?<institutionCode>RMNH)\.(?<collectionCode>.*)\.(?<catalogNumber>\d+)$/',
	
	// ROM-80112
	'/^(?<institutionCode>ROM)-(?<catalogNumber>.*)$/',

	
	// ROM MAM 107505
	'/^(?<institutionCode>ROM)\s+(?<collectionCode>[A-Z]+)\s+(?<catalogNumber>.*)$/',
	
	// S-R-5461
	'/^(?<institutionCode>S)(?<catalogNumber>-.*)$/',
	
	// SAM NN24373
	'/^(?<institutionCode>SAM)\s+(?<catalogNumber>[A-Z]{1,2}\d+)$/',
	
	// SAMA:B23004
	'/^(?<institutionCode>SAMA)[:](?<catalogNumber>[B]\d+)$/',
	
	// S07-4318
	'/^(?<catalogNumber>(?<institutionCode>S)\d+-\d+)$/',
	
	// TM<ZAF>:84805
	'/^(?<institutionCode>TM)<(?<collectionCode>ZAF)>[:]?(?<catalogNumber>\d+)$/',

	// TTU-Z030022
	'/^(?<institutionCode>TTU)-(?<catalogNumber>Z\d+)$/',
	
	// U.1772608
	'/^(?<institutionCode>U)(?<catalogNumber>\.\d+)$/',

	// UCMVZ 157675
	'/^UC(?<institutionCode>MVZ)\s+(?<catalogNumber>\d+)$/',
	
	// UF:UF10868
	'/^UF:(?<institutionCode>UF)(?<catalogNumber>\d+)$/',
	
	// USNM ENT 00907308
	'/^(?<institutionCode>USNM)\s*(?<collectionCode>ENT)\s+[0]*(?<catalogNumber>.*)$/',

	// USNMENT00802038
	'/^(?<institutionCode>USNM)(?<collectionCode>ENT)[0]*(?<catalogNumber>.*)$/',
	
	// UTA A51496
	'/^(?<institutionCode>UTA)\s+(?<catalogNumber>[A-Z]\d+)$/',
	
	// UTA:A-53924
	'/^(?<institutionCode>UTA):[A-Z]-(?<catalogNumber>\d+)$/',
	
	// UTA_56380
	'/^(?<institutionCode>UTA)_(?<catalogNumber>\d+)$/',

	// UTAR-51496
	'/^(?<institutionCode>UTA)[R]-(?<catalogNumber>\d+)$/',
	
	// UWBM Bu42872
	'/^(?<institutionCode>UWBM)\s*(?<catalogNumber>Bu\d+)$/',
	
	// WAM 26230-007
	'/^(?<institutionCode>WAM)\s+(?<catalogNumber>\d+(\-\d+)?)$/',	
	
	// WAM T111382
	'/^(?<institutionCode>WAM)(\s+|:)[A-Z](?<catalogNumber>\d+)$/',	
	
	// WAM P.30850-030
	'/^(?<institutionCode>WAM)\s+(?<catalogNumber>[A-Z]\.?\d+(-\d+)?)$/',
	
	// YPM
	'/^(?<institutionCode>YPM)\s+(?<collectionCode>[A-Z]+)\s+(?<catalogNumber>.*)$/',
	
	// YPM-IZ.043791
	'/^(?<institutionCode>YPM)-(?<collectionCode>[A-Z]+)\.(?<catalogNumber>.*)$/',
	

	// ZMB/Moll 60914
	'/^(?<institutionCode>ZMB\/Moll)\s+(?<catalogNumber>\d+)$/',
	
	
	// ZMUC AVES-095264
	'/^(?<institutionCode>ZMUC)\s+(?<catalogNumber>[A-Z]+-\d+)$/',
	
	// ZMO K 1247
	'/^(?<institutionCode>ZMO)\s+(?<catalogNumber>[A-Z]\s+\d+)$/',
	
	
	// ZRC.1.10224
	'/^(?<institutionCode>ZRC)[\s+|\.](?<catalogNumber>\d+\.\d+)$/',
	
	// ZSM
	'/^(?<institutionCode>ZSM)\s+(?<catalogNumber>.*)$/',
	
	// BC ZSM Lep 01338
	'/^(?<catalogNumber>.*\s+(?<institutionCode>ZSM)\s+(.*))$/',
	
	
	'/^(?<institutionCode>.*):(?<collectionCode>.*):(?<catalogNumber>.*)$/',
	
	'/^(?<institutionCode>[A-Z]+)(?<catalogNumber>\d+)$/',

	'/^(?<institutionCode>AM) (?<catalogNumber>[A-Z][-]?\d+)$/',

	'/^(?<institutionCode>[A-Z]+) (?<catalogNumber>[A-Z][-]?\d+)$/',
	
	'/^(?<institutionCode>[A-Z]+)[:|\-](?<catalogNumber>\d+)$/',	
	
	
	'/^(?<institutionCode>[A-Z]+) (?<catalogNumber>\d+\.\d+)$/',
	
	'/^(?<institutionCode>[A-Z]+\-[A-Z]+) (?<catalogNumber>\d+)$/',

	
	// default
	'/^(?<institutionCode>[A-Z]+)\s*(?<catalogNumber>\d+)$/'
);

//--------------------------------------------------------------------------------------------------
// Find catalog numbers with given prefix (handy to discover occurrences in GBIF)
// If limit = 0 we return array comprising just the input  $catalog_number
function extend_catalog_number($catalog_number, $limit = 10)
{
	$catalog_numbers = array();
	
	if ($limit == 0)
	{
		$catalog_numbers[] = $catalog_number;
	}
	else
	{
	
		$url = 'http://api.gbif.org/v1/occurrence/search/catalogNumber?q=' 
			. urlencode($catalog_number) . '&limit=' . $limit;

		$json = get($url);
	
		
		if ($json != '')
		{
			$hits = json_decode($json);
		
			// Include only those catalog numbers that start with $catalog_number
			foreach ($hits as $hit)
			{
				if (preg_match('/^' . $catalog_number . '($|[^\d+])/', $hit))
				{
					$catalog_numbers[] = $hit;
				}
			}
		}
	
		if (count($catalog_numbers) == 0)
		{
			$catalog_numbers[] = $catalog_number;
		}
	}
		
	return $catalog_numbers;
}

//--------------------------------------------------------------------------------------------------
// Convert specimen code to something we can query GBIF with
// If $extend is > 0 we call GBIF API to generate additional possible specimen codes
// resulting from suffixes being added.
function parse($verbatim_code, $extend = 10)
{
	global $patterns;
	
	$extend_by = $extend;
	
	$result = new stdclass;
	$result->text = $verbatim_code;
	$result->parsed = false;
		
	// Clean
	
	
	// Match
	foreach ($patterns as $pattern)
	{
		//echo $pattern . "<br/>";
		
		if (!$result->parsed)
		{
			if (preg_match($pattern, $result->text, $m))
			{
				$result->parsed = true;
				$result->pattern = $pattern;
				
				if (isset($m['institutionCode']))
				{			
					$result->institutionCode = $m['institutionCode'];
				}
				if (isset($m['collectionCode']))
				{			
					$result->collectionCode = $m['collectionCode'];
				}
				if (isset($m['catalogNumber']))
				{			
					$result->catalogNumber = $m['catalogNumber'];
				}
			}
		}
	}
	
	if ($result->parsed)
	{
		// post process
		if (isset($result->institutionCode))
		{
			$use_default = false; // default is institutionCode and catalogNumber
		
			$result->parameters = array();
					
			switch ($result->institutionCode)
			{
			
				//------------------------------------------------------------------------
				case 'A':
					// Harvard
					$parameters = array();
					$parameters['institutionCode'] = $result->institutionCode;
					$parameters['catalogNumber'] = 'barcode-' . $result->catalogNumber;
					$result->parameters[] = $parameters;
				
					$use_default = true;
					break;			
			
				//------------------------------------------------------------------------
				case 'AM':
					if (is_numeric($result->catalogNumber))
					{
						$prefixes = array('M','R','W');
						foreach ($prefixes as $prefix)
						{
							$parameters = array();
							$parameters['institutionCode'] = $result->institutionCode;
							$parameters['catalogNumber'] = $prefix . '.' . $result->catalogNumber;
							$result->parameters[] = $parameters;
						}
						$matched = true;
					}
					else
					{
						$parameters = array();
						$parameters['institutionCode'] = $result->institutionCode;
						$parameters['catalogNumber'] = preg_replace('/([A-Z])\.?\s*(\d+)/', '$1.$2', $result->catalogNumber);
						$result->parameters[] = $parameters;
					
						// extend (e.g., for molluscs)
						$catalog = $parameters['catalogNumber'];
						$catalog_numbers = extend_catalog_number($catalog, $extend_by);
					
						foreach ($catalog_numbers as $catalog_number)
						{
							$parameters['institutionCode'] = $result->institutionCode;
							$parameters['catalogNumber'] = $catalog_number;
							$result->parameters[] = $parameters;
						}
					}
					break;
					
				//------------------------------------------------------------------------
				case 'AMSR':
					if (is_numeric($result->catalogNumber))
					{
						$parameters = array();
						$parameters['institutionCode'] = 'AM';
						$parameters['catalogNumber'] = 'R.' . $result->catalogNumber;
						$result->parameters[] = $parameters;
						$matched = true;
					}
					else
					{
						$parameters = array();
						$parameters['institutionCode'] = 'AM';
						$parameters['catalogNumber'] = preg_replace('/([A-Z])\s*(\d+)/', '$1.$2', $result->catalogNumber);
						$result->parameters[] = $parameters;
					}
					break;						

				//------------------------------------------------------------------------
				case 'AMS':
					//$matched = false;
					if (is_numeric($result->catalogNumber))
					{
						$prefixes = array('I', 'M','R','W');
						foreach ($prefixes as $prefix)
						{
							$parameters = array();
							$parameters['institutionCode'] = 'AM';
							$parameters['catalogNumber'] = $prefix . '.' . $result->catalogNumber;
							$result->parameters[] = $parameters;
								
						}
						$matched = true;
					}
					else
					{
						$code = 'AM';
						$catalog = $result->catalogNumber;
						$catalog = preg_replace('/^([A-Z])[\.]?\s*(\d+(-\d+)?)$/', '$1.$2', $catalog);
						
						$catalog_numbers = extend_catalog_number($catalog, $extend_by);
						
						foreach ($catalog_numbers as $catalog_number)
						{
							$parameters = array();
							$parameters['institutionCode'] = $code;
							$parameters['catalogNumber'] = $catalog_number;
							$result->parameters[] = $parameters;
							
							
						}
						
						if (!preg_match('/\d+-\d+$/', $catalog))
						{
							// hyphenate catalog number
							$catalog = preg_replace('/([0-9]{3})$/', '-$1', $catalog);	
													
							$parameters = array();
							$parameters['institutionCode'] = $code;
							$parameters['catalogNumber'] = $catalog;
							$result->parameters[] = $parameters;							
						}
						
						/*
						$parameters = array();
						$parameters['institutionCode'] = 'AM';
						$parameters['catalogNumber'] = preg_replace('/([A-Z])\s*(\d+)/', '$1.$2', $result->catalogNumber);
						$result->parameters[] = $parameters;
						*/
					}
					break;
					
				//------------------------------------------------------------------------
				case 'A.M.N.H.':
				case 'AMNH':
				
					$institutionCode = $result->institutionCode;
					$institutionCode = str_replace(".", "", $institutionCode);
				
					$matched = false;
					
					
					if (isset($result->collectionCode) && ($result->collectionCode == 'Herpetology'))
					{
						unset($result->collectionCode);
					}
					
					$catalogNumber = $result->catalogNumber;
					if (preg_match('/\d+\.\d+/', $catalogNumber))
					{
						$catalogNumber = str_replace('.', '', $catalogNumber);
					}
					
					if (is_numeric($catalogNumber))
					{
						if (isset($result->collectionCode))
						{
							$parameters = array();
							$parameters['institutionCode'] = $institutionCode;
							$parameters['catalogNumber'] = $result->collectionCode . '-' . $catalogNumber;
							$result->parameters[] = $parameters;
							$matched = true;
						}
						else
						{					
							$prefixes = array('A', 'DOT', 'R', 'M', 'SKIN');
							foreach ($prefixes as $prefix)
							{
								$parameters = array();
								$parameters['institutionCode'] = $institutionCode;
								$parameters['catalogNumber'] = $prefix . '-' . $catalogNumber;
								$result->parameters[] = $parameters;
							}
							$matched = true;
						}
						
					}
					
					
					if (!$matched)
					{
						if (preg_match('/(?<prefix>[A-Z])(?<code>\d+)/', $result->catalogNumber, $m))
						{
							$parameters = array();
							$parameters['institutionCode'] = $institutionCode;
							$parameters['catalogNumber'] = $m['prefix'] . '-' . $m['code'];
							$result->parameters[] = $parameters;
							
							$matched = true;
						}							
					}					
									
					
					if (!$matched)
					{
						$parameters = array();
						$parameters['institutionCode'] = $institutionCode;
						$parameters['catalogNumber'] = $result->catalogNumber;
						$result->parameters[] = $parameters;
					}					
					break;
					
				//------------------------------------------------------------------------
				case 'ANWC':
					{
						if (preg_match('/(?<prefix>[A-Z])(?<code>\d+)/', $result->catalogNumber, $m))
						{
							$parameters = array();
							$parameters['institutionCode'] = $result->institutionCode;
							$parameters['catalogNumber'] = $m['prefix'] . str_pad($m['code'], 5,'0', STR_PAD_LEFT);
							$result->parameters[] = $parameters;
							
							$matched = true;
						}
						if (is_numeric($result->catalogNumber))
						{
							$parameters = array();

							$prefixes = array('B');
							foreach ($prefixes as $prefix)
								{
								$parameters['institutionCode'] = $result->institutionCode;
								$parameters['catalogNumber'] = $prefix . str_pad($result->catalogNumber, 5,'0', STR_PAD_LEFT);
								$result->parameters[] = $parameters;
							}
							$matched = true;
						
						}
					}
					break;
					
				//------------------------------------------------------------------------
				case 'Australian Museum':
				    if (preg_match('/(?<prefix>[A-Z])\s*(?<code>\d+)/', $result->catalogNumber, $m))
				    {
						$parameters = array();
						$parameters['institutionCode'] = 'AM';
						$parameters['catalogNumber'] = $m['prefix'] . '.' . $m['code'];
						$result->parameters[] = $parameters;
						
						$matched = true;
					}
					break;
					
				//------------------------------------------------------------------------
				case 'B':
					$parameters = array();
					$parameters['institutionCode'] = $result->institutionCode;
					$parameters['collectionCode'] = 'Herbarium Berolinense';
					$parameters['catalogNumber'] = $result->institutionCode . ' ' . str_replace('_', ' ', $result->catalogNumber);
					$result->parameters[] = $parameters;
							
					$use_default = true;
					break;
					
																
				//------------------------------------------------------------------------
				case 'BBM-NG':
					$parameters = array();
					$parameters['institutionCode'] = 'BPBM';
					$parameters['catalogNumber'] = $result->catalogNumber;
					$result->parameters[] = $parameters;
					
					// could use BSIP, but not sure how many variants there are...
					// see http://www.gbif.org/occurrence/93659031 for an example
					break;
					
				//------------------------------------------------------------------------
				case 'BBM-BSIP':
					$parameters = array();
					$parameters['institutionCode'] = 'BPBM';
					$parameters['catalogNumber'] = $result->catalogNumber;
					$result->parameters[] = $parameters;
					
					// could use BSIP, but not sure how many variants there are...
					// see http://www.gbif.org/occurrence/93659031 for an example
					break;
					
				//------------------------------------------------------------------------
				case 'BIOUG':
					$parameters = array();
					$parameters['institutionCode'] = 'Biodiversity Institute of Ontario';
					$parameters['catalogNumber'] = $result->catalogNumber;
					$result->parameters[] = $parameters;
					break;			
					
				//------------------------------------------------------------------------
				case 'BISH':
					$parameters = array();
					$parameters['institutionCode'] = 'BPBM';
					$parameters['collectionCode'] = $result->institutionCode;
					$parameters['otherCatalogNumbers'] = 'Barcode: ' . $result->institutionCode . $result->catalogNumber;
					$result->parameters[] = $parameters;
					break;				
						
					
				//------------------------------------------------------------------------
				case 'BM':
				case 'BM(NH)':
				case 'BMNH':
				case 'BM (NH)':
					$parameters = array();
					$parameters['institutionCode'] = 'NHMUK';
					
					$catalogNumber = $result->catalogNumber;
					$catalogNumber = preg_replace('/:\s*/', '.', $catalogNumber);
					$catalogNumber = preg_replace('/–/u', '-', $catalogNumber);
					
					$parameters['catalogNumber'] = $catalogNumber;
					$result->parameters[] = $parameters;
					
					// Tweaks
					$prefixes = array();
					if (preg_match('/^[0-9]{2}\./', $catalogNumber))
					{
						$prefixes[] = '18';
						$prefixes[] = '19';
						$prefixes[] = 'ZD 18';
						$prefixes[] = 'ZD 19';
					}
					if (preg_match('/^[0-9]{1}\./', $catalogNumber))
					{
						$prefixes[] = '190';
						$prefixes[] = 'ZD 190';
					}
					if (preg_match('/^[0-9]{4}\./', $catalogNumber))
					{
						$prefixes[] = 'ZD.';
					}
					
					if (preg_match('/^0\d+$/', $catalogNumber))
					{
						$prefixes[] = 'BM';
					}

					foreach ($prefixes as $prefix)
					{
						$parameters = array();
						$parameters['institutionCode'] = 'NHMUK';
						$parameters['catalogNumber'] = $prefix . $catalogNumber;
						$result->parameters[] = $parameters;
					}
					
					// Some BMNH numbers are truncated in the database
					if (preg_match('/^(?<decade>[0-9]{2})(?<rest>[0-9]{2}\.(.*))$/', $catalogNumber, $m))
					{
						$parameters = array();
						$parameters['institutionCode'] = 'NHMUK';
						$parameters['catalogNumber'] = $m['rest'];
						$result->parameters[] = $parameters;
					}					
					break;	
					
				case 'BMNH(E)':
				case 'BMNH (E)':
					$parameters = array();
					$parameters['institutionCode'] = 'NHMUK';
					$parameters['catalogNumber'] = 'BMNH(E)' . $result->catalogNumber;
					$result->parameters[] = $parameters;				
					break;
								
					
				//------------------------------------------------------------------------
				case 'BOL':
					$parameters = array();
					$parameters['institutionCode'] = 'BOLUSHERB';
					$parameters['catalogNumber'] = $result->catalogNumber;
					$result->parameters[] = $parameters;
					break;		
					
				//------------------------------------------------------------------------
				case 'BR':
					$parameters = array();
					$parameters['institutionCode'] = 'MeiseBG';
					$parameters['collectionCode'] = $result->institutionCode;
					$parameters['catalogNumber'] = $result->institutionCode . $result->catalogNumber;
					$result->parameters[] = $parameters;
				
					$parameters = array();
					$parameters['institutionCode'] = $result->institutionCode;
					$parameters['catalogNumber'] = $result->institutionCode . $result->catalogNumber;
					$result->parameters[] = $parameters;
					break;
					
				//------------------------------------------------------------------------
				case 'BRIT':
					$parameters = array();
					$parameters['institutionCode'] = $result->institutionCode;
					$parameters['catalogNumber']  = $result->institutionCode . $result->catalogNumber;
					$result->parameters[] = $parameters;
					break;	
					
				//------------------------------------------------------------------------
				case 'BRLU':
					$parameters = array();
					$parameters['institutionCode'] = 'ULB';
					$parameters['collectionCode'] = $result->institutionCode;
					$parameters['catalogNumber']  = $result->institutionCode . $result->catalogNumber;
					$result->parameters[] = $parameters;
					break;										
					
				//------------------------------------------------------------------------
				case 'BSIP':
					$parameters = array();
					$parameters['institutionCode'] = 'BPBM';
					$parameters['catalogNumber'] = $result->catalogNumber;
					$result->parameters[] = $parameters;
					break;	
					
				//------------------------------------------------------------------------
				case 'CANB':
					$parameters = array();
					$parameters['institutionCode'] = $result->institutionCode;
					$parameters['collectionCode'] = $result->institutionCode;
					$parameters['catalogNumber'] = $result->institutionCode . ' ' . $result->catalogNumber . '.1';
					$result->parameters[] = $parameters;

					$parameters = array();
					$parameters['institutionCode'] = $result->institutionCode;
					$parameters['collectionCode'] = $result->institutionCode;
					$parameters['catalogNumber'] = $result->institutionCode . ' ' . $result->catalogNumber . '.2';
					$result->parameters[] = $parameters;
					
					$use_default = true;
					break;
					
				//------------------------------------------------------------------------
				case 'CAS':
					$matched = false;
					if (!$matched)
					{
						if (preg_match('/^0+(?<code>\d+)/', $result->catalogNumber, $m))
						{
							$matched = true;
							$parameters = array();
							$parameters['institutionCode'] = $result->institutionCode;
							$parameters['catalogNumber'] = $m['code'] . '.0';
							$result->parameters[] = $parameters;
						}							
						
					}
					
					if (is_numeric($result->catalogNumber))
					{
						$parameters = array();
						$parameters['institutionCode'] = $result->institutionCode;
						$parameters['catalogNumber'] = preg_replace('/^0+/', '', $result->catalogNumber);
						$result->parameters[] = $parameters;
									
					}
					
					if (!$matched)
					{
						$parameters = array();
						$parameters['institutionCode'] = $result->institutionCode;
						$parameters['catalogNumber'] = $result->catalogNumber . '.0';
						$result->parameters[] = $parameters;
						
						$use_default = true;
					}
					break;
					
				//------------------------------------------------------------------------
				case 'CAS-SU':
					$parameters = array();
					$parameters['institutionCode'] = 'CAS';
					$parameters['catalogNumber'] = $result->catalogNumber;
					$result->parameters[] = $parameters;
					break;	
					
				/*
				case 'CASENT':
					$matched = false;
					if (!$matched)
					{
						$parameters = array();
						$parameters['institutionCode'] = 'CAS';
						$parameters['collectionCode'] = 'ENT';
						$parameters['catalogNumber'] = $result->catalogNumber;
						$result->parameters[] = $parameters;
					}
					break;	
				*/
				//------------------------------------------------------------------------
				case 'CASENT':
					$matched = false;
					if (!$matched)
					{
						$parameters = array();
						$parameters['institutionCode'] = 'CAS';
						$parameters['collectionCode'] = 'ANTWEB';
						$parameters['catalogNumber'] = strtolower('casent' . $result->catalogNumber);
						$result->parameters[] = $parameters;
					}
					break;	
										
				//------------------------------------------------------------------------
				case 'CASIZ':
					$matched = false;
					if (!$matched)
					{
						if (preg_match('/^(0)?(?<code>\d+)/', $result->catalogNumber, $m))
						{
							$matched = true;
							$parameters = array();
							$parameters['institutionCode'] = 'CAS';
							$parameters['collectionCode'] = 'IZ';
							$parameters['catalogNumber'] = $m['code'] . '.0';
							$result->parameters[] = $parameters;
						}													
					}
					break;	
					
				//------------------------------------------------------------------------
				case 'CASTYPE':
					$matched = false;
					if (!$matched)
					{
						$parameters = array();
						$parameters['institutionCode'] = 'CASC';
						$parameters['collectionCode'] = 'CASTYPE';
						$parameters['catalogNumber'] = $result->institutionCode . $result->catalogNumber;
						$result->parameters[] = $parameters;
					}
					break;	
					
				//------------------------------------------------------------------------
				case 'CIB':
					$matched = false;
					if (is_numeric($result->catalogNumber))
					{
						$parameters = array();
						$parameters['institutionCode'] = $result->institutionCode;
						$parameters['catalogNumber'] = $result->institutionCode . $result->catalogNumber;
						$result->parameters[] = $parameters;
						$matched = true;
					}
					
					$use_default = true;
					break;	
					
					
				//------------------------------------------------------------------------
				case 'CM':
					$matched = false;
					if (is_numeric($result->catalogNumber))
					{
						$prefixes = array('P');
						foreach ($prefixes as $prefix)
						{
							$parameters = array();

							$catalog_numbers = extend_catalog_number($prefix . $result->catalogNumber, $extend_by);
					
							foreach ($catalog_numbers as $catalog_number)
							{
								$parameters = array();
								$parameters['institutionCode'] = $result->institutionCode;
								$parameters['catalogNumber'] = $catalog_number;
								$result->parameters[] = $parameters;
							}
						}
						$matched = true;
					}
										
					$use_default = true;
					break;	
					
				//------------------------------------------------------------------------
				case 'CMNH':
					// Cincinatti 
					{
						$parameters = array();
						$parameters['institutionCode'] = 'CMC';
						$parameters['catalogNumber'] = $result->catalogNumber;
						$result->parameters[] = $parameters;
						
						// birds
						if (is_numeric($result->catalogNumber))
						{
							$prefixes = array('B');
							foreach ($prefixes as $prefix)
							{
								$parameters = array();
								$parameters['institutionCode'] = 'CMC';
								$parameters['catalogNumber'] = $prefix . $result->catalogNumber;
								$result->parameters[] = $parameters;
							}
						}
					}					
										
					$use_default = true;
					break;						
					
				//------------------------------------------------------------------------
				case 'CNMA':
				case 'CNM':
				case 'CNCR':
					$parameters = array();
					$parameters['collectionCode'] = $result->institutionCode;
					$parameters['institutionCode'] = 'IBUNAM';
					$parameters['catalogNumber'] = $result->catalogNumber;
					$result->parameters[] = $parameters;						
					break;		
					
				//------------------------------------------------------------------------
				case 'COL':
					$parameters = array();
					$parameters['institutionCode'] = 'Universidad Nacional de Colombia (UNAL)';
					$parameters['collectionCode'] = $result->institutionCode;					
					$parameters['otherCatalogNumbers'] = $result->institutionCode . $result->catalogNumber;
					$result->parameters[] = $parameters;

					$use_default = true;
					break;				
					
				//------------------------------------------------------------------------
				case 'CSIRO':
					$matched = false;
					if (preg_match('/(?<prefix>[A-Z])\s+(?<code>\d+\s*-\s*\d+)/', $result->catalogNumber, $m))
					{
						$matched = true;
						$parameters = array();
						$parameters['institutionCode'] = $result->institutionCode;
						$parameters['catalogNumber'] = $m['prefix'] . preg_replace('/\s+/', '', $m['code']);
						$result->parameters[] = $parameters;
						
					}
					
					if (!$matched)
					{
						$use_default = true;
					}
					break;
					
				//------------------------------------------------------------------------
				case 'DOT': // AMNH birds by themselves
					$matched = false;
					if (is_numeric($result->catalogNumber))
					{
						$parameters = array();
						$parameters['institutionCode'] = 'AMNH';
						$parameters['catalogNumber'] = 'DOT-' . $result->catalogNumber;
						$result->parameters[] = $parameters;
						$matched = true;
					}
					break;	
					
				//------------------------------------------------------------------------
				case 'E':
					if (is_numeric($result->catalogNumber))
					{
						$parameters = array();
						$parameters['institutionCode'] = $result->institutionCode;
						$parameters['catalogNumber'] = $result->institutionCode . $result->catalogNumber;
						$result->parameters[] = $parameters;

						// living
						$parameters['institutionCode'] = $result->institutionCode;
						$parameters['catalogNumber'] = $result->catalogNumber;
						$result->parameters[] = $parameters;
					}
					break;
					
				//------------------------------------------------------------------------
				case 'F0BN': 
					// WTF
					$parameters = array();
					$parameters['institutionCode'] = 'B';
					$parameters['collectionCode'] = 'FMNH-B-Types';
					$parameters['catalogNumber'] = $result->catalogNumber;
					$result->parameters[] = $parameters;
					break;	
					
				//------------------------------------------------------------------------
				case 'F':
					if (preg_match('/\d+F$/', $result->catalogNumber))
					{
						$parameters = array();
						$parameters['institutionCode'] = 'F';
						$parameters['collectionCode'] = 'Botany';
						$parameters['catalogNumber'] = 'V' . $result->catalogNumber;	
						$result->parameters[] = $parameters;				
					}
					
					$use_default = true;
					break;
					
				//------------------------------------------------------------------------
				case 'FLMNH':
					// Some UF material has FLMNH as institution code
					$catalog_numbers = extend_catalog_number($result->catalogNumber, $extend_by);
					
					foreach ($catalog_numbers as $catalog_number)
					{
						$parameters = array();
						
						// UF
						$parameters['institutionCode'] = 'UF';
						$parameters['catalogNumber'] = $catalog_number;
						$result->parameters[] = $parameters;
						
						// 						
						$parameters['institutionCode'] = $result->institutionCode;
						$parameters['catalogNumber'] = $catalog_number;
						$result->parameters[] = $parameters;
						
						// add extra bits of crazy
						$parameters['institutionCode'] = $result->institutionCode;
						$parameters['catalogNumber'] = $catalog_number . '-Arthropoda';
						$result->parameters[] = $parameters;

						$parameters['institutionCode'] = $result->institutionCode;
						$parameters['catalogNumber'] = $catalog_number . '-Mollusca';
						$result->parameters[] = $parameters;

					}
					break;	
					
				//------------------------------------------------------------------------
				case 'GB':
					// Harvard
					$parameters = array();
					$parameters['institutionCode'] = $result->institutionCode;
					$parameters['catalogNumber'] = $result->institutionCode . '-' . $result->catalogNumber;
					$result->parameters[] = $parameters;
				
					$use_default = true;
					break;			
					
					
				//------------------------------------------------------------------------
				case 'GH':
					// Harvard
					$parameters = array();
					$parameters['institutionCode'] = $result->institutionCode;
					$parameters['catalogNumber'] = 'barcode-' . $result->catalogNumber;
					$result->parameters[] = $parameters;
				
					$use_default = true;
					break;			
					
					
				//------------------------------------------------------------------------
				// HBG
				case 'HBG':
					{
						$parameters = array();
						$parameters['institutionCode'] = $result->institutionCode;
						$parameters['catalogNumber'] = $result->institutionCode . $result->catalogNumber;
						$result->parameters[] = $parameters;
					}				
				
					$use_default = true;
					break;
					
					
				//------------------------------------------------------------------------
				case 'INPA':
					// Create for mammals
					$parameters = array();
					$parameters['institutionCode'] = 'Instituto Nacional de Pesquisas da Amazônia (INPA)';
					$parameters['catalogNumber'] = 'INPA-ICT ' . str_pad($result->catalogNumber, 6,'0', STR_PAD_LEFT);
					$result->parameters[] = $parameters;			
					
					$use_default = true;
					break;
					
				//------------------------------------------------------------------------
				case 'K':
					if (is_numeric($result->catalogNumber))
					{
						$parameters = array();
						$parameters['institutionCode'] = $result->institutionCode;
						$parameters['catalogNumber'] = $result->institutionCode . $result->catalogNumber;
						$result->parameters[] = $parameters;
					}
					break;	
					
				//------------------------------------------------------------------------
				case 'KU':
					if (isset($result->collectionCode))
					{
						$parameters = array();
						$parameters['institutionCode'] = $result->institutionCode;
						switch ($result->collectionCode)
						{
							// tissue collection
							case 'IT':
								$parameters['collectionCode'] = 'KUIT';
								$parameters['catalogNumber'] = preg_replace('/^0+/', '', $result->catalogNumber);
								break;
								
							default:
								$parameters['institutionCode'] = $result->institutionCode;
								$parameters['catalogNumber'] = $result->catalogNumber;
								break;
						}
						$result->parameters[] = $parameters;
					}
					
					$use_default = true;
					break;	
					
				//------------------------------------------------------------------------
				case 'KUT':
					$parameters = array();
					$parameters['institutionCode'] = 'KU';
					$parameters['collectionCode'] = 'KUIT';
					$parameters['catalogNumber'] = preg_replace('/^0+/', '', $result->catalogNumber);
					$result->parameters[] = $parameters;
					break;				
													
					
				//------------------------------------------------------------------------
				case 'KUNHM':
				case 'UKMNH': // e.g., http://dx.doi.org/10.1016/j.ympev.2006.12.004
					$parameters = array();
					$parameters['institutionCode'] = 'KU';
					$parameters['catalogNumber'] = $result->catalogNumber;
					$result->parameters[] = $parameters;
					break;
					
				//------------------------------------------------------------------------
				case 'LACM':
					// Create for mammals
					$parameters = array();
					$parameters['institutionCode'] = $result->institutionCode;
					$parameters['collectionCode'] = 'Mammals';
					$parameters['catalogNumber'] = str_pad($result->catalogNumber, 6,'0', STR_PAD_LEFT);
					$result->parameters[] = $parameters;			
					
					$use_default = true;
					break;

				//------------------------------------------------------------------------
				case 'L':
					$parameters = array();
					$parameters['institutionID'] = 'Naturalis Biodiversity Center';
					$parameters['catalogNumber'] = 'L  ' . $result->catalogNumber;
					$result->parameters[] = $parameters;			
					
					$use_default = true;
					break;

				//------------------------------------------------------------------------
				case 'MA':
					$parameters = array();
					$parameters['institutionID'] = $result->institutionCode;
					$parameters['catalogNumber'] = $result->institutionCode . '-01-' . str_pad($result->catalogNumber, 8, '0', STR_PAD_LEFT);
					$result->parameters[] = $parameters;	
					
					$use_default = true;
					break;
					
				//------------------------------------------------------------------------
				case 'MCZ':
					$matched = false;
					if (!$matched)
					{
						if (preg_match('/^(?<prefix>[A|R])\.?(?<code>\d+)/', $result->catalogNumber, $m))
						{
							$matched = true;
							$parameters = array();
							$parameters['institutionCode'] = $result->institutionCode;
							$parameters['catalogNumber'] = $m['prefix'] . '-' . $m['code'];
							$result->parameters[] = $parameters;
							
							$matched = true;
						}							
						
					}
					
					if (!$matched)
					{
						$prefixes = array('A', 'R');
						foreach ($prefixes as $prefix)
						{
							$parameters = array();
							$parameters['institutionCode'] = $result->institutionCode;
							$parameters['catalogNumber'] = $prefix . '-' . $result->catalogNumber;
							$result->parameters[] = $parameters;
						}					
					}
					
					$use_default = true;
					break;
					
				//------------------------------------------------------------------------
				case 'MEL':
					$parameters = array();
					$parameters['institutionCode'] = $result->institutionCode;
					$parameters['collectionCode'] = $result->institutionCode;
					$parameters['catalogNumber'] = $result->institutionCode . ' ' . str_pad($result->catalogNumber, 7, '0', STR_PAD_LEFT) . 'A';
					$result->parameters[] = $parameters;
					
					$use_default = true;
					break;
				
				//------------------------------------------------------------------------
				case 'MEXU':
				case 'MEXUBR':
					$parameters = array();
					$parameters['collectionCode'] = $result->institutionCode;
					$parameters['institutionCode'] = 'IBUNAM';
					$parameters['catalogNumber'] = $result->catalogNumber;
					$result->parameters[] = $parameters;						
					break;				
										
				//------------------------------------------------------------------------
				case 'MHNG':
					$matched = false;
					{
						$prefixes = array('MAM');
						foreach ($prefixes as $prefix)
						{
							$parameters = array();
							$parameters['institutionCode'] = $result->institutionCode;
							$parameters['catalogNumber'] = $result->institutionCode . '-' . $prefix . '-' . $result->catalogNumber;
							$result->parameters[] = $parameters;
						}
					}
					
					// default
					if (!$matched)
					{
						$use_default = true;
					}
					break;
									
				//------------------------------------------------------------------------
				case 'MNHN':
					$matched = false;
					if (!$matched)
					{
						if (isset($result->collectionCode) && ($result->collectionCode == 'IM') && is_numeric($result->catalogNumber))
						{
							if (preg_match('/^(?<one>[0-9]{4})(?<two>\d+)$/', $result->catalogNumber, $m))
							{
								$matched = true;
								$parameters = array();
								$parameters['institutionCode'] = $result->institutionCode;
								$parameters['catalogNumber'] = $m['one'] . '-' . $m['two'];
								$result->parameters[] = $parameters;
							}
						}
					
					
						if (preg_match('/^[0-9]{4}$/', $result->catalogNumber))
						{
						
							$matched = true;
							$parameters = array();
							$parameters['institutionCode'] = $result->institutionCode;
							$parameters['catalogNumber'] = '0.' . $result->catalogNumber;
							$result->parameters[] = $parameters;
						}		
						
																	
						if (preg_match('/^(?<one>[0-9]{4})[-|\.|_](?<two>\d+)/', $result->catalogNumber, $m))
						{
						
							$matched = true;
							
							// '-' 
							$parameters = array();
							$parameters['institutionCode'] = $result->institutionCode;
							$parameters['catalogNumber'] = $m['one'] . '-' . str_pad($m['two'], 4,'0', STR_PAD_LEFT);
							$result->parameters[] = $parameters;
							
							/*
							// trim zero padding
							if (preg_match('/^0+(?<nonzero>\d+)$/', $m['two'], $mm))
							{
								$parameters = array();
								$parameters['institutionCode'] = $result->institutionCode;
								$parameters['catalogNumber'] = $m['one'] . '-' . $mm['nonzero'];
								$result->parameters[] = $parameters;
							}			
							*/				
							
							// prefixes (e.g., bird collection
							$prefixes = array('IE','MO');
							foreach ($prefixes as $prefix)
							{
								$parameters = array();
								$parameters['institutionCode'] = $result->institutionCode;
								$parameters['catalogNumber'] = 'MO-' . $m['one'] . '-' . $m['two'];
								$result->parameters[] = $parameters;
							}

							// '.'
							$parameters = array();
							$parameters['institutionCode'] = $result->institutionCode;
							$parameters['catalogNumber'] = $m['one'] . '.' . $m['two'];
							$result->parameters[] = $parameters;

						}
						if (preg_match('/([A-Z]+)\s+(\d+)$/', $result->catalogNumber))
						{						
							$matched = true;
							$parameters = array();
							$parameters['institutionCode'] = $result->institutionCode;
							$parameters['catalogNumber'] = preg_replace('/\s+/', '', $result->catalogNumber);
							$result->parameters[] = $parameters;
						}													
																			
					}
					// default
					if ($matched)
					{
						$use_default = true;
					}
					break;
					
				//------------------------------------------------------------------------
				// MPEG
				case 'MPEG':
					{
						$prefixes = array('ARA', 'HOP', 'ICT', 'OPE');
						foreach ($prefixes as $prefix)
						{
							$parameters = array();
							$parameters['institutionCode'] = $result->institutionCode;
							$parameters['catalogNumber'] = $result->institutionCode . '.' . $prefix . ' ' . str_pad($result->catalogNumber, 6,'0', STR_PAD_LEFT);
							$result->parameters[] = $parameters;
						}
					}				
				
					$use_default = true;
					break;
					
				//------------------------------------------------------------------------
				// MPU
				case 'MPU':
					{
						$parameters = array();
						$parameters['institutionCode'] = 'UM';
						$parameters['catalogNumber'] = $result->institutionCode . $result->catalogNumber;
						$result->parameters[] = $parameters;
					}				
				
					$use_default = true;
					break;
					
				//------------------------------------------------------------------------
				case 'MSC':
					$parameters = array();
					$parameters['institutionCode'] = $result->institutionCode;
					$parameters['catalogNumber'] = $result->institutionCode . $result->catalogNumber;
					$result->parameters[] = $parameters;						
					break;				
					
				//------------------------------------------------------------------------
				// Colección de Mamíferos del Museo de Zoología 'Alfonso L . Herrera', México (MZFC, UNAM)
				case 'MZFC':
					$parameters = array();
					$parameters['institutionCode'] = 'FCUNAM';
					$parameters['catalogNumber'] = $result->catalogNumber;
					$result->parameters[] = $parameters;
					
					$use_default = true;
					break;
					
				//------------------------------------------------------------------------
				case 'NHM':
					$parameters = array();
					$parameters['institutionCode'] = 'NHMUK';
					$parameters['catalogNumber'] = $result->catalogNumber;
					$result->parameters[] = $parameters;
					break;	

				case 'NHM-UK':
					$parameters = array();
					$parameters['institutionCode'] = 'NHMUK';
					$parameters['catalogNumber'] = $result->catalogNumber;
					$result->parameters[] = $parameters;
					break;	

				case 'NHMUK':
					$parameters = array();
					$parameters['institutionCode'] = 'NHMUK';
					$parameters['catalogNumber'] = $result->catalogNumber;
					$result->parameters[] = $parameters;

					$parameters = array();
					$parameters['institutionCode'] = 'NHMUK';
					$parameters['catalogNumber'] = 'NHMUK' . $result->catalogNumber;
					$result->parameters[] = $parameters;

					break;	

				//------------------------------------------------------------------------
				// NMNH (Smithsonian)
				case 'NMNH':
					$catalog_number = $result->catalogNumber;
					$catalog_number = preg_replace('/^#[0]*/', '', $catalog_number);
					$catalog_numbers = extend_catalog_number($catalog_number, $extend_by);
					
					foreach ($catalog_numbers as $catalog_number)
					{
						$parameters = array();
						$parameters['institutionCode'] = 'USNM';
						$parameters['catalogNumber'] = $catalog_number;
						$result->parameters[] = $parameters;
					}
					break;					
					
				//------------------------------------------------------------------------
				case 'MV': // e.g. PLoS http://dx.doi.org/10.1371/journal.pone.0024047
				case 'NMV':
				case 'NMV<AUS>':
					$matched = false;
					if (!$matched)
					{
						if (preg_match('/^(NMV)?(?<prefix>[A-Z])(?<code>\d+(-\d+)?)$/', $result->catalogNumber, $m))
						{
						
							$matched = true;
							$parameters = array();
							$parameters['institutionCode'] = 'NMV';
							$parameters['catalogNumber'] = $m['prefix'] . ' ' . $m['code'];
							$result->parameters[] = $parameters;
						}													
						if (preg_match('/^(?<prefix>[A-Z])\.?(?<code>\d+(-\d+)?)$/', $result->catalogNumber, $m))
						{
						
							$matched = true;
							$parameters = array();
							$parameters['institutionCode'] = 'NMV';
							$parameters['catalogNumber'] = $m['prefix'] . ' ' . $m['code'];
							$result->parameters[] = $parameters;
						}													
					}
				
					$use_default = true;
					break;
					
				//------------------------------------------------------------------------
				case 'NSMT':
					$matched = false;
					// Triple
					if (isset($result->collectionCode))
					{
						$matched = true;
						$parameters = array();
						$parameters['institutionCode'] = $result->institutionCode;
						$parameters['collectionCode'] = $result->collectionCode;
						$parameters['catalogNumber'] = $result->catalogNumber;
						$result->parameters[] = $parameters;					
					}
					// default
					if (!$matched)
					{
						$use_default = true;
					}
					break;				
									
				//------------------------------------------------------------------------
				case 'NSW':
					if (is_numeric($result->catalogNumber))
					{
						$parameters = array();
						$parameters['institutionCode'] = $result->institutionCode;
						$parameters['catalogNumber'] = $result->institutionCode . ' ' . $result->catalogNumber;
						$result->parameters[] = $parameters;
						$matched = true;

						$parameters = array();
						$parameters['institutionCode'] = $result->institutionCode;
						$parameters['catalogNumber'] = $result->institutionCode . $result->catalogNumber;
						$result->parameters[] = $parameters;
						$matched = true;
					}
					$use_default = true;
					break;
					
				//------------------------------------------------------------------------
				case 'NY':
					if (is_numeric($result->catalogNumber))
					{
						$parameters = array();
						$parameters['institutionCode'] = $result->institutionCode;
						$parameters['catalogNumber'] = preg_replace('/^0+/', '', $result->catalogNumber);
						$result->parameters[] = $parameters;
						$matched = true;
					}
					$use_default = true;
					break;
				

				//------------------------------------------------------------------------
				// Paris herbarium
				case 'P':
					if (is_numeric($result->catalogNumber))
					{
						$parameters = array();
						$parameters['institutionCode'] = 'MNHN';
						$parameters['catalogNumber'] = $result->institutionCode . $result->catalogNumber;
						$result->parameters[] = $parameters;
					}
					break;	
					
				//------------------------------------------------------------------------
				case 'QRS':
					$parameters = array();
					$parameters['institutionCode'] = 'CNS';
					$parameters['collectionCode'] = 'CNS';
					$parameters['catalogNumber'] = $result->institutionCode . ' ' . $result->catalogNumber . '.1';
					$result->parameters[] = $parameters;
					
					$use_default = true;
					break;
					
					
				//------------------------------------------------------------------------
				case 'R':
					{
					
						$parameters = array();
						$parameters['institutionCode'] = 'MN';
						$parameters['catalogNumber'] = preg_replace('/^0+/', '', $result->catalogNumber);
						$result->parameters[] = $parameters;					
					}				
				
					$use_default = true;
					break;	
					
					
				//------------------------------------------------------------------------
				case 'RB':
					$parameters = array();
					$parameters['institutionCode'] = 'JBRJ'; 
					$parameters['collectionCode'] = 'RB'; 
					$parameters['catalogNumber'] = $result->institutionCode . $result->catalogNumber;
					$result->parameters[] = $parameters;					
					break;
				
					
				//------------------------------------------------------------------------
				case 'RBINS':
					$parameters = array();
					$parameters['institutionCode'] = 'Royal Belgian Institute of natural Sciences'; // seriously
					$parameters['catalogNumber'] = $result->catalogNumber;
					$result->parameters[] = $parameters;					
					break;

				//------------------------------------------------------------------------
				case 'RMCA':	
					// swap letters in acronym			
					$parameters = array();
					$parameters['institutionCode'] = 'MRAC'; // WTF?
					$parameters['catalogNumber'] = $result->catalogNumber;
					$result->parameters[] = $parameters;
					
					// http://www.gbif.org/dataset/7baada30-f762-11e1-a439-00145eb45e9a
					// create larger catalogue number	
					if (isset($result->collectionCode))
					{
						$parameters = array();
						$parameters['institutionCode'] = $result->institutionCode;
						$parameters['catalogNumber'] = $result->institutionCode . ' ' . $result->collectionCode . '.' . $result->catalogNumber;
						$result->parameters[] = $parameters;
					}

					$use_default = true;
					break;

				//------------------------------------------------------------------------
				case 'RMNH':
					$matched = false;
					
					if (!$matched)
					{
						if (isset($result->collectionCode))
						{
							$parameters = array();
							$parameters['institutionCode'] = $result->institutionCode;
							$parameters['catalogNumber'] = $result->institutionCode . '.' . $result->collectionCode . '.' . $result->catalogNumber;
							$result->parameters[] = $parameters;

							$parameters['institutionCode'] = 'Naturalis';
							$parameters['catalogNumber'] = $result->institutionCode . '.' . $result->collectionCode. '.' . $result->catalogNumber;
							$result->parameters[] = $parameters;
							
							$matched = true;					
						}
					}
										
					if (!$matched)
					{				
						if (is_numeric($result->catalogNumber))
						{
							// Institution.prefix.catalogue
							$prefixes = array('ARA', 'AVES', 'CRUS.A', 'CRUS.D','INS', 'MAM', 'MOL', 'RENA');
							foreach ($prefixes as $prefix)
							{
								$parameters = array();
								$parameters['institutionCode'] = $result->institutionCode;
								$parameters['catalogNumber'] = $result->institutionCode . '.' . $prefix . '.' . $result->catalogNumber;
								$result->parameters[] = $parameters;

								$parameters['institutionCode'] = 'Naturalis';
								$parameters['catalogNumber'] = $result->institutionCode . '.' . $prefix . '.' . $result->catalogNumber;
								$result->parameters[] = $parameters;
							}
							$matched = true;
						}
					}					

					$use_default = true;
					break;
					
				//------------------------------------------------------------------------
				case 'RSA':
					$parameters = array();
					$parameters['institutionCode'] = $result->institutionCode;
					$parameters['collectionCode'] = $result->institutionCode;
					$parameters['catalogNumber'] = $result->institutionCode . $result->catalogNumber;
					$result->parameters[] = $parameters;
					
					$use_default = true;
					break;
					
					
				//------------------------------------------------------------------------
				case 'S':
					if (preg_match('/^-/', $result->catalogNumber))
					{
						$parameters = array();
						$parameters['institutionCode'] = $result->institutionCode;
						$parameters['catalogNumber'] = $result->institutionCode . $result->catalogNumber;	
						$result->parameters[] = $parameters;				
					}
					
					$use_default = true;
					break;
					

				//------------------------------------------------------------------------
				case 'SAMAR':
					if (is_numeric($result->catalogNumber))
					{
						$parameters = array();
						$parameters['institutionCode'] = 'SAMA';
						$parameters['catalogNumber'] = 'R' . $result->catalogNumber;
						$result->parameters[] = $parameters;
						$matched = true;
					}
					
					$use_default = true;
					break;
					
				//------------------------------------------------------------------------
				case 'NTM':
					{
						$parameters = array();
						$parameters['institutionCode'] = 'NT';
						
						if (preg_match('/^(?<prefix>[A-Z])(?<code>\d+)/', $result->catalogNumber, $m))
						{
							$parameters['catalogNumber'] = $m['prefix'] . '.' . $m['code'];
						}
						else
						{						
							$parameters['catalogNumber'] = $result->catalogNumber;
						}
						$result->parameters[] = $parameters;
					}
					
					$use_default = true;
					break;
					
				//------------------------------------------------------------------------
				// Sam Nobel Museum Oklahoma
				// Osaka Museum of Natural History
				case 'OMNH':
				    if (isset($result->collectionCode))
				    {
						$parameters = array();
						$parameters['institutionCode'] = 'OMNH';
						$parameters['collectionCode'] = $result->collectionCode;
						$parameters['catalogNumber'] = $result->catalogNumber;
						$result->parameters[] = $parameters;
						$matched = true;
				    }
				    else
				    {
						if (is_numeric($result->catalogNumber))
						{
							$parameters = array();
							$parameters['institutionCode'] = 'OMNH';
							$parameters['catalogNumber'] = $result->catalogNumber . '.0';
							$result->parameters[] = $parameters;
							$matched = true;
						}
					}

					$use_default = true;
					break;
					
				//------------------------------------------------------------------------
				case 'OSUC':
					// C.A. Triplehorn Insect Collection, Ohio State University, Columbus, OH (OSUC)
					{
						$parameters = array();
						$parameters['institutionCode'] = 'C.A. Triplehorn Insect Collection, Ohio State University, Columbus, OH (OSUC)';
						$parameters['catalogNumber'] = $result->institutionCode . ' ' . $result->catalogNumber;
						$result->parameters[] = $parameters;					
					}

					$use_default = true;
					break;
					
					
				//------------------------------------------------------------------------
				case 'QMJ':
					if (is_numeric($result->catalogNumber))
					{
						$parameters = array();
						$parameters['institutionCode'] = 'QM';
						$parameters['catalogNumber'] = 'J' . $result->catalogNumber;
						$result->parameters[] = $parameters;
						$matched = true;
					}

					$use_default = true;
					break;
					
				//------------------------------------------------------------------------
				case 'QMS':
					$matched = false;
					if (!$matched)
					{
						if (preg_match('/^QM(?<code>S\s*\d+)$/', $result->text, $m))
						{						
							$matched = true;
							$parameters = array();
							$parameters['institutionCode'] = 'QM';
							$parameters['catalogNumber'] = str_replace(' ', '', $m['code']);
							$result->parameters[] = $parameters;
						}													
					}
				
					// default
					if (!$matched)
					{
						$use_default = true;
					}				
					break;					
					
				//------------------------------------------------------------------------
				case 'ROM':
					$parameters = array();
					$parameters['institutionCode'] = 'Royal Ontario Museum: ROM';
					$parameters['catalogNumber'] = $result->catalogNumber;
					$result->parameters[] = $parameters;

					$use_default = true;
					break;				
								
									
				//------------------------------------------------------------------------
				case 'SAIAB':
					{
						$parameters = array();
						$parameters['institutionCode'] = $result->institutionCode;
						$parameters['catalogNumber'] = $result->institutionCode . '-' . str_pad($result->catalogNumber, 6,'0', STR_PAD_LEFT);
						$result->parameters[] = $parameters;
					}				
				
					$use_default = true;
					break;						

				//------------------------------------------------------------------------
				case 'SAM':
					$matched = false;
					if (!$matched)
					{
						if (preg_match('/^[A-Z]+\d+/', $result->catalogNumber, $m))
						{
							$matched = true;
							$parameters = array();
							$parameters['institutionCode'] = 'SAMA';
							$parameters['catalogNumber'] = $result->catalogNumber;
							$result->parameters[] = $parameters;
						}													
					}

					$use_default = true;
					break;	
					
				//------------------------------------------------------------------------
				case 'SAMAR':
					if (is_numeric($result->catalogNumber))
					{
						$parameters = array();
						$parameters['institutionCode'] = 'SAMA';
						$parameters['catalogNumber'] = 'R' . $result->catalogNumber;
						$result->parameters[] = $parameters;
						$matched = true;
					}

					$use_default = true;
					break;
					
				//------------------------------------------------------------------------
				case 'SBT':
					$parameters = array();
					$parameters['institutionCode'] = $result->institutionCode;
					$parameters['collectionCode'] = 'H';
					$parameters['otherCatalogNumbers'] = $result->institutionCode . $result->catalogNumber;
					$result->parameters[] = $parameters;

					$use_default = true;
					break;				
					
					
				//------------------------------------------------------------------------
				case 'Smithsonian National Museum of Natural History':
					$catalog_numbers = extend_catalog_number($result->catalogNumber, $extend_by);
					
					foreach ($catalog_numbers as $catalog_number)
					{
						$parameters = array();
						$parameters['institutionCode'] = 'USNM';
						$parameters['catalogNumber'] = $catalog_number;
						$result->parameters[] = $parameters;
					}
					break;
					
				//------------------------------------------------------------------------
				case 'SU':
					$parameters = array();
					$parameters['institutionCode'] = 'CAS';
					$parameters['catalogNumber'] = $result->catalogNumber;
					$result->parameters[] = $parameters;
					break;	
					
				// TRING 1877111743
				case 'TRING':
					$parameters = array();
					$parameters['institutionCode'] = 'NHMUK';
					if (preg_match('/^([0-9]{10})$/', $result->catalogNumber))
					{
						$parameters['catalogNumber']  = preg_replace('/^([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})$/', "$1.$2.$3.$4", $result->catalogNumber);
					}
					else
					{
						$parameters['catalogNumber'] = $result->catalogNumber;
					}
					$result->parameters[] = $parameters;
					break;	
					
				//------------------------------------------------------------------------
				case 'TRT':
					$parameters = array();
					$parameters['collectionCode'] = $result->institutionCode;
					$parameters['catalogNumber']  = $result->institutionCode . $result->catalogNumber;
					$result->parameters[] = $parameters;
					break;	
													
				//------------------------------------------------------------------------
				// TTU 
				case 'TTU':
					$parameters = array();
					$parameters['institutionID'] = $result->institutionCode;
					$parameters['catalogNumber'] = 'TTU-' . str_replace('Z', 'Z_', $result->catalogNumber);
					$result->parameters[] = $parameters;			
					
					$use_default = true;
					break;
														
				/*
				//------------------------------------------------------------------------
				// Old Naturalis
				case 'U':
					$parameters = array();
					$parameters['institutionID'] = 'Naturalis Biodiversity Center';
					$parameters['catalogNumber'] = 'L  ' . $result->catalogNumber;
					$result->parameters[] = $parameters;			
					
					// default
					$parameters = array();
					$parameters['institutionCode'] = $result->institutionCode;
					$parameters['catalogNumber'] = $result->catalogNumber;
					$result->parameters[] = $parameters;
					break;
				*/
				
					
				//------------------------------------------------------------------------
				case 'UAIC':
					// pad code and chnage institution
					$parameters = array();
					$parameters['institutionCode'] = 'UA';
					$parameters['catalogNumber'] = str_pad($result->catalogNumber, 8,'0', STR_PAD_LEFT);
					$result->parameters[] = $parameters;

					$use_default = true;
					break;
					
				//------------------------------------------------------------------------
				case 'UAZ':
					if (is_numeric($result->catalogNumber))
					{
						$parameters = array();
						$parameters['institutionCode'] = 'UAZ';
						$parameters['catalogNumber'] = 'UAZ ' . $result->catalogNumber;
						$result->parameters[] = $parameters;
						$matched = true;
					}
					
					$use_default = true;
					break;
					
				//------------------------------------------------------------------------
				case 'UBC':
				case 'V':
					$parameters = array();
					$parameters['institutionCode'] = 'ca.ubc';
					
					if ($result->institutionCode == 'UBC')
					{
						$parameters['catalogNumber'] = $result->catalogNumber;
					}
					else
					{
						$parameters['catalogNumber'] = $result->institutionCode . $result->catalogNumber;						
					}
					$result->parameters[] = $parameters;	
					break;
					
				//------------------------------------------------------------------------
				case 'U':
					$parameters = array();
					//$parameters['institutionID'] = 'Naturalis Biodiversity Center';
					$parameters['collectionCode'] = 'Botany';
					
					// U\s\s\d+
					if (preg_match('/^[0-9]+$/', $result->catalogNumber))
					{
						$parameters['catalogNumber'] = $result->institutionCode 
							. '  ' // two spaces
							. $result->catalogNumber;			
					}
					
					// U.\d+
					if (preg_match('/^\.[0-9]+$/', $result->catalogNumber))
					{
						$parameters['catalogNumber'] = $result->institutionCode 
							. $result->catalogNumber;			
					}					
								
					$result->parameters[] = $parameters;	
					break;
					
					
				//------------------------------------------------------------------------
				case 'UF':
					// Some UF material has FLMNH as instituion code
					
					$extend_by = max(30, $extend_by);
					$catalog_numbers = extend_catalog_number($result->catalogNumber, $extend_by);
					
					foreach ($catalog_numbers as $catalog_number)
					{
						$parameters = array();
						
						// UF
						$parameters['institutionCode'] = $result->institutionCode;
						$parameters['catalogNumber'] = $catalog_number;
						$result->parameters[] = $parameters;
						
						// 						
						$parameters['institutionCode'] = 'FLMNH';
						$parameters['catalogNumber'] = $catalog_number;
						$result->parameters[] = $parameters;
						
						// 
						$parameters['institutionCode'] = 'FLMNH';
						$parameters['catalogNumber'] = $catalog_number . '-Mollusca';
						$result->parameters[] = $parameters;
						

					}
					break;	
					
				//------------------------------------------------------------------------
				case 'US':
					if (!preg_match('/^US/', $result->catalogNumber))
					{						
						$parameters = array();
						$parameters['institutionCode'] = $result->institutionCode;
						$parameters['catalogNumber'] = 'US ' . $result->catalogNumber;
						$result->parameters[] = $parameters;
					}	
								
					$use_default = true;
					break;				
					
				//------------------------------------------------------------------------
				case 'USNM':
					$matched = false;
					if (isset($result->collectionCode) && $result->collectionCode == 'ENT')
					{
						$catalog_number = 'USNMENT' . $result->catalogNumber;
						
						// Deal with USNM catalog codes like USNM 730715.457409
						
						
						
						$catalog_numbers = extend_catalog_number($catalog_number, $extend_by);
					
						foreach ($catalog_numbers as $catalog_number)
						{
							$parameters = array();
							$parameters['institutionCode'] = $result->institutionCode;
							$parameters['collectionCode'] = 'Entomology';
							$parameters['catalogNumber'] = $catalog_number;
							$result->parameters[] = $parameters;
						}
						
						$matched = true;
					}
					if (!$matched)
					{
						// Deal with USNM catalog codes like USNM 730715.457409
						
						$prefixes = array('', 'PAL', 'V');
						foreach ($prefixes as $prefix)
						{
							$extend_by = max($extend_by, 30);
							$catalog_number = $prefix . $result->catalogNumber;
							$catalog_numbers = extend_catalog_number($catalog_number , $extend_by);
					
							foreach ($catalog_numbers as $catalog_number)
							{
								$parameters = array();
								$parameters['institutionCode'] = $result->institutionCode;
								$parameters['catalogNumber'] = $catalog_number;
								$result->parameters[] = $parameters;
							}
						}
					}
					break;
					
				//------------------------------------------------------------------------
				case 'UTA':
					$matched = false;
					if (preg_match('/(?<prefix>[A-Z])[-]?(?<code>\d+)/', $result->catalogNumber, $m))
					{
						
						$parameters = array();
						$parameters['institutionCode'] = $result->institutionCode;
						switch ($m['prefix'])
						{
							case 'A':
								$parameters['collectionCode']  = 'UTA-A';
								break;
							case 'R':
								$parameters['collectionCode']  = 'UTA-R';
								break;
							default:
								break;
						}
								
						$parameters['catalogNumber'] = $m['code'];
						$result->parameters[] = $parameters;
						
						$matched = true;
					}				
				
					if (!$matched)
					{
						$use_default = true;
					}
					break;
										
				//------------------------------------------------------------------------
				case 'UVC':
					if (is_numeric($result->catalogNumber))
					{
						$parameters = array();
						$parameters['institutionCode'] = 'Universidad del Valle';
						$parameters['catalogNumber'] = 'UVC-' . $result->catalogNumber;
						$result->parameters[] = $parameters;
					}
					else
					{
						$parameters = array();
						$parameters['institutionCode'] = $result->institutionCode;
						$parameters['catalogNumber'] = $result->catalogNumber;
						$result->parameters[] = $parameters;
					}					
					break;

				//------------------------------------------------------------------------
				case 'UWBM':
					if (!is_numeric($result->catalogNumber))
					{
						if (preg_match('/^(?<prefix>Bu)(?<catalogNumber>\d+)/', $result->catalogNumber, $m))
						{ 
							$parameters = array();
							$parameters['institutionCode'] = $result->institutionCode;
							$parameters['collectionCode'] = 'Bird';
							$parameters['catalogNumber'] = $m['catalogNumber'];
							$result->parameters[] = $parameters;
						}
					}

					$use_default = true;
					break;


				//------------------------------------------------------------------------
				case 'W':
					if (preg_match('/([1|2][0-9]{3})([0-9]{7})/', $result->catalogNumber, $m))
					{
						$parameters = array();
						$parameters['institutionCode'] = $result->institutionCode;
						$parameters['catalogNumber'] = $m[1] . '-' . $m[2];
						$result->parameters[] = $parameters;						
					}
								
					$use_default = true;
					break;


				//------------------------------------------------------------------------
				case 'WAG':
					$parameters = array();
					$parameters['institutionID'] = 'Naturalis Biodiversity Center'; //  note the institutionID
					$parameters['catalogNumber'] = $result->institutionCode . $result->catalogNumber;
					$result->parameters[] = $parameters;
					break;
					
				//------------------------------------------------------------------------
				case 'WAM':
					$matched = false;
					if (!$matched)
					{
						if (preg_match('/^(?<prefix>[A-Z])\.?(?<main>\d+)[\.|-]?(?<suffix>\d+)$/', $result->catalogNumber, $m))
						{
							$matched = true;
							$parameters = array();
							$parameters['institutionCode'] = $result->institutionCode;
							$parameters['catalogNumber'] = $m['prefix'] . $m['main'] . '.' . $m['suffix'];
							$result->parameters[] = $parameters;
						}
						
						// No prefixes
						if (preg_match('/^(?<main>\d+)[\.|-]?(?<suffix>\d+)$/', $result->catalogNumber, $m))
						{
							$prefixes = array('A', 'M', 'P', 'R', 'S');
							foreach ($prefixes as $prefix)
							{
								$parameters = array();

								$catalog_numbers = extend_catalog_number($prefix . $m['main'] . '.' . $m['suffix'], $extend_by);
					
								foreach ($catalog_numbers as $catalog_number)
								{
									$parameters = array();
									$parameters['institutionCode'] = $result->institutionCode;
									$parameters['catalogNumber'] = $catalog_number;
									$result->parameters[] = $parameters;
								}
							}
							$matched = true;
						}	
						
						if ($result->institutionCode == 'WAM' && is_numeric($result->catalogNumber))
						{
							$prefixes = array('A', 'M', 'P', 'R', 'S');
							foreach ($prefixes as $prefix)
							{
								$parameters = array();

								$catalog_numbers = extend_catalog_number($prefix . $result->catalogNumber, $extend_by);
					
								foreach ($catalog_numbers as $catalog_number)
								{
									$parameters = array();
									$parameters['institutionCode'] = $result->institutionCode;
									$parameters['catalogNumber'] = $catalog_number;
									$result->parameters[] = $parameters;
								}
							}
							$matched = true;
						}																			
																								
																			
					}
					
					$use_default = true;
					break;	
					
				//------------------------------------------------------------------------
				case 'WAMR':
					if (is_numeric($result->catalogNumber))
					{
						$parameters = array();
						$parameters['institutionCode'] = 'WAM';
						$parameters['catalogNumber'] = 'R' . $result->catalogNumber;
						$result->parameters[] = $parameters;
						$matched = true;
					}

					$use_default = true;
					break;

				//------------------------------------------------------------------------
				case 'YIO':	
					if (is_numeric($result->catalogNumber))
					{
						$parameters = array();
						$parameters['institutionCode'] = $result->institutionCode;
						$parameters['catalogNumber'] = 'YIO-' . str_pad($result->catalogNumber, 5,'0', STR_PAD_LEFT);
						$result->parameters[] = $parameters;																		
					}

					$use_default = true;
					break;
					
				//------------------------------------------------------------------------
				case 'YPM':								
					if (isset($result->collectionCode))
					{
						switch ($result->collectionCode)
						{				
							case 'R':
								$parameters = array();		
								$parameters['institutionCode'] = $result->institutionCode;							
								$parameters['catalogNumber'] = $result->institutionCode 
									. ' HERR ' . str_pad($result->catalogNumber, 6,'0', STR_PAD_LEFT);
								$result->parameters[] = $parameters;
								break;
						
							case 'ENT':
							case 'HERR':
							case 'ICH':
							case 'IZ':
							case 'MAM':
							case 'ORN':	
							case 'VP':						
								$parameters = array();		
								$parameters['institutionCode'] = $result->institutionCode;							
								$parameters['catalogNumber'] = $result->institutionCode 
									. ' ' . $result->collectionCode 
									. ' ' . str_pad($result->catalogNumber, 6,'0', STR_PAD_LEFT);
								$result->parameters[] = $parameters;
								break;
								
							default:
								$parameters = array();		
								$parameters['institutionCode'] = $result->institutionCode;							
								$parameters['catalogNumber'] = $result->catalogNumber;
								$result->parameters[] = $parameters;
								break;
						}
					}
					else
					{
						$parameters = array();
						$parameters['institutionCode'] = $result->institutionCode;
						$parameters['catalogNumber'] = $result->catalogNumber;
						$result->parameters[] = $parameters;
						
						// try some prefixes as well...
						$prefixes = array('ENT', 'R', 'ICH', 'IZ', 'IZGP', 'MAM', 'ORN', 'HERR', 'VP');
						foreach ($prefixes as $prefix)
						{
							$parameters = array();		
							$parameters['institutionCode'] = $result->institutionCode;							
							$parameters['catalogNumber'] = $result->institutionCode 
								. ' ' . $prefix 
								. ' ' . str_pad($result->catalogNumber, 6,'0', STR_PAD_LEFT);
							$result->parameters[] = $parameters;
						}
					}
					break;

				//------------------------------------------------------------------------
				case 'YU':	
					{
						$parameters = array();
						$parameters['institutionCode'] = 'YPM';
						$parameters['collectionCode'] = $result->institutionCode;
						$parameters['catalogNumber'] = $result->institutionCode . '.' . $result->catalogNumber;
						$result->parameters[] = $parameters;																		
					}
					
					$use_default = true;
					break;
					
				//------------------------------------------------------------------------
				case 'ZMA':
					$matched = false;

					if (!$matched)
					{				
						if (is_numeric($result->catalogNumber))
						{
							// Institution.prefix.catalogue
							$prefixes = array('Aves_');
							foreach ($prefixes as $prefix)
							{
								$parameters = array();
								$parameters['institutionCode'] = $result->institutionCode;
								$parameters['catalogNumber'] = $prefix . $result->catalogNumber;
								$result->parameters[] = $parameters;
							}
							
							if (preg_match('/(?<one>\d+)\.(?<two>\d+)/', $result->catalogNumber, $m))
							{
								$prefixes = array('Pisces_');
								foreach ($prefixes as $prefix)
								{
									$parameters = array();
									$parameters['institutionCode'] = $result->institutionCode;
									$parameters['catalogNumber'] = $prefix . $m['one'] . ',' . $m['two'];
									$result->parameters[] = $parameters;
								}
							}							
							
							
							$matched = true;
						}
					}					
					
					$use_default = true;
					break;
					
					
				//------------------------------------------------------------------------
				case 'ZFMK':
					$matched = false;
					if (is_numeric($result->catalogNumber))
					{
						$prefixes = array('AMP', 'REP');
						foreach ($prefixes as $prefix)
						{
							$parameters = array();

							$catalog_numbers = extend_catalog_number($prefix . '-' . $result->catalogNumber, $extend_by);
					
							foreach ($catalog_numbers as $catalog_number)
							{
								$parameters = array();
								$parameters['institutionCode'] = $result->institutionCode;
								$parameters['catalogNumber'] = $catalog_number;
								$result->parameters[] = $parameters;
							}
						}
						$matched = true;
					}
					
					// Some ZFMK hosted by SysTax
					$use_default = true;
					break;		
					
					
				//------------------------------------------------------------------------
				// Raffles Museum (ZRC)
				case 'ZRC':
					$matched = false;
					if (preg_match('/\d+\.\d+/', $result->catalogNumber))
					{
						$parameters = array();
						$parameters['institutionCode'] = 'RM';
						$parameters['catalogNumber'] = 'ZRC' . '.' . $result->catalogNumber;
						$result->parameters[] = $parameters;
						$matched = true;
					}
					
					if (!$matched)
					{
						$use_default = true;
					}					
					break;		
					
				//------------------------------------------------------------------------
				case 'ZMA':
					$matched = false;
					if (!$matched)
					{
						if (preg_match('/^(?<one>\d+)\.(?<two>\d+)$/', $result->catalogNumber, $m))
						{						
							$matched = true;
							$parameters = array();
							$parameters['institutionCode'] = $result->institutionCode;
							$parameters['catalogNumber'] = $m['one'] . $m['two'];
							$result->parameters[] = $parameters;
							
							// ZMA.MAM.27618
							$parameters = array();
							$parameters['institutionCode'] = $result->institutionCode;
							$parameters['catalogNumber'] = 'ZMA.MAM.' . $m['one'] . $m['two'];
							$result->parameters[] = $parameters;
							
						}													
					}
					
					if (!$matched)
					{
						$use_default = true;
						
						$parameters = array();
						$parameters['institutionCode'] = $result->institutionCode;
						$parameters['catalogNumber'] = 'ZMA.MAM.' . $result->catalogNumber;
						$result->parameters[] = $parameters;												
					}					
					break;	
					
				//------------------------------------------------------------------------
				case 'ZMUC':
					$matched = false;
					if (is_numeric($result->catalogNumber))
					{
						$prefixes = array('ZMUC-R');
						foreach ($prefixes as $prefix)
						{
							$parameters = array();

							$catalog_numbers = extend_catalog_number($prefix . $result->catalogNumber, $extend_by);
					
							foreach ($catalog_numbers as $catalog_number)
							{
								$parameters = array();
								$parameters['institutionCode'] = $result->institutionCode;
								$parameters['catalogNumber'] = $catalog_number;
								$result->parameters[] = $parameters;
							}
						}
						$matched = true;
					}
					
					$use_default = true;
					break;
					
				//------------------------------------------------------------------------
				default:
					/*
					$catalog_numbers = extend_catalog_number($result->catalogNumber, $extend_by);
					
					foreach ($catalog_numbers as $catalog_number)
					{
						$parameters = array();
						$parameters['institutionCode'] = $result->institutionCode;
						if (isset($result->collectionCode))
						{
							//$parameters['collectionCode'] = $result->collectionCode;
						}
						$parameters['catalogNumber'] = $catalog_number;
						$result->parameters[] = $parameters;
					}
					*/
						
					$use_default = true;										
					break;
			}
			
			if ($use_default)
			{
				$parameters = array();
				$parameters['institutionCode'] = $result->institutionCode;
				$parameters['catalogNumber'] = $result->catalogNumber;
				$result->parameters[] = $parameters;
			}
		}
	
	}
	
	return $result;
	
}




?>