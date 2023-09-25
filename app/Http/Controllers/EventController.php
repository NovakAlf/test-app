<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventFormRequest;
use App\Http\Requests\SimpleIdFormRequest;
use App\Services\EventService;
use Illuminate\Http\JsonResponse;

class EventController extends Controller
{
  private EventService $_service;

  public function __construct(EventService $service)
  {
    $this->_service = $service;
  }

  /**
   * @return JsonResponse
   */
  public function events(): JsonResponse
  {
    return $this->_service->events();
  }

  /**
   * @param SimpleIdFormRequest $request
   * @return JsonResponse
   */
  public function users(SimpleIdFormRequest $request): JsonResponse
  {
    $id = $request->input('id');

    return $this->_service->users($id);
  }

  /**
   * @param EventFormRequest $request
   * @return JsonResponse
   */
  public function create(EventFormRequest $request): JsonResponse
  {
    $event = $request->validated();

    return $this->_service->create($event);
  }

  /**
   * @param SimpleIdFormRequest $request
   * @return JsonResponse
   */
  public function remove(SimpleIdFormRequest $request): JsonResponse
  {
    $id = $request->input('id');

    return $this->_service->remove($id);
  }

  /**
   * @param SimpleIdFormRequest $request
   * @return JsonResponse
   */
  public function toggle(SimpleIdFormRequest $request): JsonResponse
  {
    $id = $request->input('id');

    return $this->_service->toggle($id);
  }
}
