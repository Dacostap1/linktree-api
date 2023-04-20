<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    try {
      return response()->json([new UserResource(auth()->user())], 200);
    } catch (\Throwable $e) {
      return response()->json(['error' => $e->getMessage()], 400);
    }
  }



  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }


  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, User $user)
  {
    $request->validate([
      'name' => 'required|max:25',
      'bio' => 'sometimes|max:80',
    ]);

    try {
      $user->name = $request->name;
      $user->name = $request->bio;
      $user->save();

      return response()->json([new UserResource($user)], 200);
    } catch (\Throwable $e) {
      return response()->json(['error' => $e->getMessage()], 400);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
