<script setup>
const props = defineProps([
    'judul'
]);
</script>
<template>
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">

            <div
                class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                <div class="flex items-center justify-between space-x-4">
                    <h1 class="text-xl font-medium text-gray-800 ">{{ props.judul ?? 'Belum ada judul' }}</h1>
                    <slot name="button" />
                    <!-- <button @click="$emit('set-add-modal')" class="text-gray-600 focus:outline-none hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button> -->
                </div>

                <p class="mt-2 text-sm text-gray-500 ">
                    {{ props.judul ?? 'belum ada judul' }}
                </p>

                <main >
                    <slot name="modal" />
                </main>
                <!-- <form class="mt-5"> -->
                <!-- <div>
                    <label for="user name" class="block text-sm text-gray-700 capitalize dark:text-gray-200">Teammate
                        name</label>
                    <input placeholder="Arthur Melo" type="text" 
                        class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                </div>

                <div class="mt-4">
                    <label for="email" class="block text-sm text-gray-700 capitalize dark:text-gray-200">Teammate
                        email</label>
                    <input placeholder="arthurmelo@example.app" type="email"
                        class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                </div>

                <div class="mt-4">
                    <h1 class="text-xs font-medium text-gray-400 uppercase">Permissions</h1>

                </div>

                <div class="flex justify-end mt-6">
                    <button type="button"
                        class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                        Invite Member
                    </button>
                </div> -->
                <!-- </form> -->
            </div>
        </div>
    </div>
</template>