<?php

namespace App\Http\Controllers\Api;

use App\Models\Link;
use Illuminate\Http\Request;
use App\Services\FileService;
use App\Http\Controllers\Controller;
use App\Http\Resources\LinkResource;

class LinkController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    try {
      $links = Link::where('user_id', auth()->user()->id)->get();

      return response()->json(LinkResource::collection($links), 200);
    } catch (\Exception $e) {
      return response()->json(['error' => $e->getMessage()], 400);
    }
  }




  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|max:20',
      'url' => 'required|active_url',
    ]);

    try {
      $link = new Link();

      $link->name = $request->name;
      $link->url = $request->url;
      $link->image = '/link-placeholder.png';
      $link->user_id = auth()->user()->id;

      $link->save();

      return response()->json(new LinkResource($link), 200);
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
      'id' => 'required',
      'image' => 'required|mimes:png,jpg,jpeg',
    ]);

    try {

      $service = new FileService();

      //Evaluar
      $link = Link::where('id', $request->id)
        ->where('user_id', auth()->user()->id)
        ->first();

      $link = $service->updateImage($link, $request);
      $link->save();


      return response()->json(new LinkResource($link), 200);
    } catch (\Exception $e) {
      return response()->json(['error' => $e->getMessage()], 400);
    }
  }




  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Link $link)
  {
    $request->validate([
      'name' => 'required|max:20',
      'url' => 'required',
    ]);

    try {

      $link->name = $request->name;
      $link->url = $request->url;

      $link->save();

      return response()->json(new LinkResource($link), 200);
    } catch (\Exception $e) {
      return response()->json(['error' => $e->getMessage()], 400);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Link $link)
  {
    try {

      if (
        !is_null($link->image)
        && file_exists(storage_path() . $link->image)
        && $link->image !=  '/default-avatar.jpeg'
        && $link->image != '/link-placeholder.png'
      ) {
        unlink(storage_path() . $link->image);
      }

      $link->delete();

      return response()->json(new LinkResource($link), 200);
    } catch (\Exception $e) {
      return response()->json(['error' => $e->getMessage()], 400);
    }
  }
}
