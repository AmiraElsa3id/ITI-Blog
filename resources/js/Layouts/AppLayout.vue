<script setup>
import { Link } from '@inertiajs/vue3'
import { BookOpen, Menu, X } from 'lucide-vue-next'
import { ref } from 'vue'

const mobileOpen = ref(false)
</script>

<template>
    <div class="min-h-screen flex flex-col bg-gray-50">

        <!-- Nav -->
        <nav class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">

                    <!-- Logo -->
                    <div class="flex items-center gap-8">
                        <Link href="/" class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-gradient-to-br from-red-600 to-rose-600 rounded-lg flex items-center justify-center">
                                <BookOpen class="w-4 h-4 text-white" />
                            </div>
                            <span class="text-lg font-bold text-gray-900">ITI Blog</span>
                        </Link>

                        <!-- Desktop Links -->
                        <div class="hidden md:flex items-center gap-1">
                            <Link
                                href="/"
                                class="px-4 py-2 text-sm font-medium rounded-lg transition"
                                :class="$page.url === '/' ? 'bg-red-50 text-red-600' : 'text-gray-600 hover:bg-gray-100'"
                            >
                                Home
                            </Link>
                            <Link
                                href="/posts"
                                class="px-4 py-2 text-sm font-medium rounded-lg transition"
                                :class="$page.url.startsWith('/posts') ? 'bg-red-50 text-red-600' : 'text-gray-600 hover:bg-gray-100'"
                            >
                                Posts
                            </Link>
                            <Link
                                href="/about"
                                class="px-4 py-2 text-sm font-medium rounded-lg transition"
                                :class="$page.url === '/about' ? 'bg-red-50 text-red-600' : 'text-gray-600 hover:bg-gray-100'"
                            >
                                About
                            </Link>
                        </div>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="flex items-center md:hidden">
                        <button @click="mobileOpen = !mobileOpen" class="p-2 rounded-lg text-gray-500 hover:bg-gray-100">
                            <X v-if="mobileOpen" class="w-5 h-5" />
                            <Menu v-else class="w-5 h-5" />
                        </button>
                    </div>

                </div>
            </div>

            <!-- Mobile Menu -->
            <div v-if="mobileOpen" class="md:hidden border-t border-gray-100 px-4 py-3 space-y-1">
                <Link href="/" class="block px-4 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-100">Home</Link>
                <Link href="/posts" class="block px-4 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-100">Posts</Link>
                <Link href="/about" class="block px-4 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-100">About</Link>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-1">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <slot />
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 bg-gradient-to-br from-red-600 to-rose-600 rounded-md flex items-center justify-center">
                            <BookOpen class="w-3 h-3 text-white" />
                        </div>
                        <span class="text-sm font-semibold text-gray-700">ITI Blog</span>
                    </div>
                    <p class="text-sm text-gray-400">
                        © {{ new Date().getFullYear() }} ITI Blog. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>

    </div>
</template>