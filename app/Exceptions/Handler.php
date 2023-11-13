<?php

namespace App\Exceptions;

use App\Traits\ApiResponse;
use Exception;
use Illuminate\Container\EntryNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\ItemNotFoundException;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\MockObject\ReturnValueNotConfiguredException;
use PHPUnit\TextUI\Configuration\IncludePathNotConfiguredException;
use Spatie\FlareClient\Http\Exceptions\NotFound;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\ResolverNotFoundException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class Handler extends ExceptionHandler
{
    use ApiResponse;
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->renderable(function (Exception $e, Request $request) {
            if ($request->is('api/*')) {
                if ($e->getPrevious() instanceof ModelNotFoundException) {
                    return $this->failureResponse('ID not found', 404);
                }
                if ($e instanceof ValidationException) {
                    return $this->failureResponse($e->errors());
                }
                if ($e instanceof NotFoundHttpException) {
                    if ($e->getPrevious() instanceof ModelNotFoundException) {
                        return $this->failureResponse('ID not found', 404);
                    }
                    return $this->failureResponse($e->getMessage(), 404);
                }
                return $this->failureResponse($e->getMessage());
            }
        });
    }
}
