<?php

namespace App\Http\Controllers\Api;

use App\Models\Theme;
use App\Http\Controllers\Controller;
use App\Http\Resources\ThemeResource;

class ThemeController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    try {
      return response()->json(ThemeResource::collection(Theme::all()), 200);
    } catch (\Exception $e) {
      return response()->json(['error' => $e->getMessage()], 400);
    }
  }
}
