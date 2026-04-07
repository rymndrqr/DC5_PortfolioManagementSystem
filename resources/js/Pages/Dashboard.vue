<script setup>
import { Head, Link } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const props = defineProps({
    projectCount: Number,
    recentProjects: Array,
})
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Dashboard" />

        <div class="mb-10">
            <p class="text-xs uppercase tracking-[0.3em] text-zinc-500 mb-2">Overview</p>
            <h1 class="text-4xl font-semibold text-white">Dashboard</h1>
            <p class="mt-3 text-sm text-zinc-400 max-w-2xl">A simple admin view for managing your portfolio content with quick access to projects, achievements, and skills.</p>
        </div>

        <div class="grid gap-5 sm:grid-cols-3 mb-10">
            <div class="rounded-[28px] border border-zinc-800 bg-zinc-950 p-6 shadow-[0_20px_60px_rgba(15,23,42,0.35)]">
                <div class="text-sm uppercase tracking-[0.28em] text-zinc-500">Projects</div>
                <div class="mt-4 flex items-end justify-between gap-4">
                    <div>
                        <p class="text-3xl font-semibold text-white">{{ projectCount }}</p>
                        <p class="mt-2 text-sm text-zinc-400">Active portfolio entries</p>
                    </div>
                    <div class="rounded-2xl bg-white/5 px-3 py-2 text-xs font-semibold uppercase tracking-[0.25em] text-amber-300">Live</div>
                </div>
                <div class="mt-6 flex flex-wrap gap-3">
                    <Link :href="route('projects.index')" class="inline-flex items-center justify-center rounded-2xl border border-zinc-800 bg-zinc-900 px-4 py-2 text-sm text-white transition hover:border-zinc-700">View projects</Link>
                    <Link :href="route('projects.create')" class="inline-flex items-center justify-center rounded-2xl border border-amber-300/20 bg-amber-300/10 px-4 py-2 text-sm font-semibold text-amber-300 transition hover:bg-amber-300/15">Add project</Link>
                </div>
            </div>

            <Link :href="route('achievements.index')" class="rounded-[28px] border border-zinc-800 bg-zinc-950 p-6 transition hover:border-zinc-700">
                <div class="text-sm uppercase tracking-[0.28em] text-zinc-500">Achievements</div>
                <p class="mt-4 text-3xl font-semibold text-white">Manage</p>
                <p class="mt-2 text-sm text-zinc-400">Certifications, awards, and highlights.</p>
            </Link>

            <Link :href="route('skills.index')" class="rounded-[28px] border border-zinc-800 bg-zinc-950 p-6 transition hover:border-zinc-700">
                <div class="text-sm uppercase tracking-[0.28em] text-zinc-500">Skills</div>
                <p class="mt-4 text-3xl font-semibold text-white">Manage</p>
                <p class="mt-2 text-sm text-zinc-400">Topics and proficiencies for your portfolio.</p>
            </Link>
        </div>

        <div class="grid gap-6 lg:grid-cols-[1.6fr_1fr] mb-10">
            <section class="rounded-[28px] border border-zinc-800 bg-zinc-950 p-6">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-xs uppercase tracking-[0.3em] text-zinc-500">Recent projects</p>
                        <h2 class="mt-3 text-2xl font-semibold text-white">Latest updates</h2>
                    </div>
                    <Link :href="route('projects.index')" class="text-sm text-amber-300 hover:text-amber-200">Manage all</Link>
                </div>
                <div class="mt-6 space-y-4">
                    <div v-if="recentProjects.length" class="space-y-4">
                        <div v-for="project in recentProjects" :key="project.id" class="rounded-3xl border border-zinc-800 bg-zinc-900 p-5">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-base font-semibold text-white">{{ project.title }}</p>
                                    <p class="mt-1 text-sm text-zinc-400">{{ project.category }}</p>
                                </div>
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="rounded-full border border-zinc-800 bg-white/5 px-3 py-1 text-xs uppercase tracking-[0.28em] text-zinc-400">{{ project.featured ? 'Featured' : 'Standard' }}</span>
                                    <span :class="project.status === 'completed' ? 'bg-emerald-500/10 text-emerald-300 border-emerald-500/20' : project.status === 'in_progress' ? 'bg-amber-500/10 text-amber-300 border-amber-500/20' : 'bg-zinc-800 text-zinc-400 border-zinc-700'" class="rounded-full border px-3 py-1 text-xs uppercase tracking-[0.28em]">
                                        {{ project.status === 'in_progress' ? 'In Progress' : project.status === 'completed' ? 'Completed' : 'Archived' }}
                                    </span>
                                </div>
                            </div>
                            <div class="mt-4 flex flex-wrap gap-3">
                                <Link :href="route('projects.show', project.id)" class="rounded-2xl border border-zinc-800 bg-zinc-900 px-4 py-2 text-sm text-white transition hover:border-zinc-700">View</Link>
                                <Link :href="route('projects.edit', project.id)" class="rounded-2xl border border-amber-300/20 bg-amber-300/10 px-4 py-2 text-sm font-semibold text-amber-300 transition hover:bg-amber-300/15">Edit</Link>
                            </div>
                        </div>
                    </div>
                    <p v-else class="text-sm text-zinc-400">No recent projects available. Add a new project to populate this section.</p>
                </div>
            </section>

            <aside class="rounded-[28px] border border-zinc-800 bg-zinc-950 p-6">
                <p class="text-xs uppercase tracking-[0.3em] text-zinc-500">Public API</p>
                <h2 class="mt-3 text-xl font-semibold text-white">Endpoint</h2>
                <p class="mt-3 text-sm leading-6 text-zinc-400">Use this endpoint to retrieve published project data in JSON format without authentication.</p>
                <div class="mt-5 rounded-3xl border border-zinc-800 bg-zinc-900 p-4 font-mono text-sm text-amber-300">GET /api/projects</div>
            </aside>
        </div>
    </AuthenticatedLayout>
</template>
