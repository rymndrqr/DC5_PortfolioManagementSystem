<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { ref, computed } from 'vue'

const props = defineProps({
    projects: Array,
    achievements: Array,
    skills: Array,
})

const activeSection = ref('projects')
const activeFilter = ref('All')

const categories = computed(() => {
    const cats = [...new Set(props.projects.map((project) => project.category))]
    return ['All', ...cats]
})

const filteredProjects = computed(() => {
    if (activeFilter.value === 'All') return props.projects
    return props.projects.filter((project) => project.category === activeFilter.value)
})

const skillsByCategory = computed(() => {
    return props.skills.reduce((groups, skill) => {
        if (!groups[skill.category]) groups[skill.category] = []
        groups[skill.category].push(skill)
        return groups
    }, {})
})

const statusColors = {
    completed: 'text-emerald-400 bg-emerald-400/10',
    in_progress: 'text-amber-400 bg-amber-400/10',
    archived: 'text-zinc-400 bg-zinc-800',
}

const formatDate = (value) => {
    if (!value) return null
    return new Date(value).toLocaleDateString('en-PH', { year: 'numeric', month: 'short' })
}
</script>

<template>
    <div class="min-h-screen bg-zinc-950 text-white">
        <Head title="Portfolio" />

        <div class="max-w-6xl mx-auto px-6 py-10">
            <div class="mb-10 space-y-4">
                <p class="text-xs uppercase tracking-[0.3em] text-zinc-500">Portfolio</p>
                <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                    <div>
                        <h1 class="text-4xl font-semibold text-white">Public portfolio</h1>
                        <p class="mt-3 max-w-2xl text-sm text-zinc-400">Browse the latest projects, achievements, and skills in a clean, consistent layout.</p>
                    </div>
                    <Link :href="route('login')" class="inline-flex items-center justify-center rounded-2xl border border-zinc-800 bg-zinc-900 px-4 py-3 text-sm text-zinc-300 transition hover:border-zinc-700 hover:bg-zinc-800">Admin login</Link>
                </div>
            </div>

            <div class="grid gap-5 lg:grid-cols-[1.6fr_0.9fr] mb-10">
                <section class="rounded-[28px] border border-zinc-800 bg-zinc-950 p-6">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-zinc-500">Summary</p>
                            <h2 class="mt-2 text-2xl font-semibold text-white">Portfolio overview</h2>
                        </div>
                        <div class="rounded-2xl border border-amber-300/20 bg-amber-300/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.18em] text-amber-300">Public</div>
                    </div>
                    <p class="mt-4 text-sm text-zinc-400">This page gives a public view of projects, certifications, and your core abilities without requiring authentication.</p>

                    <div class="mt-6 grid gap-4 sm:grid-cols-3">
                        <div class="rounded-3xl border border-zinc-800 bg-zinc-900 p-4 text-center">
                            <p class="text-3xl font-semibold text-white">{{ props.projects.length }}</p>
                            <p class="mt-2 text-xs uppercase tracking-[0.18em] text-zinc-500">Projects</p>
                        </div>
                        <div class="rounded-3xl border border-zinc-800 bg-zinc-900 p-4 text-center">
                            <p class="text-3xl font-semibold text-white">{{ props.achievements.length }}</p>
                            <p class="mt-2 text-xs uppercase tracking-[0.18em] text-zinc-500">Achievements</p>
                        </div>
                        <div class="rounded-3xl border border-zinc-800 bg-zinc-900 p-4 text-center">
                            <p class="text-3xl font-semibold text-white">{{ props.skills.length }}</p>
                            <p class="mt-2 text-xs uppercase tracking-[0.18em] text-zinc-500">Skills</p>
                        </div>
                    </div>
                </section>

                <aside class="space-y-5">
                    <div class="rounded-[28px] border border-zinc-800 bg-zinc-950 p-6">
                        <p class="text-xs uppercase tracking-[0.3em] text-zinc-500">Quick access</p>
                        <div class="mt-4 grid gap-3">
                            <button @click="activeSection = 'projects'" :class="['w-full rounded-2xl px-4 py-3 text-left text-sm transition', activeSection === 'projects' ? 'bg-amber-300 text-zinc-950' : 'bg-zinc-900 text-zinc-300 hover:bg-zinc-800']">Projects</button>
                            <button @click="activeSection = 'achievements'" :class="['w-full rounded-2xl px-4 py-3 text-left text-sm transition', activeSection === 'achievements' ? 'bg-amber-300 text-zinc-950' : 'bg-zinc-900 text-zinc-300 hover:bg-zinc-800']">Achievements</button>
                            <button @click="activeSection = 'skills'" :class="['w-full rounded-2xl px-4 py-3 text-left text-sm transition', activeSection === 'skills' ? 'bg-amber-300 text-zinc-950' : 'bg-zinc-900 text-zinc-300 hover:bg-zinc-800']">Skills</button>
                        </div>
                    </div>
                    <div class="rounded-[28px] border border-zinc-800 bg-zinc-950 p-6">
                        <p class="text-xs uppercase tracking-[0.3em] text-zinc-500">About</p>
                        <p class="mt-3 text-sm leading-6 text-zinc-400">A modern portfolio page mirrors the admin UI while staying accessible and focused on content.</p>
                    </div>
                </aside>
            </div>

            <div class="rounded-[28px] border border-zinc-800 bg-zinc-950 p-6 mb-10">
                <div class="flex flex-wrap items-center gap-3">
                    <button @click="activeSection = 'projects'" :class="['rounded-full px-4 py-2 text-sm font-semibold transition', activeSection === 'projects' ? 'bg-amber-300 text-zinc-950' : 'bg-zinc-900 text-zinc-300 hover:bg-zinc-800']">Projects</button>
                    <button @click="activeSection = 'achievements'" :class="['rounded-full px-4 py-2 text-sm font-semibold transition', activeSection === 'achievements' ? 'bg-amber-300 text-zinc-950' : 'bg-zinc-900 text-zinc-300 hover:bg-zinc-800']">Achievements</button>
                    <button @click="activeSection = 'skills'" :class="['rounded-full px-4 py-2 text-sm font-semibold transition', activeSection === 'skills' ? 'bg-amber-300 text-zinc-950' : 'bg-zinc-900 text-zinc-300 hover:bg-zinc-800']">Skills</button>
                </div>
            </div>

            <section v-if="activeSection === 'projects'" class="mb-20">
                <div class="mb-8 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.3em] text-zinc-500">Projects</p>
                        <h2 class="mt-3 text-3xl font-semibold text-white">Selected work</h2>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <button v-for="cat in categories" :key="cat" @click="activeFilter = cat"
                            :class="['rounded-full px-4 py-2 text-sm font-semibold transition', activeFilter === cat ? 'bg-amber-300 text-zinc-950' : 'bg-zinc-900 text-zinc-300 hover:bg-zinc-800']">
                            {{ cat }}
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div v-for="project in filteredProjects" :key="project.id" class="rounded-[28px] border border-zinc-800 bg-zinc-950 p-6">
                        <div class="flex items-center justify-between gap-3 mb-4">
                            <span class="text-xs uppercase tracking-[0.3em] text-zinc-500">{{ project.category }}</span>
                            <span :class="['rounded-full px-3 py-1 text-xs uppercase tracking-[0.2em]', statusColors[project.status]]">{{ project.status === 'in_progress' ? 'In Progress' : project.status.charAt(0).toUpperCase() + project.status.slice(1) }}</span>
                        </div>
                        <h3 class="text-2xl font-semibold text-white mb-3">{{ project.title }}</h3>
                        <p class="text-sm leading-7 text-zinc-400 mb-4">{{ project.description }}</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span v-for="tech in project.tech_array" :key="tech" class="rounded-full border border-zinc-800 bg-zinc-900 px-3 py-1 text-xs text-zinc-300">{{ tech }}</span>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            <a v-if="project.live_url" :href="project.live_url" target="_blank" class="rounded-2xl border border-amber-300/20 bg-amber-300/10 px-4 py-2 text-sm font-semibold text-amber-300 transition hover:bg-amber-300/15">Live demo</a>
                            <a v-if="project.github_url" :href="project.github_url" target="_blank" class="rounded-2xl border border-zinc-800 bg-zinc-900 px-4 py-2 text-sm text-zinc-300 transition hover:bg-zinc-800">GitHub</a>
                        </div>
                        <p v-if="!project.live_url && !project.github_url" class="mt-4 text-xs text-zinc-500">No public links available.</p>
                    </div>
                </div>
                <p v-if="filteredProjects.length === 0" class="mt-12 text-center text-zinc-500">No projects matched this filter.</p>
            </section>

            <section v-if="activeSection === 'achievements'" class="mb-20">
                <div class="mb-8">
                    <p class="text-xs uppercase tracking-[0.3em] text-zinc-500">Achievements</p>
                    <h2 class="mt-3 text-3xl font-semibold text-white">Certifications & awards</h2>
                </div>
                <div v-if="props.achievements.length > 0" class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div v-for="achievement in props.achievements" :key="achievement.id" class="rounded-[28px] border border-zinc-800 bg-zinc-950 p-6">
                        <div class="flex items-center justify-between gap-4 mb-4">
                            <p class="text-xs uppercase tracking-[0.3em] text-zinc-500">{{ achievement.type_label }}</p>
                            <span class="text-xs text-zinc-400">{{ formatDate(achievement.date_received) }}</span>
                        </div>
                        <h3 class="text-2xl font-semibold text-white mb-3">{{ achievement.title }}</h3>
                        <p class="text-sm leading-7 text-zinc-400 mb-4">{{ achievement.description }}</p>
                        <div class="flex items-center justify-between text-sm text-zinc-300">
                            <span>{{ achievement.issuer }}</span>
                            <a v-if="achievement.credential_url" :href="achievement.credential_url" target="_blank" class="text-amber-300 hover:text-amber-200">View</a>
                        </div>
                    </div>
                </div>
                <p v-else class="text-center text-zinc-500 py-20">No achievements available yet.</p>
            </section>

            <section v-if="activeSection === 'skills'" class="mb-20">
                <div class="mb-8">
                    <p class="text-xs uppercase tracking-[0.3em] text-zinc-500">Skills</p>
                    <h2 class="mt-3 text-3xl font-semibold text-white">Core strengths</h2>
                </div>
                <div v-if="Object.keys(skillsByCategory).length > 0" class="grid gap-6 lg:grid-cols-3">
                    <div v-for="(skillGroup, category) in skillsByCategory" :key="category" class="rounded-[28px] border border-zinc-800 bg-zinc-950 p-6">
                        <p class="text-xs uppercase tracking-[0.3em] text-zinc-500">{{ category }}</p>
                        <div class="mt-5 space-y-5">
                            <div v-for="skill in skillGroup" :key="skill.id">
                                <div class="flex items-center justify-between text-sm text-zinc-200 mb-2">
                                    <span>{{ skill.name }}</span>
                                    <span class="text-zinc-400">{{ skill.proficiency }}%</span>
                                </div>
                                <div class="h-2 rounded-full bg-zinc-800 overflow-hidden">
                                    <div class="h-full rounded-full bg-amber-300" :style="`width: ${skill.proficiency}%`"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p v-else class="text-center text-zinc-500 py-20">No skills have been added yet.</p>
            </section>

            <footer class="rounded-[28px] border border-zinc-800 bg-zinc-950 p-6 text-sm text-zinc-500">
                Built with Laravel + Vue + Inertia
            </footer>
        </div>
    </div>
</template>
