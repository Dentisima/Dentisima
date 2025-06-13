<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

define('FOPEN_READ',				'rb');
define('FOPEN_READ_WRITE',			'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',	'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',			'ab');
define('FOPEN_READ_WRITE_CREATE',		'a+b');
define('FOPEN_WRITE_CREATE_STRICT',		'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',	'x+b');

#Actualiza de manera automatica la base URL 
if( isset($_SERVER['HTTP_HOST']) ){
   $base_url = 'https'
             .'://'.$_SERVER['HTTP_HOST']
			 . str_replace(basename($_SERVER['SCRIPT_NAME']),'',$_SERVER['SCRIPT_NAME']);
	
	$base_uri = parse_url($base_url,PHP_URL_PATH);
	if( substr($base_uri,0 ,1) != '/'  )
	   $base_uri = '/'.$base_uri;
	if( substr($base_uri,-1 ,1) != '/'  )
	   $base_uri .= '/';
	 
}else{
   $base_url = 'http://localhost/';
   $base_uri = '/';
}

define('BASE_KEY', "def6d90e829e50c63f98c387daecd138"); 
define('BASE_URL', $base_url);
define('BASE_URI', $base_uri);
define('APPPATH_URI', BASE_URI. APPPATH);



