<script setup>
import { ref, watch } from 'vue'
import { useForm, router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Textarea } from '@/components/ui/textarea'
import {
    Dialog,
    DialogContent,
    DialogHeader,
    DialogTitle,
    DialogFooter,
} from '@/components/ui/dialog'
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
} from '@/components/ui/alert-dialog'
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select'
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table'
import { PenLine, Trash2, Eye, Plus, MessageCircle, Calendar, ImageIcon } from 'lucide-vue-next'

const props = defineProps({
    posts: Object,
    users: Array,
})

// ─── Delete Warning Modal ──────────────────────────────────────────────────────
const showDeleteDialog = ref(false)
const deletingPostId   = ref(null)

function confirmDelete(id) {
    deletingPostId.value   = id
    showDeleteDialog.value = true
}

function executeDelete() {
    router.delete(route('posts.destroy', deletingPostId.value))
    showDeleteDialog.value = false
}

// ─── Delete Comment Warning Modal ─────────────────────────────────────────────
const showDeleteCommentDialog = ref(false)
const deletingCommentId       = ref(null)

function confirmDeleteComment(id) {
    deletingCommentId.value       = id
    showDeleteCommentDialog.value = true
}

function executeDeleteComment() {
    router.delete(route('comments.destroy', deletingCommentId.value))
    showDeleteCommentDialog.value = false
}

// ─── View ─────────────────────────────────────────────────────────────────────
const showViewDialog = ref(false)
const viewingPost    = ref(null)

function openView(post) {
    viewingPost.value    = post
    showViewDialog.value = true
}

watch(
    () => props.posts.data,
    (newPosts) => {
        if (viewingPost.value && showViewDialog.value) {
            const updated = newPosts.find(p => p.id === viewingPost.value.id)
            if (updated) viewingPost.value = updated
        }
    }
)

const commentForm = useForm({
    user_id: '',
    body: '',
})

function submitComment() {
    commentForm.post(route('comments.store', viewingPost.value.id), {
        onSuccess: () => commentForm.reset(),
    })
}

// ─── Create ───────────────────────────────────────────────────────────────────
const showCreateDialog = ref(false)

const createForm = useForm({
    title: '',
    description: '',
    user_id: '',
    image: null,
})

function submitCreate() {
    createForm.post(route('posts.store'), {
        forceFormData: true,
        onSuccess: () => {
            showCreateDialog.value = false
            createForm.reset()
        },
    })
}

// ─── Edit ─────────────────────────────────────────────────────────────────────
const showEditDialog = ref(false)
const editingPost    = ref(null)

const editForm = useForm({
    title: '',
    description: '',
    user_id: '',
    image: null,
})

function openEdit(post) {
    editingPost.value    = post
    editForm.title       = post.title
    editForm.description = post.description
    editForm.user_id     = String(post.user_id)
    editForm.image       = null
    showEditDialog.value = true
}

function submitEdit() {
    editForm
        .transform(data => ({
            ...data,
            _method: 'PUT',
        }))
        .post(route('posts.update', editingPost.value.id), {
            forceFormData: true,
            onSuccess: () => {
                showEditDialog.value = false
            },
        })
}

// ─── Pagination ───────────────────────────────────────────────────────────────
function goToPage(url) {
    if (url) router.visit(url)
}
</script>

<template>
    <AppLayout>
        <div class="space-y-6">

            <!-- Header -->
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">All Posts</h1>
                    <p class="text-sm text-gray-500 mt-1">{{ posts.total }} posts total</p>
                </div>
                <Button
                    class="bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white gap-2"
                    @click="showCreateDialog = true"
                >
                    <Plus class="w-4 h-4" />
                    Create Post
                </Button>
            </div>

            <!-- Success Message -->
            <div v-if="$page.props.flash?.success" class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
                {{ $page.props.flash.success }}
            </div>

            <!-- Table -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <Table>
                    <TableHeader>
                        <TableRow class="bg-gray-50">
                            <TableHead class="font-semibold text-gray-700">#</TableHead>
                            <TableHead class="font-semibold text-gray-700">Image</TableHead>
                            <TableHead class="font-semibold text-gray-700">Title</TableHead>
                            <TableHead class="font-semibold text-gray-700">Slug</TableHead>
                            <TableHead class="font-semibold text-gray-700">Posted By</TableHead>
                            <TableHead class="font-semibold text-gray-700">Created At</TableHead>
                            <TableHead class="font-semibold text-gray-700">Actions</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="post in posts.data" :key="post.id" class="hover:bg-gray-50 transition">
                            <TableCell class="text-gray-400 text-sm">{{ post.id }}</TableCell>
                            <TableCell>
                                <img
                                    v-if="post.image"
                                    :src="`/storage/${post.image}`"
                                    class="w-10 h-10 rounded-lg object-cover"
                                    alt="Post image"
                                />
                                <div v-else class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                    <ImageIcon class="w-4 h-4 text-gray-400" />
                                </div>
                            </TableCell>
                            <TableCell class="font-medium text-gray-800">{{ post.title }}</TableCell>
                            <TableCell>
                                <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-lg font-mono">
                                    {{ post.slug }}
                                </span>
                            </TableCell>
                            <TableCell>
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 bg-gradient-to-br from-red-400 to-rose-400 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                        {{ post.user.name.charAt(0).toUpperCase() }}
                                    </div>
                                    <span class="text-sm text-gray-600">{{ post.user.name }}</span>
                                </div>
                            </TableCell>
                            <TableCell>
                                <div class="flex items-center gap-1 text-sm text-gray-500">
                                    <Calendar class="w-3 h-3" />
                                    {{ new Date(post.created_at).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }) }}
                                </div>
                            </TableCell>
                            <TableCell>
                                <div class="flex items-center gap-2">
                                    <button @click="openView(post)" class="p-1.5 rounded-lg text-blue-500 hover:bg-blue-50 transition" title="View">
                                        <Eye class="w-4 h-4" />
                                    </button>
                                    <button @click="openEdit(post)" class="p-1.5 rounded-lg text-amber-500 hover:bg-amber-50 transition" title="Edit">
                                        <PenLine class="w-4 h-4" />
                                    </button>
                                    <button @click="confirmDelete(post.id)" class="p-1.5 rounded-lg text-red-500 hover:bg-red-50 transition" title="Delete">
                                        <Trash2 class="w-4 h-4" />
                                    </button>
                                </div>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>

                <!-- Pagination -->
                <div class="flex justify-end gap-1 px-4 py-3 border-t border-gray-100">
                    <Button
                        v-for="link in posts.links"
                        :key="link.label"
                        variant="outline"
                        size="sm"
                        :disabled="!link.url"
                        :class="link.active ? 'bg-gradient-to-r from-red-600 to-rose-600 text-white border-red-600' : ''"
                        @click="goToPage(link.url)"
                        v-html="link.label"
                    />
                </div>
            </div>

            <!-- View Dialog -->
            <Dialog :open="showViewDialog" @update:open="showViewDialog = $event">
                <DialogContent class="max-w-2xl max-h-[80vh] overflow-y-auto">
                    <DialogHeader>
                        <DialogTitle class="text-lg font-bold text-gray-900">View Post</DialogTitle>
                    </DialogHeader>
                    <div v-if="viewingPost" class="space-y-4">

                        <!-- Post Image -->
                        <img
                            v-if="viewingPost.image"
                            :src="`/storage/${viewingPost.image}`"
                            class="w-full rounded-xl object-cover max-h-48"
                            alt="Post image"
                        />

                        <!-- Post Info -->
                        <div class="bg-gray-50 rounded-xl p-4 space-y-3">
                            <h3 class="font-semibold text-gray-900 text-lg">{{ viewingPost.title }}</h3>
                            <span class="text-xs bg-gray-200 text-gray-600 px-2 py-1 rounded-lg font-mono">{{ viewingPost.slug }}</span>
                            <p class="text-gray-600 text-sm leading-relaxed">{{ viewingPost.description }}</p>
                        </div>

                        <!-- Creator -->
                        <div class="flex items-center gap-3 p-4 bg-red-50 rounded-xl border border-red-100">
                            <div class="w-10 h-10 bg-gradient-to-br from-red-400 to-rose-400 rounded-full flex items-center justify-center text-white font-bold">
                                {{ viewingPost.user.name.charAt(0).toUpperCase() }}
                            </div>
                            <div>
                                <p class="font-medium text-gray-800 text-sm">{{ viewingPost.user.name }}</p>
                                <p class="text-gray-500 text-xs">{{ viewingPost.user.email }}</p>
                            </div>
                        </div>

                        <!-- Comments -->
                        <div class="space-y-3">
                            <div class="flex items-center gap-2">
                                <MessageCircle class="w-4 h-4 text-red-500" />
                                <h4 class="font-semibold text-gray-800">Comments ({{ viewingPost.comments.length }})</h4>
                            </div>

                            <!-- Add Comment -->
                            <div class="bg-gray-50 rounded-xl p-4 space-y-3">
                                <Select v-model="commentForm.user_id">
                                    <SelectTrigger>
                                        <SelectValue placeholder="Comment as..." />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectItem v-for="user in users" :key="user.id" :value="String(user.id)">
                                            {{ user.name }}
                                        </SelectItem>
                                    </SelectContent>
                                </Select>
                                <p v-if="commentForm.errors.user_id" class="text-red-500 text-xs">{{ commentForm.errors.user_id }}</p>
                                <Textarea v-model="commentForm.body" placeholder="Write a comment..." class="resize-none" />
                                <p v-if="commentForm.errors.body" class="text-red-500 text-xs">{{ commentForm.errors.body }}</p>
                                <Button
                                    size="sm"
                                    class="bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white"
                                    @click="submitComment"
                                >
                                    Add Comment
                                </Button>
                            </div>

                            <!-- Comments List -->
                            <div v-if="viewingPost.comments.length > 0" class="space-y-2">
                                <div v-for="comment in viewingPost.comments" :key="comment.id" class="bg-white border border-gray-100 rounded-xl p-4 space-y-2">
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 bg-gradient-to-br from-red-400 to-rose-400 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                                {{ comment.user.name.charAt(0).toUpperCase() }}
                                            </div>
                                            <span class="text-sm font-medium text-gray-800">{{ comment.user.name }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs text-gray-400">{{ new Date(comment.created_at).toLocaleDateString('en-GB') }}</span>
                                            <button @click="confirmDeleteComment(comment.id)" class="p-1 rounded text-red-400 hover:bg-red-50 transition">
                                                <Trash2 class="w-3 h-3" />
                                            </button>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-600 leading-relaxed">{{ comment.body }}</p>
                                </div>
                            </div>
                            <p v-else class="text-sm text-gray-400 text-center py-4">No comments yet. Be the first to comment!</p>
                        </div>
                    </div>
                    <DialogFooter>
                        <Button variant="outline" @click="showViewDialog = false">Close</Button>
                    </DialogFooter>
                </DialogContent>
            </Dialog>

            <!-- Create Dialog -->
            <Dialog :open="showCreateDialog" @update:open="showCreateDialog = $event">
                <DialogContent>
                    <DialogHeader>
                        <DialogTitle class="flex items-center gap-2">
                            <Plus class="w-5 h-5 text-red-500" />
                            Create Post
                        </DialogTitle>
                    </DialogHeader>
                    <div class="space-y-4">
                        <div class="space-y-1">
                            <Label>Title</Label>
                            <Input
                                v-model="createForm.title"
                                placeholder="Post title"
                                :class="createForm.errors.title ? 'border-red-500' : ''"
                            />
                            <p v-if="createForm.errors.title" class="text-red-500 text-xs">{{ createForm.errors.title }}</p>
                        </div>
                        <div class="space-y-1">
                            <Label>Description</Label>
                            <Textarea
                                v-model="createForm.description"
                                placeholder="Post description"
                                class="resize-none"
                                rows="4"
                                :class="createForm.errors.description ? 'border-red-500' : ''"
                            />
                            <p v-if="createForm.errors.description" class="text-red-500 text-xs">{{ createForm.errors.description }}</p>
                        </div>
                        <div class="space-y-1">
                            <Label>Creator</Label>
                            <Select v-model="createForm.user_id">
                                <SelectTrigger :class="createForm.errors.user_id ? 'border-red-500' : ''">
                                    <SelectValue placeholder="Select a user" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem v-for="user in users" :key="user.id" :value="String(user.id)">
                                        {{ user.name }}
                                    </SelectItem>
                                </SelectContent>
                            </Select>
                            <p v-if="createForm.errors.user_id" class="text-red-500 text-xs">{{ createForm.errors.user_id }}</p>
                        </div>
                        <div class="space-y-1">
                            <Label>Image <span class="text-gray-400 text-xs">(jpg, png only)</span></Label>
                            <Input
                                type="file"
                                accept=".jpg,.png"
                                :class="createForm.errors.image ? 'border-red-500' : ''"
                                @change="e => createForm.image = e.target.files[0]"
                            />
                            <p v-if="createForm.errors.image" class="text-red-500 text-xs">{{ createForm.errors.image }}</p>
                        </div>
                    </div>
                    <DialogFooter>
                        <Button variant="outline" @click="showCreateDialog = false">Cancel</Button>
                        <Button
                            class="bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white"
                            @click="submitCreate"
                        >
                            Create
                        </Button>
                    </DialogFooter>
                </DialogContent>
            </Dialog>

            <!-- Edit Dialog -->
            <Dialog :open="showEditDialog" @update:open="showEditDialog = $event">
                <DialogContent>
                    <DialogHeader>
                        <DialogTitle class="flex items-center gap-2">
                            <PenLine class="w-5 h-5 text-amber-500" />
                            Edit Post
                        </DialogTitle>
                    </DialogHeader>
                    <div class="space-y-4">
                        <div class="space-y-1">
                            <Label>Title</Label>
                            <Input
                                v-model="editForm.title"
                                :class="editForm.errors.title ? 'border-red-500' : ''"
                            />
                            <p v-if="editForm.errors.title" class="text-red-500 text-xs">{{ editForm.errors.title }}</p>
                        </div>
                        <div class="space-y-1">
                            <Label>Description</Label>
                            <Textarea
                                v-model="editForm.description"
                                class="resize-none"
                                rows="4"
                                :class="editForm.errors.description ? 'border-red-500' : ''"
                            />
                            <p v-if="editForm.errors.description" class="text-red-500 text-xs">{{ editForm.errors.description }}</p>
                        </div>
                        <div class="space-y-1">
                            <Label>Creator</Label>
                            <Select v-model="editForm.user_id">
                                <SelectTrigger :class="editForm.errors.user_id ? 'border-red-500' : ''">
                                    <SelectValue placeholder="Select a user" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem v-for="user in users" :key="user.id" :value="String(user.id)">
                                        {{ user.name }}
                                    </SelectItem>
                                </SelectContent>
                            </Select>
                            <p v-if="editForm.errors.user_id" class="text-red-500 text-xs">{{ editForm.errors.user_id }}</p>
                        </div>
                        <div class="space-y-1">
                            <Label>Image <span class="text-gray-400 text-xs">(leave empty to keep current)</span></Label>
                            <!-- show current image -->
                            <div v-if="editingPost?.image" class="flex items-center gap-3 p-2 bg-gray-50 rounded-lg">
                                <img
                                    :src="`/storage/${editingPost.image}`"
                                    class="w-12 h-12 rounded-lg object-cover"
                                    alt="Current image"
                                />
                                <span class="text-xs text-gray-500">Current image</span>
                            </div>
                            <Input
                                type="file"
                                accept=".jpg,.png"
                                :class="editForm.errors.image ? 'border-red-500' : ''"
                                @change="e => editForm.image = e.target.files[0]"
                            />
                            <p v-if="editForm.errors.image" class="text-red-500 text-xs">{{ editForm.errors.image }}</p>
                        </div>
                    </div>
                    <DialogFooter>
                        <Button variant="outline" @click="showEditDialog = false">Cancel</Button>
                        <Button
                            class="bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white"
                            @click="submitEdit"
                        >
                            Update
                        </Button>
                    </DialogFooter>
                </DialogContent>
            </Dialog>

            <!-- Delete Post Warning Modal — LAST -->
            <AlertDialog :open="showDeleteDialog" @update:open="showDeleteDialog = $event">
                <AlertDialogContent class="z-[100]">
                    <AlertDialogHeader>
                        <AlertDialogTitle class="flex items-center gap-2 text-red-600">
                            <Trash2 class="w-5 h-5" />
                            Delete Post
                        </AlertDialogTitle>
                        <AlertDialogDescription>
                            Are you sure you want to delete this post? This action cannot be undone and will also remove all comments.
                        </AlertDialogDescription>
                    </AlertDialogHeader>
                    <AlertDialogFooter>
                        <AlertDialogCancel>Cancel</AlertDialogCancel>
                        <AlertDialogAction
                            class="bg-red-600 hover:bg-red-700 text-white"
                            @click="executeDelete"
                        >
                            Yes, Delete
                        </AlertDialogAction>
                    </AlertDialogFooter>
                </AlertDialogContent>
            </AlertDialog>

            <!-- Delete Comment Warning Modal — LAST -->
            <AlertDialog :open="showDeleteCommentDialog" @update:open="showDeleteCommentDialog = $event">
                <AlertDialogContent class="z-[100]">
                    <AlertDialogHeader>
                        <AlertDialogTitle class="flex items-center gap-2 text-red-600">
                            <Trash2 class="w-5 h-5" />
                            Delete Comment
                        </AlertDialogTitle>
                        <AlertDialogDescription>
                            Are you sure you want to delete this comment? This action cannot be undone.
                        </AlertDialogDescription>
                    </AlertDialogHeader>
                    <AlertDialogFooter>
                        <AlertDialogCancel>Cancel</AlertDialogCancel>
                        <AlertDialogAction
                            class="bg-red-600 hover:bg-red-700 text-white"
                            @click="executeDeleteComment"
                        >
                            Yes, Delete
                        </AlertDialogAction>
                    </AlertDialogFooter>
                </AlertDialogContent>
            </AlertDialog>

        </div>
    </AppLayout>
</template>