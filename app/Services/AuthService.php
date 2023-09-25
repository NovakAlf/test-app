<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthService
{
  /**
   * @param $user
   * @param bool $with_token
   * @return JsonResponse
   */
  public function register($user, bool $with_token = false): JsonResponse
  {
    try {
      $user = User::create($user);
      $response = [
        'success' => true,
        'message' => 'User register successfully',
      ];
      if ($with_token) $response['token'] = $user->createToken('apiToken')->plainTextToken;
    } catch (QueryException $ex) {
      $response = [
        'success' => false,
        'message' => $ex->getMessage()
      ];
    }
    return response()->json($response);
  }

  /**
   * @param $user
   * @param bool $with_token
   * @return JsonResponse
   */
  public function login($user, bool $with_token = false): JsonResponse
  {
    if (Auth::attempt($user)) {
      $response = [
        'success' => true,
        'message' => 'User login successfully',
      ];
      if ($with_token) $response['token'] = auth()->user()->createToken('apiToken')->plainTextToken;
    } else {
      $response = [
        'success' => false,
        'message' => 'Unauthorised'
      ];
    }
    return response()->json($response);
  }

  /**
   * @param bool $with_token
   * @return JsonResponse
   */
  public function logout(bool $with_token = false): JsonResponse
  {
    try {
      Session::flush();
      $response = [
        'success' => true,
        'message' => 'Successfully logged out',
      ];
      if ($with_token) $response['token'] = auth()->user()->tokens()->delete();
    } catch (QueryException $ex) {
      $response = [
        'success' => false,
        'message' => $ex->getMessage()
      ];
    }
    return response()->json($response);
  }

  /**
   * @return JsonResponse
   */
  public function getUser(): JsonResponse
  {
    $response = [
      'success' => true,
      'user' => auth()->user()
    ];
    return response()->json($response);
  }
}