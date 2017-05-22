<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


define("CSS_VERSION",				"1.2");
define("PHP_PATH", 					"");
define('SEND_PRETTY_EMAILS',		'1');
define("SITE_TITLE", 				"Captor");

define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');



/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/

if(ENVIRONMENT == "PROD")
{
	define('SITE_URL','http://prosoftsol.com/prettypronto/dev/');
    define('S3_BUCKET_NAME','');
    define('SWAGGER_PATH','http://prosoftsol.com/prettypronto/dev/api_doc');
    define('API_SWAGGER_PATH','http://prosoftsol.com/prettypronto/dev/api');
    define('IMAGE_PATH_USER',SITE_URL.'assets/all_images/');
    define('PUSH_CERTIFICATE',SITE_URL.'assets/push_certificate/prettypronoto.pem');

}
else if(ENVIRONMENT == "STAGING")
{
	define('SITE_URL','http://192.168.99.122:81/prettypronto/dev/');
    define('S3_BUCKET_NAME','');
    define('SWAGGER_PATH','http://192.168.99.122:81/prettypronto/dev/api_doc');
    define('API_SWAGGER_PATH','http://192.168.99.122:81/prettypronto/dev/api');

}
else // local
{

    define('S3_BUCKET_NAME','');
    define('SWAGGER_PATH','http://localhost/codeigniterSwaggerApi/CodeIgniter-3.1.4/index.php/api_doc');
    define('API_SWAGGER_PATH','http://localhost/codeigniterSwaggerApi/CodeIgniter-3.1.4/index.php/api');
}



define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

define('awsAccessKey', '');
 define('awsSecretKey', '');
 define('S3_IMAGE_PATH','');
 define('S3_PATH','');
  define('SWAGGER_UI_TITLE','Captor');


/* End of file constants.php */
/* Location: ./application/config/constants.php */
