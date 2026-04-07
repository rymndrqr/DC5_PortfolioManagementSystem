<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const props = defineProps({ project: Object })

const deleteProject = () => {
    if (confirm('Delete this project?')) router.delete(route('projects.destroy', props.project.id))
}
</script>

<template>
    <AuthenticatedLayout>
        <Head :title="project.title" />

        <div class="max-w-3xl space-y-8">
            <div>
                <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.3em] text-zinc-500">Project</p>
                        <h1 class="text-3xl font-semibold text-white">{{ project.title }}</h1>
                        <p class="mt-3 text-sm text-zinc-400">A focused overview of this portfolio entry.</p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <Link :href="route('projects.edit', project.id)" class="rounded-2xl border border-amber-300/20 bg-amber-300/10 px-5 py-3 text-sm font-semibold text-amber-300 transition hover:bg-amber-300/15">Edit</Link>
                        <button @click="deleteProject" class="rounded-2xl border border-red-500/20 bg-red-500/5 px-5 py-3 text-sm text-red-300 transition hover:bg-red-500/10">Delete</button>
                    </div>
                </div>
            </div>

            <div class="rounded-[28px] border border-zinc-800 bg-zinc-950 p-6 space-y-6">
                <div class="grid gap-4 sm:grid-cols-3">
                    <div>
                        <p class="text-xs uppercase tracking-[0.3em] text-zinc-500">Category</p>
                        <p class="mt-2 text-sm text-white">{{ project.category }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.3em] text-zinc-500">Status</p>
                        <p class="mt-2 text-sm text-white">{{ project.status === 'in_progress' ? 'In Progress' : project.status.charAt(0).toUpperCase() + project.status.slice(1) }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.3em] text-zinc-500">Featured</p>
                        <p class="mt-2 text-sm text-white">{{ project.featured ? 'Yes' : 'No' }}</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <p class="text-xs uppercase tracking-[0.3em] text-zinc-500">Description</p>
                        <p class="mt-3 text-sm leading-7 text-zinc-300">{{ project.long_description || project.description }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.3em] text-zinc-500 mb-3">Tech stack</p>
                        <div class="flex flex-wrap gap-2">
                            <span v-for="tech in project.tech_array" :key="tech" class="rounded-full border border-zinc-800 bg-white/5 px-3 py-1 text-xs text-zinc-300">{{ tech }}</span>
                        </div>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div v-if="project.live_url" class="rounded-2xl border border-zinc-800 bg-zinc-900 p-4">
                            <p class="text-xs uppercase tracking-[0.3em] text-zinc-500">Live URL</p>
                            <a :href="project.live_url" target="_blank" class="mt-2 block text-sm text-amber-300 hover:text-amber-200 break-all">{{ project.live_url }}</a>
                        </div>
                        <div v-if="project.github_url" class="rounded-2xl border border-zinc-800 bg-zinc-900 p-4">
                            <p class="text-xs uppercase tracking-[0.3em] text-zinc-500">GitHub</p>
                            <a :href="project.github_url" target="_blank" class="mt-2 block text-sm text-amber-300 hover:text-amber-200 break-all">{{ project.github_url }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
