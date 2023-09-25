<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Http\Requests\SimpleIdFormRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
  private AuthService $_service;

  public function __construct(AuthService $service)
  {
    $this->_service = $service;
  }

  /**
   * @param RegisterFormRequest $request
   * @return JsonResponse
   */
  public function register(RegisterFormRequest $request): JsonResponse
  {
    $user = $request->validated();

    return $this->_service->register($user, !(bool)$request->cookie('XSRF-TOKEN'));
  }

  /**
   * @param LoginFormRequest $request
   * @return JsonResponse
   */
  public function login(LoginFormRequest $request): JsonResponse
  {
    $user = $request->validated();

    return $this->_service->login($user, !(bool)$request->cookie('XSRF-TOKEN'));
  }

  /**
   * @param Request $request
   * @return JsonResponse
   */
  public function logout(Request $request): JsonResponse
  {
    return $this->_service->logout(!(bool)$request->cookie('XSRF-TOKEN'));
  }

  /**
   * @return JsonResponse
   */
  public function getUser(): JsonResponse
  {
    return $this->_service->getUser();
  }
}
