<?php

error_reporting(E_ALL);

// image for a higher taxon

$name = '';

if (isset($_GET['name']))
{
	$name = $_GET['name'];
}

$image_url = "images/blank100x100.png";
//$image_url = "images/Aves.png";

$image_filename = "images/" . $name . ".png";

//echo $image_filename;

if (file_exists($image_filename))
{
	$image_url = $image_filename;
}

header("Location: $image_url");	

?>