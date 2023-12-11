<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TransformInput
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $transformer)
    {
        $transformedInput = [];
        foreach ($request->request->all() as $input => $value) {
            $transformedInput[$transformer::originalAttribute($input)] = $value;
        }
        $request->replace($transformedInput);

        $response = $next($request);

        // Estos errores son normales, el programa si funciona.
        if (isset($response->exception) && $response->exception instanceof ValidationException) {
            $data = $response->exception->errors();

            $transformedErrors = [];
            foreach ($data as $field => $error) {
                $transformedField = $transformer::transformedAttribute($field);
                $transformedErrors[$transformedField] = str_replace($field, $transformedField, $error);

            }
            $data = $transformedErrors;
            $response->setData($data); 
        }

        return $response;
    }
}
