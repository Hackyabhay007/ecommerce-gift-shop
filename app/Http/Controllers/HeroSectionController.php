<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use Illuminate\Http\Request;

class HeroSectionController extends Controller
{
    // Get all hero sections
    public function index()
    {
        return HeroSection::all();
    }

    // Store a new hero section
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'image_url' => 'required|url',
        ]);

        $heroSection = HeroSection::create($validated);
        return response()->json($heroSection, 201);
    }

    // Show a hero section by ID
    public function show(HeroSection $heroSection)
    {
        return response()->json($heroSection);
    }

    // Update a hero section
    public function update(Request $request, HeroSection $heroSection)
    {
        $heroSection->update($request->all());
        return response()->json($heroSection);
    }

    // Delete a hero section
    public function destroy(HeroSection $heroSection)
    {
        $heroSection->delete();
        return response()->json(null, 204);
    }
}
