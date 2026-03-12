<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Code2, Database, Layers, Palette, Server, Zap, Github, Linkedin, Twitter } from 'lucide-vue-next'
</script>

<template>
    <AppLayout>

        <!-- Hero -->
        <div class="relative text-center py-24 space-y-6">
            <div class="absolute inset-0 -z-10 bg-gradient-to-br from-red-50 via-white to-rose-50 rounded-3xl" />

            <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-red-100 text-red-700 rounded-full text-sm font-medium">
                <Zap class="w-4 h-4" />
                About ITI Blog
            </div>

            <h1 class="text-6xl font-extrabold text-gray-900 leading-tight">
                Built with
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-rose-600">
                    Passion
                </span>
            </h1>

            <p class="text-xl text-gray-500 max-w-xl mx-auto leading-relaxed">
                A learning project that explores modern full-stack web development using the latest tools and technologies.
            </p>
        </div>

        <!-- Mission & Vision -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-12">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 space-y-4">
                <div class="w-12 h-12 bg-red-100 text-red-600 rounded-xl flex items-center justify-center">
                    <Zap class="w-6 h-6" />
                </div>
                <h2 class="text-xl font-bold text-gray-800">Our Mission</h2>
                <p class="text-gray-500 text-sm leading-relaxed">
                    ITI Blog was created as a learning project to explore modern web development
                    using Laravel, Inertia.js, and Vue 3. Our goal is to build clean, fast,
                    and maintainable web applications that serve as a reference for other developers.
                </p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 space-y-4">
                <div class="w-12 h-12 bg-rose-100 text-rose-600 rounded-xl flex items-center justify-center">
                    <Layers class="w-6 h-6" />
                </div>
                <h2 class="text-xl font-bold text-gray-800">Our Vision</h2>
                <p class="text-gray-500 text-sm leading-relaxed">
                    We believe in writing clean, readable, and well-structured code. Every feature
                    in this project is built with simplicity and scalability in mind, following
                    best practices and modern design patterns.
                </p>
            </div>
        </div>

        <!-- Tech Stack -->
        <div class="mt-8 bg-white rounded-2xl border border-gray-100 shadow-sm p-8 space-y-6">
            <h2 class="text-xl font-bold text-gray-800">Tech Stack</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <div class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 hover:border-red-200 hover:shadow-sm transition">
                    <div class="w-10 h-10 bg-red-100 text-red-600 rounded-lg flex items-center justify-center">
                        <Server class="w-5 h-5" />
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">Laravel 12</p>
                        <p class="text-gray-400 text-xs">Backend Framework</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 hover:border-red-200 hover:shadow-sm transition">
                    <div class="w-10 h-10 bg-rose-100 text-rose-600 rounded-lg flex items-center justify-center">
                        <Zap class="w-5 h-5" />
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">Inertia.js</p>
                        <p class="text-gray-400 text-xs">SPA Bridge</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 hover:border-red-200 hover:shadow-sm transition">
                    <div class="w-10 h-10 bg-pink-100 text-pink-600 rounded-lg flex items-center justify-center">
                        <Code2 class="w-5 h-5" />
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">Vue 3</p>
                        <p class="text-gray-400 text-xs">Frontend Framework</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 hover:border-red-200 hover:shadow-sm transition">
                    <div class="w-10 h-10 bg-red-100 text-red-600 rounded-lg flex items-center justify-center">
                        <Palette class="w-5 h-5" />
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">Tailwind CSS v4</p>
                        <p class="text-gray-400 text-xs">Styling</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 hover:border-red-200 hover:shadow-sm transition">
                    <div class="w-10 h-10 bg-rose-100 text-rose-600 rounded-lg flex items-center justify-center">
                        <Layers class="w-5 h-5" />
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">shadcn-vue</p>
                        <p class="text-gray-400 text-xs">UI Components</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 hover:border-red-200 hover:shadow-sm transition">
                    <div class="w-10 h-10 bg-pink-100 text-pink-600 rounded-lg flex items-center justify-center">
                        <Database class="w-5 h-5" />
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">MySQL</p>
                        <p class="text-gray-400 text-xs">Database</p>
                    </div>
                </div>

            </div>
        </div>

        <!-- CTA -->
        <div class="mt-8 bg-gradient-to-r from-red-600 to-rose-600 rounded-2xl p-10 text-center space-y-4">
            <h2 class="text-2xl font-bold text-white">Want to contribute?</h2>
            <p class="text-red-100 text-sm">Check out the project and feel free to reach out.</p>
            <div class="flex items-center justify-center gap-4">
                <a href="#" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-red-600 font-medium rounded-xl hover:bg-red-50 transition">
                    <Github class="w-4 h-4" />
                    GitHub
                </a>
                <a href="https://www.linkedin.com/in/amera-mohammed/" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-red-600 font-medium rounded-xl hover:bg-red-50 transition">
                    <Linkedin class="w-4 h-4" />
                    LinkedIn
                </a>
            </div>
        </div>

    </AppLayout>
</template>