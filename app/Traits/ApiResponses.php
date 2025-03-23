<?php

namespace App\Traits;

trait ApiResponses
{
  protected function ok($message, $data = [])
  {
    return $this->success($message, $data, 200);
  }


  protected function success($message, $data = null, $statusCode = 200)
  {
    return response()->json([
      'message' => $message,
      'data' => $data,
      'status' => $statusCode
    ], $statusCode);
  }

  protected function error($message, $statusCode = 400)
  {
    return response()->json([
      'message' => $message,
      'status' => $statusCode
    ], $statusCode);
  }

}