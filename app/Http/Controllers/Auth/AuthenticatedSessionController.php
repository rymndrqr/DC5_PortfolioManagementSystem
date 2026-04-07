<script setup>
import { Link, usePage } from '@inertiajs/vue3'

const page = usePage()
</script>

<template>
    <div class="min-h-screen bg-zinc-950 text-white flex font-sans">

        <!-- Sidebar -->
        <aside class="w-60 shrink-0 bg-zinc-900 border-r border-zinc-800 flex flex-col">
            <div class="h-16 flex items-center gap-2 px-5 border-b border-zinc-800">
                <div class="w-7 h-7 bg-amber-400 rounded flex items-center justify-center text-zinc-950 font-black text-sm">P</div>
                <span class="font-bold text-sm tracking-widest uppercase text-zinc-300">Portfolio</span>
            </div>

            <nav class="flex-1 py-5 px-3 space-y-0.5">
                <Link :href="route('dashboard')" :class="[
                    'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all',
                    route().current('dashboard') ? 'bg-amber-400/10 text-amber-400' : 'text-zinc-400 hover:text-white hover:bg-zinc-800'
                ]">
                    <span class="text-base">📊</span> Dashboard
                </Link>
                <Link :href="route('projects.index')" :class="[
                    'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all',
                    route().current('projects.*') ? 'bg-amber-400/10 text-amber-400' : 'text-zinc-400 hover:text-white hover:bg-zinc-800'
                ]">
                    <span class="text-base">🗂️</span> Projects
                </Link>
                <Link :href="route('achievements.index')" :class="[
                    'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all',
                    route().current('achievements.*') ? 'bg-amber-400/10 text-amber-400' : 'text-zinc-400 hover:text-white hover:bg-zinc-800'
                ]">
                    <span class="text-base">🏆</span> Achievements
                </Link>
                <Link :href="route('skills.index')" :class="[
                    'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all',
                    route().current('skills.*') ? 'bg-amber-400/10 text-amber-400' : 'text-zinc-400 hover:text-white hover:bg-zinc-800'
                ]">
                    <span class="text-base">⚡</span> Skills
                </Link>

                <div class="pt-4 mt-4 border-t border-zinc-800">
                    <Link :href="route('portfolio.public')"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-zinc-400 hover:text-white hover:bg-zinc-800 transition-all">
                        <span class="text-base">🌐</span> View Portfolio
                    </Link>
                </div>
            </nav>

            <div class="p-4 border-t border-zinc-800">
                <p class="text-xs font-semibold text-zinc-300 truncate">{{ page.props.auth?.user?.name }}</p>
                <p class="text-xs text-zinc-600 truncate mb-2">{{ page.props.auth?.user?.email }}</p>
                <Link :href="route('logout')" method="post" as="button"
                    class="text-xs text-zinc-500 hover:text-red-400 transition-colors">
                    → Sign out
                </Link>
            </div>
        </aside>

        <!-- Main -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Flash -->
            <div v-if="page.props.flash?.success"
                class="mx-6 mt-4 px-4 py-3 bg-emerald-900/30 border border-emerald-700/40 rounded-xl text-emerald-400 text-sm flex items-center gap-2">
                ✓ {{ page.props.flash.success }}
            </div>
            <div v-if="page.props.flash?.error"
                class="mx-6 mt-4 px-4 py-3 bg-red-900/30 border border-red-700/40 rounded-xl text-red-400 text-sm flex items-center gap-2">
                ✕ {{ page.props.flash.error }}
            </div>

            <main class="flex-1 p-8 overflow-auto">
                <slot />
            </main>
        </div>
    </div>
</template>
