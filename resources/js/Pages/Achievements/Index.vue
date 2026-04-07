<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

defineProps({ achievements: Object })

const typeColors = {
    certification: 'bg-blue-900/40 text-blue-400',
    award:         'bg-amber-900/40 text-amber-400',
    recognition:   'bg-emerald-900/40 text-emerald-400',
    publication:   'bg-violet-900/40 text-violet-400',
    education:     'bg-rose-900/40 text-rose-400',
}

const deleteAchievement = (id) => {
    if (confirm('Delete this achievement?')) router.delete(route('achievements.destroy', id))
}
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Achievements" />
        <div class="flex items-center justify-between mb-8">
            <div>
                <p class="text-amber-400 text-xs font-bold uppercase tracking-widest mb-1" style="font-family: system-ui;">Manage</p>
                <h1 class="text-3xl font-black" style="font-family: Georgia, serif;">Achievements</h1>
            </div>
            <Link :href="route('achievements.create')"
                class="bg-amber-400 text-zinc-950 px-5 py-2 rounded-lg text-sm font-bold hover:bg-amber-300 transition-all"
                style="font-family: system-ui;">+ New Achievement</Link>
        </div>
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
            <table class="w-full text-sm" style="font-family: system-ui;">
                <thead>
                    <tr class="border-b border-zinc-800">
                        <th class="text-left text-zinc-500 font-medium px-5 py-3">Achievement</th>
                        <th class="text-left text-zinc-500 font-medium px-5 py-3">Issuer</th>
                        <th class="text-left text-zinc-500 font-medium px-5 py-3">Type</th>
                        <th class="text-left text-zinc-500 font-medium px-5 py-3">Date</th>
                        <th class="text-right text-zinc-500 font-medium px-5 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="a in achievements.data" :key="a.id"
                        class="border-b border-zinc-800 last:border-0 hover:bg-zinc-800/40 transition-colors">
                        <td class="px-5 py-4">
                            <p class="font-semibold text-white">{{ a.title }}</p>
                            <span v-if="a.featured" class="text-amber-400 text-xs">★ Featured</span>
                        </td>
                        <td class="px-5 py-4 text-zinc-300">{{ a.issuer }}</td>
                        <td class="px-5 py-4">
                            <span :class="['inline-block px-2 py-0.5 rounded-full text-xs font-medium capitalize', typeColors[a.type]]">
                                {{ a.type }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-zinc-400">{{ new Date(a.date_received).toLocaleDateString('en-PH', { year: 'numeric', month: 'short' }) }}</td>
                        <td class="px-5 py-4 text-right">
                            <div class="flex items-center gap-2 justify-end">
                                <Link :href="route('achievements.edit', a.id)"
                                    class="text-amber-400 hover:text-amber-300 text-xs px-2 py-1 rounded hover:bg-zinc-800 transition-colors">Edit</Link>
                                <button @click="deleteAchievement(a.id)"
                                    class="text-red-400 hover:text-red-300 text-xs px-2 py-1 rounded hover:bg-zinc-800 transition-colors">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex items-center justify-between mt-5 text-sm text-zinc-500" style="font-family: system-ui;">
            <span>{{ achievements.total }} achievements</span>
            <div class="flex gap-2">
                <Link v-if="achievements.prev_page_url" :href="achievements.prev_page_url" class="px-3 py-1.5 bg-zinc-800 hover:bg-zinc-700 rounded-lg text-xs">← Prev</Link>
                <Link v-if="achievements.next_page_url" :href="achievements.next_page_url" class="px-3 py-1.5 bg-zinc-800 hover:bg-zinc-700 rounded-lg text-xs">Next →</Link>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
