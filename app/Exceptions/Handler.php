<?php

namespace App\Exceptions;

use Throwable;
use App\Helpers\ResponseHelper;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Passport\Exceptions\OAuthServerException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{

    public function render($request, Throwable $exception)
{
    if ($exception instanceof AuthenticationException && $exception->guards() === ['api']) {
        return ResponseHelper::responseJson("Failed",401,"Unauthorized",null);
    }

    if ($exception instanceof OAuthServerException && $exception->getCode() === 9) {
        return ResponseHelper::responseJson("Failed",401,"Unauthorized",null);
    }

    return parent::render($request, $exception);
}
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
