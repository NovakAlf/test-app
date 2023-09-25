<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class EventService
{
  /**
   * @return JsonResponse
   */
  public function events(): JsonResponse
  {
    $events = Event::all();

    return $this->successResponse($events);
  }

  /**
   * @param $id
   * @return JsonResponse
   */
  public function users(int $id): JsonResponse
  {
    try {
      $users = Event::find($id)->users()->get();
      return $this->successResponse($users);
    } catch (QueryException $ex) {
      return $this->errorResponse($ex->getMessage());
    }
  }

  /**
   * @param $data
   * @return JsonResponse
   */
  public function create($data): JsonResponse
  {
    try {
      $event = Event::create($data);
      return $this->successResponse($event);
    } catch (QueryException $ex) {
      return $this->errorResponse($ex->getMessage());
    }
  }

  /**
   * @param $id
   * @return JsonResponse
   */
  public function remove(int $id): JsonResponse
  {
    try {
      $event = Event::find($id);
    } catch (QueryException $ex) {
      return $this->errorResponse($ex->getMessage());
    }

    if (!Gate::allows('delete-event', $event)) {
      return $this->errorResponse('Unauthorized.');
    }
    $event->delete();

    return $this->successResponse(['id' => $event->id]);
  }

  /**
   * @param $id
   * @return JsonResponse
   */
  public function toggle(int $id): JsonResponse
  {
    try {
      $event = Event::find($id);
      $event->users()->toggle(auth()->user()->id);
      return $this->successResponse(['id' => $event->id]);
    } catch (QueryException $ex) {
      return $this->errorResponse($ex->getMessage());
    }
  }

  private function successResponse($result): JsonResponse
  {
    $response = [
      'error' => null,
      'result' => $result
    ];
    return response()->json($response);
  }

  private function errorResponse($result): JsonResponse
  {
    $response = [
      'error' => true,
      'message' => $result
    ];
    return response()->json($response);
  }
}