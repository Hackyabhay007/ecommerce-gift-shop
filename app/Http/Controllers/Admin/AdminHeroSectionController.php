<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;

class AdminHeroSectionController extends Controller
{
    public function index()
    {
        $heroSections = HeroSection::all();
        return view('admin.hero-sections.index', compact('heroSections'));
    }

    public function create()
    {
        return view('admin.hero-sections.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'heading' => 'required|string|max:255',
            'subheading' => 'required|string',
            'button_text' => 'required|string|max:50',
            'button_link' => 'required|string',
            'image' => 'required|string',
            'bg_color' => 'required|string|size:7',
        ]);

        HeroSection::create($validatedData);

        return redirect()->route('admin.hero-sections.index')->with('success', 'Hero section created successfully');
    }

    public function edit(HeroSection $heroSection)
    {
        return view('admin.hero-sections.edit', compact('heroSection'));
    }

    public function update(Request $request, HeroSection $heroSection)
    {
        $validatedData = $request->validate([
            'heading' => 'required|string|max:255',
            'subheading' => 'required|string',
            'button_text' => 'required|string|max:50',
            'button_link' => 'required|string',
            'image' => 'required|string',
            'bg_color' => 'required|string|size:7',
        ]);

        $heroSection->update($validatedData);

        return redirect()->route('admin.hero-sections.index')->with('success', 'Hero section updated successfully');
    }

    public function destroy(HeroSection $heroSection)
    {
        $heroSection->delete();

        return redirect()->route('admin.hero-sections.index')->with('success', 'Hero section deleted successfully');
    }
}