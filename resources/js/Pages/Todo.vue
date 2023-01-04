<script setup>
import AppLayoutVue from '../Layouts/AppLayout.vue';
import { useForm, Link } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const props = defineProps({
    todos: Array
});

let editMode = ref(false);
let editNama = ref(null);

const form = useForm({
    nama: null,
    selesai: false
});

const deleteForm = useForm({
    _method: 'DELETE'
});

const deleteTodo = (id) => {
    deleteForm.post(route('todo.delete', id), {
        onSuccess: () => {alert('data dihapus')}
    });
}

const postSubmit = () => {
    form.post('/todo', {
        onSuccess: () => { 
            form.reset(); 
            alert('berhasil tambah');
        }
    })
}

const setEditMode = (nama) => {
    if (editMode.value == false){
        editMode.value = true;
        editNama.value = nama;
    }else{
        editMode.value = false;
    };
    console.log(editNama + ' - ' + editNama.value);
}

</script>
<template>
    <AppLayoutVue title="Todo">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Todo
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <form @submit.prevent="postSubmit">
                        <div class="mt-2">
                            <label for="nama">Nama Todo</label>
                            <input type="text" v-model="form.nama" class="w-full rounded shadow">
                        </div>
                        <div class="mt-2">
                            <label for="selesaai">Apakah sudah selesai?</label><br>
                            <input type="checkbox" v-model="form.selesai"> Sudah selesai
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="p-2 bg-green-500 rounded shadow hover:bg-green-700">
                                Save
                            </button>
                        </div>
                    </form>
                    <div class="mt-4">
                        <table class="table-auto w-full text-left">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th colspan="2">Selesai</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="todo in todos" :key="todo.id">
                                    <td class="mr-6">{{ todo.id }}</td>
                                    <td>{{ todo.nama }}</td>
                                    <td><span :class="{'text-green-600': todo.selesai}"> {{ todo.selesai ? 'v' : 'x' }}</span></td>
                                    <td>
                                        <div>
                                            <!-- <Link :href="route('todo.edit', todo.id)">Edit</Link> -->
                                            <button @click="setEditMode(todo.nama)">edit</button>
                                            <button @click="deleteTodo(todo.id)">hapus</button>

                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <Transition>
                        <div class="fixed inset-0 z-50 overflow-y-auto" v-show="editMode">
                            <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">

                                <div
                                    class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl"
                                >
                                    <div class="flex items-center justify-between space-x-4">
                                        <h1 class="text-xl font-medium text-gray-800 ">Invite team memebr</h1>

                                        <button @click="editMode = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </button>
                                    </div>

                                    <p class="mt-2 text-sm text-gray-500 ">
                                        Add your teammate to your team and start work to get things done
                                    </p>

                                    <!-- <form class="mt-5"> -->
                                        <div>
                                            <label for="user name" class="block text-sm text-gray-700 capitalize dark:text-gray-200">Teammate name</label>
                                            <input placeholder="Arthur Melo" type="text" :value="editNama" class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                                        </div>

                                        <div class="mt-4">
                                            <label for="email" class="block text-sm text-gray-700 capitalize dark:text-gray-200">Teammate email</label>
                                            <input placeholder="arthurmelo@example.app" type="email" class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                                        </div>
                                        
                                        <div class="mt-4">
                                            <h1 class="text-xs font-medium text-gray-400 uppercase">Permissions</h1>

                                        </div>
                                        
                                        <div class="flex justify-end mt-6">
                                            <button type="button" class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                                                Invite Member
                                            </button>
                                        </div>
                                    <!-- </form> -->
                                </div>
                            </div>
                        </div>
                    </Transition>

                </div>
            </div>
        </div>
    </AppLayoutVue>
</template>

