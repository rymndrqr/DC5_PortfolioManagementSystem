<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    public function index(): Response
    {
        $projects = Project::latest()->paginate(10);

        return Inertia::render('Projects/Index', [
            'projects' => $projects,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Projects/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'long_description' => 'nullable|string',
            'category'         => 'required|string|max:100',
            'tech_stack'       => 'required|string',
            'live_url'         => 'nullable|url',
            'github_url'       => 'nullable|url',
            'image'            => 'nullable|image|max:2048',
            'featured'         => 'boolean',
            'status'           => 'required|in:completed,in_progress,archived',
            'completed_at'     => 'nullable|date',
            'sort_order'       => 'integer',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        Project::create($validated);

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function show(Project $project): Response
    {
        return Inertia::render('Projects/Show', [
            'project' => $project->append(['image_url', 'tech_array']),
        ]);
    }

    public function edit(Project $project): Response
    {
        return Inertia::render('Projects/Edit', [
            'project' => $project->append(['image_url', 'tech_array']),
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'long_description' => 'nullable|string',
            'category'         => 'required|string|max:100',
            'tech_stack'       => 'required|string',
            'live_url'         => 'nullable|url',
            'github_url'       => 'nullable|url',
            'image'            => 'nullable|image|max:2048',
            'featured'         => 'boolean',
            'status'           => 'required|in:completed,in_progress,archived',
            'completed_at'     => 'nullable|date',
            'sort_order'       => 'integer',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($validated);

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    // Public API
    public function publicApi()
    {
        $projects = Project::latest()
            ->get()
            ->append(['image_url', 'tech_array']);

        return response()->json([
            'success' => true,
            'data'    => $projects,
            'count'   => $projects->count(),
        ]);
    }
}
