<?php

namespace App\Exceptions;

use Exception;

/**
* Custome exception
*/
class AppException extends Exception
{
	
	public function __construct($message = null, $code = 0)
	{
		parent::__construct($message, $code);
	}
}