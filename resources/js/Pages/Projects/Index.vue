<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

defineProps({ projects: Object })

const statusColors = {
    completed:   'bg-emerald-500/10 text-emerald-300 border-emerald-500/20',
    in_progress: 'bg-amber-500/10 text-amber-300 border-amber-500/20',
    archived:    'bg-zinc-800 text-zinc-400 border-zinc-700',
}

const deleteProject = (id) => {
    if (confirm('Delete this project?')) router.delete(route('projects.destroy', id))
}
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Projects" />

        <div class="mb-8 space-y-3">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.3em] text-zinc-500">Projects</p>
                    <h1 class="text-3xl font-semibold text-white">Project management</h1>
                    <p class="mt-2 max-w-2xl text-sm text-zinc-400">Review, edit, and publish portfolio projects with clean action controls.</p>
                </div>
                <Link :href="route('projects.create')" class="inline-flex items-center justify-center rounded-2xl bg-amber-300/15 px-5 py-3 text-sm font-semibold text-amber-300 transition hover:bg-amber-300/20">New project</Link>
            </div>
            <div class="flex flex-wrap items-center gap-3 text-sm text-zinc-400">
                <span>{{ projects.total }} total projects</span>
                <span class="h-1 w-1 rounded-full bg-zinc-600"></span>
                <span>Showing {{ projects.from }}–{{ projects.to }}</span>
            </div>
        </div>

        <div class="overflow-hidden rounded-[28px] border border-zinc-800 bg-zinc-950">
            <table class="w-full text-left text-sm text-zinc-300">
                <thead class="border-b border-zinc-800 bg-zinc-900 text-zinc-500">
                    <tr>
                        <th class="px-5 py-4">Title</th>
                        <th class="px-5 py-4">Category</th>
                        <th class="px-5 py-4">Status</th>
                        <th class="px-5 py-4">Featured</th>
                        <th class="px-5 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="project in projects.data" :key="project.id" class="border-b border-zinc-800 hover:bg-zinc-900/80 transition-colors">
                        <td class="px-5 py-5">
                            <p class="font-semibold text-white">{{ project.title }}</p>
                            <p class="mt-1 text-xs text-zinc-500 truncate max-w-[28rem]">{{ project.description }}</p>
                        </td>
                        <td class="px-5 py-5 text-zinc-400">{{ project.category }}</td>
                        <td class="px-5 py-5">
                            <span :class="['inline-flex items-center rounded-full border px-3 py-1 text-xs font-semibold', statusColors[project.status]]">
                                {{ project.status === 'in_progress' ? 'In Progress' : project.status.charAt(0).toUpperCase() + project.status.slice(1) }}
                            </span>
                        </td>
                        <td class="px-5 py-5 text-zinc-400">{{ project.featured ? 'Yes' : 'No' }}</td>
                        <td class="px-5 py-5 text-right">
                            <div class="flex flex-wrap justify-end gap-2">
                                <Link :href="route('projects.show', project.id)" class="rounded-2xl border border-zinc-800 bg-zinc-900 px-3 py-2 text-xs text-zinc-300 transition hover:border-zinc-700">View</Link>
                                <Link :href="route('projects.edit', project.id)" class="rounded-2xl border border-amber-300/20 bg-amber-300/10 px-3 py-2 text-xs font-semibold text-amber-300 transition hover:bg-amber-300/15">Edit</Link>
                                <button @click="deleteProject(project.id)" class="rounded-2xl border border-red-500/20 bg-red-500/5 px-3 py-2 text-xs text-red-300 transition hover:bg-red-500/10">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex flex-wrap items-center justify-between gap-3 text-sm text-zinc-400">
            <div>Page navigation</div>
            <div class="flex flex-wrap gap-2">
                <Link v-if="projects.prev_page_url" :href="projects.prev_page_url" class="rounded-2xl bg-zinc-900 px-4 py-2 text-xs text-white transition hover:bg-zinc-800">Prev</Link>
                <Link v-if="projects.next_page_url" :href="projects.next_page_url" class="rounded-2xl bg-zinc-900 px-4 py-2 text-xs text-white transition hover:bg-zinc-800">Next</Link>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
