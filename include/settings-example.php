<?php
function getBaseAddress()
{
	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/";
    $folder = "institute";
	return $actual_link . $folder ;
}
?>