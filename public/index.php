<?php
<<<<<<< HEAD

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
=======
/**
 * Laravel - A clean and classy framework for PHP web development.
 *
 * @package  Laravel
 * @version  1.0.0 Beta 1
 * @author   Taylor Otwell
 * @license  MIT License
 * @link     http://laravel.com 
 */

// --------------------------------------------------------------
// Set the framework starting time.
// --------------------------------------------------------------
define('LARAVEL_START', microtime(true));

// --------------------------------------------------------------
// Define the framework paths.
// --------------------------------------------------------------
define('APP_PATH', realpath('../application').'/');
define('SYS_PATH', realpath('../system').'/');
define('BASE_PATH', realpath('../').'/');

// --------------------------------------------------------------
// Define the PHP file extension.
// --------------------------------------------------------------
define('EXT', '.php');

// --------------------------------------------------------------
// Load the configuration and string classes.
// --------------------------------------------------------------
require SYS_PATH.'config'.EXT;
require SYS_PATH.'str'.EXT;

// --------------------------------------------------------------
// Register the auto-loader.
// --------------------------------------------------------------
spl_autoload_register(require SYS_PATH.'loader'.EXT);

// --------------------------------------------------------------
// Set the Laravel starting time in the Benchmark class.
// --------------------------------------------------------------
System\Benchmark::$marks['laravel'] = LARAVEL_START;

// --------------------------------------------------------------
// Set the error reporting level.
// --------------------------------------------------------------
error_reporting((System\Config::get('error.detail')) ? E_ALL | E_STRICT : 0);

// --------------------------------------------------------------
// Register the error handlers.
// --------------------------------------------------------------
set_exception_handler(function($e)
{
	System\Error::handle($e);	
});

set_error_handler(function($number, $error, $file, $line) 
{
	System\Error::handle(new ErrorException($error, 0, $number, $file, $line));
});

register_shutdown_function(function()
{
	if ( ! is_null($error = error_get_last()))
	{
		System\Error::handle(new ErrorException($error['message'], 0, $error['type'], $error['file'], $error['line']));
	}	
});

// --------------------------------------------------------------
// Set the default timezone.
// --------------------------------------------------------------
date_default_timezone_set(System\Config::get('application.timezone'));

// --------------------------------------------------------------
// Load the session.
// --------------------------------------------------------------
if (System\Config::get('session.driver') != '')
{
	System\Session::load();
}

// --------------------------------------------------------------
// Execute the global "before" filter.
// --------------------------------------------------------------
$response = System\Filter::call('before');

// --------------------------------------------------------------
// Only execute the route function if the "before" filter did
// not override by sending a response.
// --------------------------------------------------------------
if (is_null($response))
{
	// ----------------------------------------------------------
	// Route the request to the proper route.
	// ----------------------------------------------------------
	$route = System\Router::route(Request::method(), Request::uri());

	// ----------------------------------------------------------
	// Execute the route function.
	// ----------------------------------------------------------
	if ( ! is_null($route))
	{
		$response = $route->call();	
	}
	else
	{
		$response = System\Response::view('error/404', 404);
	}
}
else
{
	$response = ( ! $response instanceof System\Response) ? new System\Response($response) : $response;
}

// ----------------------------------------------------------
// Execute the global "after" filter.
// ----------------------------------------------------------
System\Filter::call('after', array($response));

// --------------------------------------------------------------
// Close the session.
// --------------------------------------------------------------
if (System\Config::get('session.driver') != '')
{
	System\Session::close();
}

// --------------------------------------------------------------
// Send the response to the browser.
// --------------------------------------------------------------
$response->send();
>>>>>>> a188d621 (initial commit of laravel!)
