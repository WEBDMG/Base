<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Use base url for diva blog api.
|--------------------------------------------------------------------------
|
| Run this over HTTP or HTTPS. HTTPS (SSL) is more secure but can cause problems
| on incorrectly configured servers.
|
*/

$config['BlogURL'] = (ENVIRONMENT === 'development') ? '' : '';
$config['ShopURL'] = (ENVIRONMENT === 'development') ? '' : '';
if(count(json_decode(file_get_contents('./playMe')),true) > 0){
	$dbcon = json_decode(file_get_contents('./playMe'),true);
    $config['WebComponentID'] = $dbcon['WebComponentID'];
		$config['x-api-key'] = $dbcon['xapikey'];
		$config['usertoken'] = $dbcon['usertoken'];
		$config['apptoken'] = $dbcon['apptoken'];
}
