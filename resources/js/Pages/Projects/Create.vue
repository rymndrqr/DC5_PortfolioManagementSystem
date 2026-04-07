<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const form = useForm({
    title: '',
    description: '',
    long_description: '',
    category: '',
    tech_stack: '',
    live_url: '',
    github_url: '',
    image: null,
    featured: false,
    status: 'completed',
    completed_at: '',
    sort_order: 0,
})

const submit = () => form.post(route('projects.store'), { forceFormData: true })
</script>

<template>
    <AuthenticatedLayout>
        <Head title="New Project" />

        <div class="max-w-3xl space-y-8">
            <div>
                <p class="text-xs uppercase tracking-[0.3em] text-zinc-500 mb-2">Project</p>
                <h1 class="text-3xl font-semibold text-white">New project</h1>
                <p class="mt-3 text-sm text-zinc-400">Add a new portfolio entry with title, status, and project details.</p>
            </div>

            <form @submit.prevent="submit" class="space-y-6">
                <div class="space-y-5 rounded-[28px] border border-zinc-800 bg-zinc-950 p-6">
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-zinc-300">Title *</label>
                            <input v-model="form.title" type="text" placeholder="Project name" class="w-full rounded-2xl border border-zinc-800 bg-zinc-900 px-4 py-3 text-sm text-white outline-none transition focus:border-amber-300" />
                            <p v-if="form.errors.title" class="text-xs text-red-400">{{ form.errors.title }}</p>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-zinc-300">Category *</label>
                            <select v-model="form.category" class="w-full rounded-2xl border border-zinc-800 bg-zinc-900 px-4 py-3 text-sm text-white outline-none transition focus:border-amber-300">
                                <option value="" disabled>Select a category</option>
                                <option>Web</option>
                                <option>Mobile</option>
                                <option>Design</option>
                                <option>Other</option>
                            </select>
                            <p v-if="form.errors.category" class="text-xs text-red-400">{{ form.errors.category }}</p>
                        </div>
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-zinc-300">Status *</label>
                            <select v-model="form.status" class="w-full rounded-2xl border border-zinc-800 bg-zinc-900 px-4 py-3 text-sm text-white outline-none transition focus:border-amber-300">
                                <option value="completed">Completed</option>
                                <option value="in_progress">In Progress</option>
                                <option value="archived">Archived</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-zinc-300">Completed date</label>
                            <input v-model="form.completed_at" type="date" class="w-full rounded-2xl border border-zinc-800 bg-zinc-900 px-4 py-3 text-sm text-white outline-none transition focus:border-amber-300" />
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-zinc-300">Short description *</label>
                        <textarea v-model="form.description" rows="3" class="w-full rounded-2xl border border-zinc-800 bg-zinc-900 px-4 py-3 text-sm text-white outline-none transition focus:border-amber-300 resize-none"></textarea>
                        <p v-if="form.errors.description" class="text-xs text-red-400">{{ form.errors.description }}</p>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-zinc-300">Full description</label>
                        <textarea v-model="form.long_description" rows="4" class="w-full rounded-2xl border border-zinc-800 bg-zinc-900 px-4 py-3 text-sm text-white outline-none transition focus:border-amber-300 resize-none"></textarea>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-zinc-300">Tech stack *</label>
                        <input v-model="form.tech_stack" type="text" placeholder="Laravel, Vue 3, Tailwind" class="w-full rounded-2xl border border-zinc-800 bg-zinc-900 px-4 py-3 text-sm text-white outline-none transition focus:border-amber-300" />
                        <p v-if="form.errors.tech_stack" class="text-xs text-red-400">{{ form.errors.tech_stack }}</p>
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-zinc-300">Live URL</label>
                            <input v-model="form.live_url" type="url" placeholder="https://example.com" class="w-full rounded-2xl border border-zinc-800 bg-zinc-900 px-4 py-3 text-sm text-white outline-none transition focus:border-amber-300" />
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-zinc-300">GitHub URL</label>
                            <input v-model="form.github_url" type="url" placeholder="https://github.com/..." class="w-full rounded-2xl border border-zinc-800 bg-zinc-900 px-4 py-3 text-sm text-white outline-none transition focus:border-amber-300" />
                        </div>
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-zinc-300">Cover image</label>
                            <input type="file" accept="image/*" @change="form.image = $event.target.files[0]" class="w-full rounded-2xl border border-zinc-800 bg-zinc-900 px-4 py-3 text-sm text-zinc-300 outline-none transition focus:border-amber-300" />
                        </div>
                        <div class="flex items-center gap-3 rounded-2xl border border-zinc-800 bg-zinc-900 px-4 py-3">
                            <input v-model="form.featured" type="checkbox" id="featured" class="h-4 w-4 accent-amber-300" />
                            <label for="featured" class="text-sm text-zinc-300">Featured project</label>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <Link :href="route('projects.index')" class="rounded-2xl border border-zinc-800 bg-zinc-900 px-5 py-3 text-sm text-zinc-300 transition hover:bg-zinc-800">Cancel</Link>
                    <button type="submit" :disabled="form.processing" class="rounded-2xl bg-amber-300 px-5 py-3 text-sm font-semibold text-zinc-950 transition hover:bg-amber-200 disabled:cursor-not-allowed disabled:opacity-60">{{ form.processing ? 'Saving…' : 'Create project' }}</button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
