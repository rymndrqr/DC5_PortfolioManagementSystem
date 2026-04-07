<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

defineProps({ projects: Object })

const statusColors = {
    completed:   'bg-emerald-900/40 text-emerald-400',
    in_progress: 'bg-amber-900/40 text-amber-400',
    archived:    'bg-zinc-800 text-zinc-400',
}

const deleteProject = (id) => {
    if (confirm('Delete this project?')) router.delete(route('projects.destroy', id))
}
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Projects" />

        <div class="flex items-center justify-between mb-8">
            <div>
                <p class="text-amber-400 text-xs font-bold uppercase tracking-widest mb-1" style="font-family: system-ui;">Manage</p>
                <h1 class="text-3xl font-black" style="font-family: Georgia, serif;">Projects</h1>
            </div>
            <Link :href="route('projects.create')"
                class="bg-amber-400 text-zinc-950 px-5 py-2 rounded-lg text-sm font-bold hover:bg-amber-300 transition-all flex items-center gap-2"
                style="font-family: system-ui;">
                + New Project
            </Link>
        </div>

        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
            <table class="w-full text-sm" style="font-family: system-ui;">
                <thead>
                    <tr class="border-b border-zinc-800">
                        <th class="text-left text-zinc-500 font-medium px-5 py-3">Title</th>
                        <th class="text-left text-zinc-500 font-medium px-5 py-3">Category</th>
                        <th class="text-left text-zinc-500 font-medium px-5 py-3">Status</th>
                        <th class="text-left text-zinc-500 font-medium px-5 py-3">Featured</th>
                        <th class="text-right text-zinc-500 font-medium px-5 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="project in projects.data" :key="project.id"
                        class="border-b border-zinc-800 last:border-0 hover:bg-zinc-800/40 transition-colors">
                        <td class="px-5 py-4">
                            <p class="font-semibold text-white">{{ project.title }}</p>
                            <p class="text-zinc-500 text-xs mt-0.5 truncate max-w-xs">{{ project.description }}</p>
                        </td>
                        <td class="px-5 py-4 text-zinc-300">{{ project.category }}</td>
                        <td class="px-5 py-4">
                            <span :class="['inline-block px-2 py-0.5 rounded-full text-xs font-medium', statusColors[project.status]]">
                                {{ project.status === 'in_progress' ? 'In Progress' : project.status.charAt(0).toUpperCase() + project.status.slice(1) }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <span v-if="project.featured" class="text-amber-400 text-xs font-bold">★ Featured</span>
                            <span v-else class="text-zinc-600 text-xs">—</span>
                        </td>
                        <td class="px-5 py-4 text-right">
                            <div class="flex items-center gap-2 justify-end">
                                <Link :href="route('projects.show', project.id)"
                                    class="text-zinc-400 hover:text-white text-xs px-2 py-1 rounded hover:bg-zinc-800 transition-colors">View</Link>
                                <Link :href="route('projects.edit', project.id)"
                                    class="text-amber-400 hover:text-amber-300 text-xs px-2 py-1 rounded hover:bg-zinc-800 transition-colors">Edit</Link>
                                <button @click="deleteProject(project.id)"
                                    class="text-red-400 hover:text-red-300 text-xs px-2 py-1 rounded hover:bg-zinc-800 transition-colors">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="flex items-center justify-between mt-5 text-sm text-zinc-500" style="font-family: system-ui;">
            <span>Showing {{ projects.from }}–{{ projects.to }} of {{ projects.total }}</span>
            <div class="flex gap-2">
                <Link v-if="projects.prev_page_url" :href="projects.prev_page_url"
                    class="px-3 py-1.5 bg-zinc-800 hover:bg-zinc-700 rounded-lg transition-colors text-xs">← Prev</Link>
                <Link v-if="projects.next_page_url" :href="projects.next_page_url"
                    class="px-3 py-1.5 bg-zinc-800 hover:bg-zinc-700 rounded-lg transition-colors text-xs">Next →</Link>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
