<?php

namespace App\Exceptions;

use App\Exceptions\Customs\API\ApiException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
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
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (ValidationException $e, $request) {
            if ($request->wantsJson()) {
                $errors = [];
                foreach ($e->errors() as $field => $messages) {
                    foreach ($messages as $message) {
                        $errors[] = [
                            'field' => $field,
                            'message' => $message,
                        ];
                    }
                }

                $error = new ApiException('Error de validación', Response::HTTP_UNPROCESSABLE_ENTITY);
                $errorData = $error->render()->getData(true);
                $errorData['error']['errors'] = $errors;

                return response()->json($errorData, $error->getStatusCode());
            }
        });
    }
}
