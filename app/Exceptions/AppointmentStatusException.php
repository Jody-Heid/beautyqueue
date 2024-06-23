<?php

namespace App\Exceptions;

use Exception;
use Flugg\Responder\Http\MakesResponses;

class AppointmentStatusException extends Exception
{
    use MakesResponses;

    public function __construct($message = 'Incorrect Appointment Status used', $code = 500, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render($request)
    {
        return $this->error(null, $this->getMessage())->respond($this->getCode());
    }
}
