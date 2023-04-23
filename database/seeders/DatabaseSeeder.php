<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // \App\Models\User::factory(10)->create();

    \App\Models\Theme::create([
      'id' => 1,
      'name' => "Air White",
      'color' => "bg-white",
      'text' => "text-black",
    ]);
    \App\Models\Theme::create([
      'id' => 2,
      'name' => "Air black",
      'color' => "bg-gray-800",
      'text' => "text-white",
    ]);

    \App\Models\Theme::create([
      'id' => 3,
      'name' => "Purple Pie",
      'color' => "bg-gradient-to-t from-indigo-500 via-purple-500 to-pink-500",
      'text' => "text-white",
    ]);

    \App\Models\Theme::create([
      'id' => 4,
      'name' => "Green Grass",
      'color' => "bg-gradient-to-t from-gray-500 via-blue-500 to-green-500",
      'text' => "text-white",
    ]);

    \App\Models\Theme::create([
      'id' => 5,
      'name' => "Traffic Lights",
      'color' => "bg-gradient-to-t from-orange-500 via-green-500 to-red-500",
      'text' => "text-white",
    ]);

    \App\Models\Theme::create([
      'id' => 6,
      'name' => "Blue Sky",
      'color' => "bg-gradient-to-b from-blue-800 via-blue-500 to-green-500",
      'text' => "text-white",
    ]);

    \App\Models\Theme::create([
      'id' => 7,
      'name' => "Soft Horizon",
      'color' => "bg-gradient-to-t from-lime-500 via-indigo-700 to-amber-500",
      'text' => "text-white",
    ]);

    \App\Models\Theme::create([
      'id' => 8,
      'name' => "Tinted Lake",
      'color' => "bg-gradient-to-t from-gray-800 to-emerald-500",
      'text' => "text-white",
    ]);
  }
}
