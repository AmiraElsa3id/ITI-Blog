<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3'
import { PenLine, MessageCircle, Users, ArrowRight, BookOpen, TrendingUp } from 'lucide-vue-next'
</script>

<template>
    <AppLayout>

        <!-- Hero -->
        <div class="relative text-center py-24 space-y-6">
<div class="absolute inset-0 -z-10 bg-gradient-to-br from-red-50 via-white to-rose-50 rounded-3xl" />

            
<div class="inline-flex items-center gap-2 px-4 py-1.5 bg-red-100 text-red-700 rounded-full text-sm font-medium">
                <TrendingUp class="w-4 h-4" />
                Built with Laravel + Inertia + Vue
            </div>

            <h1 class="text-6xl font-extrabold text-gray-900 leading-tight">
                Welcome to <br />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-rose-600">

                    ITI Blog
                </span>
            </h1>

            <p class="text-xl text-gray-500 max-w-xl mx-auto leading-relaxed">
                A place to share your thoughts, ideas, and stories with the world.
            </p>

            <div class="flex items-center justify-center gap-4">
                <Link
                    href="/posts"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-red-600 text-white font-medium rounded-xl hover:bg-red-700 transition"
                >
                    Browse Posts
                    <ArrowRight class="w-4 h-4" />
                </Link>
                <Link
                    href="/about"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-white text-gray-700 font-medium rounded-xl border border-gray-200 hover:bg-gray-50 transition"
                >
                    Learn More
                </Link>
            </div>
        </div>

        <!-- Stats -->
        <!-- <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 text-center space-y-1">
                <p class="text-4xl font-bold text-red-600">500+</p>
                <p class="text-gray-500 text-sm">Posts Published</p>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 text-center space-y-1">
                <p class="text-4xl font-bold text-rose-600">10+</p>
                <p class="text-gray-500 text-sm">Active Writers</p>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 text-center space-y-1">
                <p class="text-4xl font-bold text-pink-600">∞</p>
                <p class="text-gray-500 text-sm">Ideas to Share</p>
            </div>
        </div> -->

        <!-- Features -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4 hover:shadow-md hover:border-red-200 transition">
                <div class="w-12 h-12 bg-red-100 text-red-600 rounded-xl flex items-center justify-center group-hover:bg-red-600 group-hover:text-white transition">
                    <PenLine class="w-6 h-6" />
                </div>
                <h3 class="text-lg font-semibold text-gray-800">Write Posts</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Create and share your thoughts with everyone around the world.</p>
            </div>

            <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4 hover:shadow-md hover:border-rose-200 transition">
                <div class="w-12 h-12 bg-rose-100 text-rose-600 rounded-xl flex items-center justify-center group-hover:bg-rose-600 group-hover:text-white transition">
                    <MessageCircle class="w-6 h-6" />
                </div>
                <h3 class="text-lg font-semibold text-gray-800">Comment</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Engage with posts by leaving meaningful comments and feedback.</p>
            </div>

            <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4 hover:shadow-md hover:border-pink-200 transition">
                <div class="w-12 h-12 bg-pink-100 text-pink-600 rounded-xl flex items-center justify-center group-hover:bg-pink-600 group-hover:text-white transition">
                    <Users class="w-6 h-6" />
                </div>
                <h3 class="text-lg font-semibold text-gray-800">Community</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Join a growing community of writers, readers, and thinkers.</p>
            </div>
        </div>

        <!-- CTA -->
        <div class="mt-8 bg-gradient-to-r from-red-600 to-rose-600 rounded-2xl p-10 text-center space-y-4">
          
            <h2 class="text-2xl font-bold text-white">Ready to start reading?</h2>
            <p class="text-red-100 text-sm">Browse hundreds of posts written by our community.</p>
            <Link
                href="/posts"
                class="inline-flex items-center gap-2 px-6 py-3 bg-white text-red-600 font-medium rounded-xl hover:bg-red-50 transition"
            >
                View All Posts
                <ArrowRight class="w-4 h-4" />
            </Link>
        </div>

    </AppLayout>
</template>