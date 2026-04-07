<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const form = useForm({ name: '', category: '', proficiency: 80, icon: '', sort_order: 0 })
const submit = () => form.post(route('skills.store'))
</script>

<template>
    <AuthenticatedLayout>
        <Head title="New Skill" />
        <div class="max-w-md">
            <div class="flex items-center gap-3 mb-6" style="font-family: system-ui;">
                <Link :href="route('skills.index')" class="text-zinc-500 hover:text-white">← Skills</Link>
                <span class="text-zinc-700">/</span>
                <h1 class="text-2xl font-black" style="font-family: Georgia, serif;">New Skill</h1>
            </div>
            <form @submit.prevent="submit" class="space-y-5" style="font-family: system-ui;">
                <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-zinc-400 mb-1 uppercase tracking-wider">Skill Name *</label>
                        <input v-model="form.name" type="text" placeholder="e.g. Vue 3"
                            class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-2.5 text-white text-sm placeholder-zinc-600 focus:outline-none focus:border-amber-400" />
                        <p v-if="form.errors.name" class="text-red-400 text-xs mt-1">{{ form.errors.name }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-zinc-400 mb-1 uppercase tracking-wider">Category *</label>
                        <select v-model="form.category"
                            class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-2.5 text-white text-sm focus:outline-none focus:border-amber-400">
                            <option value="" disabled>Select…</option>
                            <option>Frontend</option><option>Backend</option><option>Database</option>
                            <option>DevOps</option><option>Design</option><option>Other</option>
                        </select>
                        <p v-if="form.errors.category" class="text-red-400 text-xs mt-1">{{ form.errors.category }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-zinc-400 mb-1 uppercase tracking-wider">
                            Proficiency: {{ form.proficiency }}%
                        </label>
                        <input v-model="form.proficiency" type="range" min="1" max="100"
                            class="w-full accent-amber-400" />
                        <p v-if="form.errors.proficiency" class="text-red-400 text-xs mt-1">{{ form.errors.proficiency }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-zinc-400 mb-1 uppercase tracking-wider">Icon (emoji)</label>
                        <input v-model="form.icon" type="text" placeholder="⚡"
                            class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-2.5 text-white text-sm placeholder-zinc-600 focus:outline-none focus:border-amber-400" />
                    </div>
                </div>
                <div class="flex gap-3 justify-end">
                    <Link :href="route('skills.index')"
                        class="px-5 py-2.5 bg-zinc-800 hover:bg-zinc-700 text-white rounded-xl text-sm font-medium transition-colors">Cancel</Link>
                    <button type="submit" :disabled="form.processing"
                        class="px-5 py-2.5 bg-amber-400 hover:bg-amber-300 disabled:opacity-50 text-zinc-950 rounded-xl text-sm font-bold transition-colors">
                        {{ form.processing ? 'Saving…' : 'Add Skill' }}
                    </button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
