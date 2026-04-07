<script setup>
import { Head, Link } from '@inertiajs/vue3'
</script>

<template>
    <Head title="Portfolio" />

    <div class="min-h-screen bg-zinc-950 text-white" style="font-family: 'Georgia', serif;">

        <!-- Nav -->
        <nav class="fixed top-0 left-0 right-0 z-50 border-b border-zinc-800/60 bg-zinc-950/80 backdrop-blur-md">
            <div class="max-w-6xl mx-auto px-6 h-14 flex items-center justify-between">
                <span class="font-black tracking-widest uppercase text-amber-400 text-sm">Portfolio</span>
                <div class="flex items-center gap-6">
                    <Link :href="route('portfolio.public')"
                        class="text-zinc-400 hover:text-white text-sm transition-colors" style="font-family: system-ui;">
                        View Work
                    </Link>
                    <template v-if="$page.props.auth?.user">
                        <Link :href="route('dashboard')"
                            class="bg-amber-400 text-zinc-950 px-4 py-1.5 rounded text-sm font-bold transition-all hover:bg-amber-300"
                            style="font-family: system-ui;">
                            Dashboard
                        </Link>
                    </template>
                    <template v-else>
                        <Link :href="route('login')"
                            class="text-zinc-400 hover:text-white text-sm transition-colors" style="font-family: system-ui;">
                            Login
                        </Link>
                        <Link :href="route('register')"
                            class="bg-amber-400 text-zinc-950 px-4 py-1.5 rounded text-sm font-bold transition-all hover:bg-amber-300"
                            style="font-family: system-ui;">
                            Get Started
                        </Link>
                    </template>
                </div>
            </div>
        </nav>

        <!-- Hero -->
        <section class="pt-40 pb-32 max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <p class="text-amber-400 text-xs font-bold uppercase tracking-[0.3em] mb-6"
                        style="font-family: system-ui;">
                        Portfolio Management System
                    </p>
                    <h1 class="text-6xl lg:text-7xl font-black leading-none mb-8 text-white">
                        Your work,<br />
                        <span class="text-zinc-500">beautifully</span><br />
                        presented.
                    </h1>
                    <p class="text-zinc-400 text-lg leading-relaxed mb-10" style="font-family: system-ui;">
                        A polished management system to showcase your projects, certifications, and skills — with a public portfolio page and a clean admin panel.
                    </p>
                    <div class="flex gap-4">
                        <Link :href="route('portfolio.public')"
                            class="bg-amber-400 text-zinc-950 px-7 py-3 rounded font-bold text-sm hover:bg-amber-300 transition-all"
                            style="font-family: system-ui;">
                            View Portfolio
                        </Link>
                        <Link :href="route('register')"
                            class="border border-zinc-700 text-zinc-300 px-7 py-3 rounded font-medium text-sm hover:border-zinc-500 hover:text-white transition-all"
                            style="font-family: system-ui;">
                            Manage →
                        </Link>
                    </div>
                </div>

                <!-- Decorative panel -->
                <div class="hidden lg:block">
                    <div class="border border-zinc-800 rounded-2xl p-8 bg-zinc-900 space-y-4">
                        <div class="flex items-center gap-3 border-b border-zinc-800 pb-4">
                            <div class="w-8 h-8 bg-amber-400/10 rounded flex items-center justify-center text-amber-400 text-sm">🗂️</div>
                            <div>
                                <p class="text-white text-sm font-semibold">Projects</p>
                                <p class="text-zinc-500 text-xs" style="font-family: system-ui;">Showcase your best work</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 border-b border-zinc-800 pb-4">
                            <div class="w-8 h-8 bg-amber-400/10 rounded flex items-center justify-center text-amber-400 text-sm">🏆</div>
                            <div>
                                <p class="text-white text-sm font-semibold">Achievements</p>
                                <p class="text-zinc-500 text-xs" style="font-family: system-ui;">Certifications & awards</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-amber-400/10 rounded flex items-center justify-center text-amber-400 text-sm">⚡</div>
                            <div>
                                <p class="text-white text-sm font-semibold">Skills</p>
                                <p class="text-zinc-500 text-xs" style="font-family: system-ui;">Proficiency at a glance</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Divider -->
        <div class="border-t border-zinc-800 max-w-6xl mx-auto"></div>

        <!-- Footer -->
        <footer class="max-w-6xl mx-auto px-6 py-8 flex items-center justify-between">
            <span class="text-zinc-600 text-xs" style="font-family: system-ui;">Built with Laravel 12 + Vue 3 + Inertia</span>
            <Link :href="route('portfolio.public')" class="text-amber-400 text-xs hover:text-amber-300 transition-colors" style="font-family: system-ui;">
                Public Portfolio →
            </Link>
        </footer>
    </div>
</template>
