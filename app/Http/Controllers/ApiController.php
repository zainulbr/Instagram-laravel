<?php

namespace App\Http\Controllers;

class ApiController extends Controller
{
    protected $statusCode = 200;

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function respond(array $data)
    {
        return response()->json($data);
    }

    public function respondWithError($message, $statusCode = 500)
    {
        return $this->setStatusCode($statusCode)
            ->respond([
                'error' => [
                    'message' => $message,
                    'status_code' => $this->statusCode
                ]
            ]);
    }

    public function respondSuccess($message)
    {
        return $this->respond([
            'status' =>'success',
            'message' => $message
        ]);
    }

    public function respondCheck($message)
    {
        return $this->respond([
            'status' => 'success',
            'message' => $message
        ]);
    }
}

