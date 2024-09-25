<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;

class HeroSectionController extends Controller
{
    public function index()
    {
        $heroSections = HeroSection::all();
        return response()->json($heroSections);
    }

    public function show($id)
    {
        $heroSection = HeroSection::findOrFail($id);
        return response()->json($heroSection);
    }
}