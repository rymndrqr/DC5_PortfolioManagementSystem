<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { computed } from 'vue'

const props = defineProps({ skills: Array })

const grouped = computed(() => {
    const g = {}
    props.skills.forEach(s => {
        if (!g[s.category]) g[s.category] = []
        g[s.category].push(s)
    })
    return g
})

const deleteSkill = (id) => {
    if (confirm('Delete this skill?')) router.delete(route('skills.destroy', id))
}
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Skills" />
        <div class="flex items-center justify-between mb-8">
            <div>
                <p class="text-amber-400 text-xs font-bold uppercase tracking-widest mb-1" style="font-family: system-ui;">Manage</p>
                <h1 class="text-3xl font-black" style="font-family: Georgia, serif;">Skills</h1>
            </div>
            <Link :href="route('skills.create')"
                class="bg-amber-400 text-zinc-950 px-5 py-2 rounded-lg text-sm font-bold hover:bg-amber-300 transition-all"
                style="font-family: system-ui;">+ New Skill</Link>
        </div>
        <div class="space-y-6" style="font-family: system-ui;">
            <div v-for="(group, category) in grouped" :key="category"
                class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
                <div class="px-5 py-3 border-b border-zinc-800 flex items-center justify-between">
                    <span class="text-amber-400 text-xs font-bold uppercase tracking-widest">{{ category }}</span>
                    <span class="text-zinc-500 text-xs">{{ group.length }} skills</span>
                </div>
                <div class="divide-y divide-zinc-800">
                    <div v-for="skill in group" :key="skill.id"
                        class="flex items-center gap-4 px-5 py-3 hover:bg-zinc-800/40 transition-colors">
                        <span class="text-xl w-7 text-center">{{ skill.icon }}</span>
                        <div class="flex-1">
                            <p class="text-white text-sm font-semibold">{{ skill.name }}</p>
                            <div class="flex items-center gap-2 mt-1">
                                <div class="flex-1 h-1.5 bg-zinc-800 rounded-full overflow-hidden">
                                    <div class="h-full bg-amber-400 rounded-full transition-all"
                                        :style="`width: ${skill.proficiency}%`"></div>
                                </div>
                                <span class="text-zinc-500 text-xs w-8 text-right">{{ skill.proficiency }}%</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <Link :href="route('skills.edit', skill.id)"
                                class="text-amber-400 hover:text-amber-300 text-xs px-2 py-1 rounded hover:bg-zinc-800 transition-colors">Edit</Link>
                            <button @click="deleteSkill(skill.id)"
                                class="text-red-400 hover:text-red-300 text-xs px-2 py-1 rounded hover:bg-zinc-800 transition-colors">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
