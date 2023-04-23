<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\FileService;
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
      return response()->json(new UserResource(auth()->user()), 200);
    } catch (\Exception $e) {
      return response()->json(['error' => $e->getMessage()], 400);
    }
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
      $user->bio = $request->bio;
      $user->save();

      return response()->json(new UserResource($user), 200);
    } catch (\Exception $e) {
      return response()->json(['error' => $e->getMessage()], 400);
    }
  }

  public function updateTheme(Request $request)
  {
    $request->validate([
      'theme_id' => 'required',
    ]);

    try {
      $user = User::findOrFail(auth()->user()->id);
      $user->theme_id = $request->theme_id;
      $user->save();

      return response()->json(new UserResource($user), 200);
    } catch (\Exception $e) {
      return response()->json(['error' => $e->getMessage()], 400);
    }
  }

  /**
   * Save the specified image in storage.
   */
  public function uploadImage(Request $request)
  {
    $request->validate([
      'image' => 'required|mimes:png,jpg,jpeg',
    ]);

    try {

      $service = new FileService();
      $user = $service->updateImage(auth()->user(), $request);
      $user->save();


      return response()->json(new UserResource($user), 200);
    } catch (\Exception $e) {
      return response()->json(['error' => $e->getMessage()], 400);
    }
  }
}
