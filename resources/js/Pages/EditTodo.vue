<script setup>

import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/inertia-vue3';

const todo = defineProps({
    todoList: Object
})
// console.log(todo.todoList);
const form = useForm({
    _method: 'PUT',
    nama: todo.todoList.nama,
    selesai: todo.todoList.selesai
})
</script>
<template>
    <AppLayout title="Edit Todo">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Todo
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <form @submit.prevent="form.post(route('todo.post.edit', todoList.id))">
                        <div class="mt-2">
                            <label for="nama">Nama Todo</label>
                            <input type="text" v-model="form.nama" class="w-full rounded shadow">
                        </div>
                        <div class="mt-2">
                            <label for="selesaai">Apakah sudah selesai?</label><br>
                            <input type="checkbox" v-model="form.selesai" :checked="form.selesai == true"> Sudah selesai
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="p-2 bg-green-500 rounded shadow hover:bg-green-700">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

