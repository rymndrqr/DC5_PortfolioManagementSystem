<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use App\Models\Achievement;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

// Public portfolio page (Inertia — no auth)
Route::get('/portfolio', function () {
    return Inertia::render('Portfolio/Publicportfolio', [
        'projects' => Project::orderByDesc('featured')
            ->orderBy('sort_order')
            ->get()
            ->append(['image_url', 'tech_array'])
            ->toArray(),
        'achievements' => Achievement::orderByDesc('featured')
            ->orderByDesc('date_received')
            ->get()
            ->append(['image_url', 'type_label'])
            ->toArray(),
        'skills' => Skill::orderBy('category')
            ->orderBy('sort_order')
            ->get()
            ->toArray(),
    ]);
})->name('portfolio.public');

// Public JSON APIs
Route::get('/api/projects',      [ProjectController::class, 'publicApi'])->name('api.projects');
Route::get('/api/achievements',  [AchievementController::class, 'publicApi'])->name('api.achievements');
Route::get('/api/skills',        [SkillController::class, 'publicApi'])->name('api.skills');

/*
|--------------------------------------------------------------------------
| Authenticated admin routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard', [
            'projectCount'   => Project::count(),
            'recentProjects' => Project::latest()
                ->take(3)
                ->get(['id', 'title', 'category', 'status', 'featured'])
                ->toArray(),
        ]);
    })->name('dashboard');

    Route::resource('projects',     ProjectController::class);
    Route::resource('achievements', AchievementController::class)->except(['show']);
    Route::resource('skills',       SkillController::class)->except(['show']);

    // Keep show routes for achievements
    Route::get('/achievements/{achievement}', [AchievementController::class, 'show'])
        ->name('achievements.show');
});

require __DIR__ . '/auth.php';
