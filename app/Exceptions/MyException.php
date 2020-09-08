<?php

namespace App\Exceptions;

use Exception;

class MyException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return view('errors.email_error');
    }

    public function report()
    {
        \Log::error('errrrrrrrrrrrrr');
    }
}
