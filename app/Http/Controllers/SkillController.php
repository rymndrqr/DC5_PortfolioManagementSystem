<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SkillController extends Controller
{
    public function index(): Response
    {
        $skills = Skill::orderBy('category')->orderBy('sort_order')->get();

        return Inertia::render('Skills/Index', [
            'skills' => $skills,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Skills/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'category'    => 'required|string|max:100',
            'proficiency' => 'required|integer|min:1|max:100',
            'icon'        => 'nullable|string|max:10',
            'sort_order'  => 'integer',
        ]);

        Skill::create($validated);

        return redirect()->route('skills.index')
            ->with('success', 'Skill added successfully.');
    }

    public function edit(Skill $skill): Response
    {
        return Inertia::render('Skills/Edit', [
            'skill' => $skill,
        ]);
    }

    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'category'    => 'required|string|max:100',
            'proficiency' => 'required|integer|min:1|max:100',
            'icon'        => 'nullable|string|max:10',
            'sort_order'  => 'integer',
        ]);

        $skill->update($validated);

        return redirect()->route('skills.index')
            ->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()->route('skills.index')
            ->with('success', 'Skill deleted successfully.');
    }

    public function publicApi()
    {
        $skills = Skill::orderBy('category')
            ->orderBy('sort_order')
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $skills,
            'count'   => $skills->count(),
        ]);
    }
}
