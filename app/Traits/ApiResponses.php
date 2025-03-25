<?php

namespace App\Traits;

/**
 * Trait ApiResponses
 *
 * Provides helper methods for sending standardized API responses.
 */
trait ApiResponses
{
  /**
   * Sends a success response with a 200 HTTP status code.
   *
   * @param string $message The message to include in the response.
   * @param mixed $data The data to include in the response (optional).
   * @return \Illuminate\Http\JsonResponse
   */
  protected function ok($message, $data = [])
  {
    return $this->success($message, $data, 200);
  }


  /**
   * Sends a success response with a custom status code.
   *
   * @param string $message The message to include in the response.
   * @param mixed $data The data to include in the response (optional).
   * @param int $statusCode The HTTP status code for the response (default is 200).
   * @return \Illuminate\Http\JsonResponse
   */
  protected function success($message, $data = null, $statusCode = 200)
  {
    return response()->json([
      'message' => $message,
      'data' => $data,
      'status' => $statusCode
    ], $statusCode);
  }

  /**
   * Sends an error response with a custom status code.
   *
   * @param string $message The error message to include in the response.
   * @param int $statusCode The HTTP status code for the error response (default is 400).
   * @return \Illuminate\Http\JsonResponse
   */
  protected function error($message, $statusCode = 400)
  {
    return response()->json([
      'message' => $message,
      'status' => $statusCode
    ], $statusCode);
  }

}