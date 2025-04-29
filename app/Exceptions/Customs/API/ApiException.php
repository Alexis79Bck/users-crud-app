<?php

namespace App\Exceptions\Customs\API;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiException extends Exception
{
    /**
     * El código de estado HTTP de la respuesta.
     *
     * @var int
     */
    protected $statusCode;

    /**
     * Constructor de la clase.
     *
     * @param  string  $message
     * @param  int  $statusCode
     * @param  Exception  $previous
     * @return void
     */
    public function __construct(
        $message = 'API:Error',
        $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR,
        Exception $previous = null
    ) {
        $this->statusCode = $statusCode;
        parent::__construct($message, $statusCode, $previous);
    }

    /**
     * Renderiza la excepción en una respuesta JSON.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function render(): JsonResponse
    {
        $error = [
            'message' => $this->getMessage(),
            'status_code' => $this->statusCode,
        ];

        // Agrega detalles adicionales del error en el entorno de desarrollo
        if (config('app.debug')) {
            $error['trace'] = $this->getTrace();
        }

        return response()->json(['error' => $error], $this->statusCode);
    }

    /**
     * Devuelve el código de estado HTTP.
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
