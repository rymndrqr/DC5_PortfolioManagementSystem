<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const form = useForm({
    title: '', description: '', issuer: '', type: 'certification',
    date_received: '', credential_url: '', image: null, featured: false,
})

const submit = () => form.post(route('achievements.store'), { forceFormData: true })
</script>

<template>
    <AuthenticatedLayout>
        <Head title="New Achievement" />
        <div class="max-w-lg">
            <div class="flex items-center gap-3 mb-6" style="font-family: system-ui;">
                <Link :href="route('achievements.index')" class="text-zinc-500 hover:text-white">← Achievements</Link>
                <span class="text-zinc-700">/</span>
                <h1 class="text-2xl font-black" style="font-family: Georgia, serif;">New Achievement</h1>
            </div>
            <form @submit.prevent="submit" class="space-y-5" style="font-family: system-ui;">
                <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-zinc-400 mb-1 uppercase tracking-wider">Title *</label>
                        <input v-model="form.title" type="text" placeholder="AWS Certified Developer"
                            class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-2.5 text-white text-sm placeholder-zinc-600 focus:outline-none focus:border-amber-400" />
                        <p v-if="form.errors.title" class="text-red-400 text-xs mt-1">{{ form.errors.title }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-zinc-400 mb-1 uppercase tracking-wider">Issuer *</label>
                        <input v-model="form.issuer" type="text" placeholder="Amazon Web Services"
                            class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-2.5 text-white text-sm placeholder-zinc-600 focus:outline-none focus:border-amber-400" />
                        <p v-if="form.errors.issuer" class="text-red-400 text-xs mt-1">{{ form.errors.issuer }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-zinc-400 mb-1 uppercase tracking-wider">Type *</label>
                            <select v-model="form.type"
                                class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-2.5 text-white text-sm focus:outline-none focus:border-amber-400">
                                <option value="certification">Certification</option>
                                <option value="award">Award</option>
                                <option value="recognition">Recognition</option>
                                <option value="publication">Publication</option>
                                <option value="education">Education</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-zinc-400 mb-1 uppercase tracking-wider">Date Received *</label>
                            <input v-model="form.date_received" type="date"
                                class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-2.5 text-white text-sm focus:outline-none focus:border-amber-400" />
                            <p v-if="form.errors.date_received" class="text-red-400 text-xs mt-1">{{ form.errors.date_received }}</p>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-zinc-400 mb-1 uppercase tracking-wider">Description *</label>
                        <textarea v-model="form.description" rows="3"
                            class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-2.5 text-white text-sm placeholder-zinc-600 focus:outline-none focus:border-amber-400 resize-none"></textarea>
                        <p v-if="form.errors.description" class="text-red-400 text-xs mt-1">{{ form.errors.description }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-zinc-400 mb-1 uppercase tracking-wider">Credential URL</label>
                        <input v-model="form.credential_url" type="url" placeholder="https://..."
                            class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-2.5 text-white text-sm placeholder-zinc-600 focus:outline-none focus:border-amber-400" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-zinc-400 mb-1 uppercase tracking-wider">Badge Image</label>
                        <input type="file" accept="image/*" @change="form.image = $event.target.files[0]"
                            class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-2.5 text-zinc-400 text-sm focus:outline-none file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:bg-zinc-700 file:text-zinc-300 file:text-xs" />
                    </div>
                    <div class="flex items-center gap-3">
                        <input v-model="form.featured" type="checkbox" id="featured" class="w-4 h-4 accent-amber-400" />
                        <label for="featured" class="text-sm text-zinc-400">Feature this achievement</label>
                    </div>
                </div>
                <div class="flex gap-3 justify-end">
                    <Link :href="route('achievements.index')"
                        class="px-5 py-2.5 bg-zinc-800 hover:bg-zinc-700 text-white rounded-xl text-sm font-medium transition-colors">Cancel</Link>
                    <button type="submit" :disabled="form.processing"
                        class="px-5 py-2.5 bg-amber-400 hover:bg-amber-300 disabled:opacity-50 text-zinc-950 rounded-xl text-sm font-bold transition-colors">
                        {{ form.processing ? 'Saving…' : 'Add Achievement' }}
                    </button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
