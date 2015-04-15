<?php

// $Id: //

/**
 * @file config.php
 *
 * Global configuration variables (may be added to by other modules).
 *
 */

global $config;

// Date timezone
date_default_timezone_set('Europe/London');

// Proxy settings for connecting to the web---------------------------------------------------------

// Set these if you access the web through a proxy server
$config['proxy_name'] 	= '';
$config['proxy_port'] 	= '';

//$config['proxy_name'] 	= 'wwwcache.gla.ac.uk';
//$config['proxy_port'] 	= '8080';


// Settings-----------------------------------------------------------------------------------------
$config['temp_dir'] = dirname(__FILE__) . '/tmp';

// CouchDB------------------------------------------------------------------------------------------
$config['stale'] = true;

// local CouchDB
$config['couchdb_options'] = array(
		'database' => 'material',
		'host' => '127.0.0.1',
		'port' => 5984
		);

// HTTP proxy
if ($config['proxy_name'] != '')
{
	if ($config['couchdb_options']['host'] != 'localhost')
	{
		$config['couchdb_options']['proxy'] = $config['proxy_name'] . ':' . $config['proxy_port'];
	}
}

?>