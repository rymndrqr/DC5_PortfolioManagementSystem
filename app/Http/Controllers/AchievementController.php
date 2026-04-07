<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class AchievementController extends Controller
{
    public function index(): Response
    {
        $achievements = Achievement::latest()->paginate(10);

        return Inertia::render('Achievements/Index', [
            'achievements' => $achievements,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Achievements/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'required|string',
            'issuer'         => 'required|string|max:255',
            'type'           => 'required|in:certification,award,recognition,publication,education',
            'date_received'  => 'required|date',
            'credential_url' => 'nullable|url',
            'image'          => 'nullable|image|max:2048',
            'featured'       => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('achievements', 'public');
        }

        Achievement::create($validated);

        return redirect()->route('achievements.index')
            ->with('success', 'Achievement added successfully.');
    }

    public function show(Achievement $achievement): Response
    {
        return Inertia::render('Achievements/Show', [
            'achievement' => $achievement->append(['image_url', 'type_label']),
        ]);
    }

    public function edit(Achievement $achievement): Response
    {
        return Inertia::render('Achievements/Edit', [
            'achievement' => $achievement->append(['image_url', 'type_label']),
        ]);
    }

    public function update(Request $request, Achievement $achievement)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'required|string',
            'issuer'         => 'required|string|max:255',
            'type'           => 'required|in:certification,award,recognition,publication,education',
            'date_received'  => 'required|date',
            'credential_url' => 'nullable|url',
            'image'          => 'nullable|image|max:2048',
            'featured'       => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($achievement->image) {
                Storage::disk('public')->delete($achievement->image);
            }
            $validated['image'] = $request->file('image')->store('achievements', 'public');
        }

        $achievement->update($validated);

        return redirect()->route('achievements.index')
            ->with('success', 'Achievement updated successfully.');
    }

    public function destroy(Achievement $achievement)
    {
        if ($achievement->image) {
            Storage::disk('public')->delete($achievement->image);
        }

        $achievement->delete();

        return redirect()->route('achievements.index')
            ->with('success', 'Achievement deleted successfully.');
    }

    public function publicApi()
    {
        $achievements = Achievement::orderByDesc('featured')
            ->orderByDesc('date_received')
            ->get()
            ->append(['image_url', 'type_label']);

        return response()->json([
            'success' => true,
            'data'    => $achievements,
            'count'   => $achievements->count(),
        ]);
    }
}
