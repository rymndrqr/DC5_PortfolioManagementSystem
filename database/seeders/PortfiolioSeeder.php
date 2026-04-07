<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        // ── Projects ──────────────────────────────────────────────
        $projects = [
            [
                'title'            => 'E-Commerce Platform',
                'description'      => 'A full-featured online store with cart, checkout, and payment integration.',
                'long_description' => 'Built with Laravel and Vue 3, this platform handles thousands of SKUs with real-time inventory tracking, Stripe payments, and an admin dashboard for managing orders and products.',
                'category'         => 'Web',
                'tech_stack'       => 'Laravel, Vue 3, Inertia, Tailwind, Stripe, MySQL',
                'live_url'         => 'https://example.com',
                'github_url'       => 'https://github.com',
                'featured'         => true,
                'status'           => 'completed',
                'completed_at'     => '2024-03-01',
                'sort_order'       => 1,
            ],
            [
                'title'            => 'Task Management App',
                'description'      => 'A Kanban-style project management tool with real-time collaboration.',
                'long_description' => 'Real-time drag-and-drop Kanban board using Laravel Echo and Pusher. Teams can create boards, assign tasks, set due dates, and get notified instantly.',
                'category'         => 'Web',
                'tech_stack'       => 'Laravel, Vue 3, Pusher, Tailwind, SQLite',
                'live_url'         => null,
                'github_url'       => 'https://github.com',
                'featured'         => true,
                'status'           => 'completed',
                'completed_at'     => '2024-01-15',
                'sort_order'       => 2,
            ],
            [
                'title'            => 'Portfolio CMS',
                'description'      => 'A headless CMS for managing portfolio content with a public-facing API.',
                'long_description' => 'This very system! A Laravel + Inertia CMS that powers a portfolio site with a public JSON API, image uploads, and a clean admin panel.',
                'category'         => 'Web',
                'tech_stack'       => 'Laravel 12, Vue 3, Inertia, Tailwind',
                'live_url'         => null,
                'github_url'       => 'https://github.com',
                'featured'         => false,
                'status'           => 'completed',
                'completed_at'     => '2024-04-01',
                'sort_order'       => 3,
            ],
            [
                'title'            => 'Weather Mobile App',
                'description'      => 'Cross-platform mobile app showing real-time weather and 7-day forecasts.',
                'long_description' => 'Built with React Native, integrates with OpenWeatherMap API. Features include location detection, push notifications for severe weather, and an offline-first architecture.',
                'category'         => 'Mobile',
                'tech_stack'       => 'React Native, Expo, OpenWeatherMap API',
                'live_url'         => null,
                'github_url'       => 'https://github.com',
                'featured'         => false,
                'status'           => 'in_progress',
                'completed_at'     => null,
                'sort_order'       => 4,
            ],
            [
                'title'            => 'Data Analytics Dashboard',
                'description'      => 'Business intelligence dashboard with interactive charts and CSV exports.',
                'long_description' => 'Aggregates data from multiple sources and visualises KPIs. Built with Vue 3 and Chart.js, with a Laravel API backend that processes and caches large datasets.',
                'category'         => 'Web',
                'tech_stack'       => 'Vue 3, Chart.js, Laravel, Redis, PostgreSQL',
                'live_url'         => 'https://example.com',
                'github_url'       => null,
                'featured'         => true,
                'status'           => 'completed',
                'completed_at'     => '2023-11-20',
                'sort_order'       => 5,
            ],
        ];

        foreach ($projects as $data) {
            $data['slug'] = Str::slug($data['title']) . '-' . Str::random(4);
            Project::create($data);
        }

        // ── Achievements ──────────────────────────────────────────
        $achievements = [
            [
                'title'          => 'AWS Certified Solutions Architect',
                'description'    => 'Validated expertise in designing distributed systems on Amazon Web Services.',
                'issuer'         => 'Amazon Web Services',
                'type'           => 'certification',
                'date_received'  => '2024-02-15',
                'credential_url' => 'https://aws.amazon.com/certification/',
                'featured'       => true,
            ],
            [
                'title'          => 'Google Cloud Professional Developer',
                'description'    => 'Demonstrated ability to build, test, and deploy GCP applications.',
                'issuer'         => 'Google Cloud',
                'type'           => 'certification',
                'date_received'  => '2023-09-10',
                'credential_url' => 'https://cloud.google.com/certification',
                'featured'       => true,
            ],
            [
                'title'          => 'Best Web App — TechFest Manila 2023',
                'description'    => 'First place in the web application category at the annual TechFest competition.',
                'issuer'         => 'TechFest Manila',
                'type'           => 'award',
                'date_received'  => '2023-06-20',
                'credential_url' => null,
                'featured'       => true,
            ],
            [
                'title'          => 'Meta Frontend Developer Certificate',
                'description'    => 'Completed Meta\'s professional certificate program covering React, JS, and CSS.',
                'issuer'         => 'Meta / Coursera',
                'type'           => 'certification',
                'date_received'  => '2023-03-05',
                'credential_url' => 'https://coursera.org',
                'featured'       => false,
            ],
            [
                'title'          => 'BS Computer Science — Cum Laude',
                'description'    => 'Graduated with honors with a thesis on machine learning applied to crop prediction.',
                'issuer'         => 'University of the Philippines',
                'type'           => 'education',
                'date_received'  => '2022-05-30',
                'credential_url' => null,
                'featured'       => true,
            ],
            [
                'title'          => 'Open Source Contribution — Laravel',
                'description'    => 'Contributed a bug fix and documentation improvement to the Laravel framework.',
                'issuer'         => 'Laravel / GitHub',
                'type'           => 'recognition',
                'date_received'  => '2024-01-08',
                'credential_url' => 'https://github.com/laravel/framework',
                'featured'       => false,
            ],
        ];

        foreach ($achievements as $data) {
            Achievement::create($data);
        }

        // ── Skills ────────────────────────────────────────────────
        $skills = [
            // Frontend
            ['name' => 'Vue 3',        'category' => 'Frontend', 'proficiency' => 92, 'icon' => '⚡', 'sort_order' => 1],
            ['name' => 'React',        'category' => 'Frontend', 'proficiency' => 80, 'icon' => '⚛️', 'sort_order' => 2],
            ['name' => 'Tailwind CSS', 'category' => 'Frontend', 'proficiency' => 95, 'icon' => '🎨', 'sort_order' => 3],
            ['name' => 'TypeScript',   'category' => 'Frontend', 'proficiency' => 78, 'icon' => '🔷', 'sort_order' => 4],
            // Backend
            ['name' => 'Laravel',      'category' => 'Backend',  'proficiency' => 95, 'icon' => '🔴', 'sort_order' => 1],
            ['name' => 'Node.js',      'category' => 'Backend',  'proficiency' => 75, 'icon' => '🟢', 'sort_order' => 2],
            ['name' => 'PHP',          'category' => 'Backend',  'proficiency' => 90, 'icon' => '🐘', 'sort_order' => 3],
            ['name' => 'Python',       'category' => 'Backend',  'proficiency' => 70, 'icon' => '🐍', 'sort_order' => 4],
            // Database
            ['name' => 'MySQL',        'category' => 'Database', 'proficiency' => 88, 'icon' => '🗄️', 'sort_order' => 1],
            ['name' => 'PostgreSQL',   'category' => 'Database', 'proficiency' => 75, 'icon' => '🐘', 'sort_order' => 2],
            ['name' => 'Redis',        'category' => 'Database', 'proficiency' => 68, 'icon' => '🔴', 'sort_order' => 3],
            // DevOps
            ['name' => 'Docker',       'category' => 'DevOps',   'proficiency' => 72, 'icon' => '🐳', 'sort_order' => 1],
            ['name' => 'AWS',          'category' => 'DevOps',   'proficiency' => 80, 'icon' => '☁️', 'sort_order' => 2],
            ['name' => 'Git',          'category' => 'DevOps',   'proficiency' => 93, 'icon' => '🌿', 'sort_order' => 3],
        ];

        foreach ($skills as $data) {
            Skill::create($data);
        }

        $this->command->info('✅ Portfolio seeded: ' . Project::count() . ' projects, ' . Achievement::count() . ' achievements, ' . Skill::count() . ' skills.');
    }
}
