<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DrugTableVue from './Components/DrugTable.vue';
import ModalVue from './Components/Modal.vue';
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3'

const props = defineProps({
    drugs: Array
});

const form = useForm({
    kode_batch: null,
    nama: null,
    jenis: null,
    harga_beli: null,
    harga_jual: null,
    stok: 0,
    satuan: null
});

const formIncoming = useForm({
    kode_obat: null,
    kode_batch: null,
    supplier: null,
    jumlah: null,
    tgl_kadaluarsa: null
});

let isAddEnable = ref(false);
let isIncomingEnable = ref(false);
// let isOutgoingEnable = ref(false);

const setAdd = () => {
    if (isAddEnable.value == false) {
        isAddEnable.value = true;
    }else{
        isAddEnable.value = false;
        form.reset();
    }
}

const setIncoming = () => {
    if (isIncomingEnable.value == false) {
        isIncomingEnable.value = true;
    }else{
        isIncomingEnable.value = false;
        formIncoming.reset();
    }
}


const submitObat = () => {
    form.post(route('drugs.post'), {
        onSuccess: () => setAdd(),
    })
}

const submitIncoming = () => {
    formIncoming.post(route('drugs.postIncoming'), {
        onSuccess: () => setIncoming(),
    })
}
// console.log(props.drugs)
</script>

<template>
    <AppLayout title="Obat Lah">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                List Obat Gudang 
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex flex-row">
                        <div class="p-3">
                            <button @click="isAddEnable = !isAddEnable" class="p-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700">Tambah Obat</button>
                        </div>
                        <div class="p-3 ml-4">
                            <button @click="isIncomingEnable = !isIncomingEnable" class="p-2 bg-green-600 text-white rounded shadow hover:bg-green-700">Penerimaan Obat</button>
                        </div>
                        <div class="p-3 ml-4">
                            <button @click="alert('masih dikembangkan')" class="p-2 bg-red-600 text-white rounded shadow hover:bg-red-700">Obat Keluar</button>
                        </div>
                    </div>
                    <!-- Table obat -->
                    <DrugTableVue :drugs="drugs" />

                    <!-- Modal tambah obat -->
                    <ModalVue v-show="isAddEnable" judul="Tambah Obat Baru">
                        <template #button>
                            <button @click="setAdd" class="text-gray-600 focus:outline-none hover:text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </template>
                        <template #modal>
                            <form @submit.prevent="submitObat">
                                <div class="mt-2">
                                    <label for="Nama Obat" class="block text-sm text-gray-700 capitalize dark:text-gray-200">
                                        Nama Obat
                                    </label>
                                    <input type="text" v-model="form.nama"
                                        class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                                    <span class="text-sm text-red-500" v-if="form.errors.nama">{{ form.errors.nama }}</span>
                                </div>
                                <div class="mt-4">
                                    <label for="Nama Obat" class="block text-sm text-gray-700 capitalize dark:text-gray-200">
                                        Jenis Obat
                                    </label>
                                    <select v-model="form.jenis" id="jenisobat" class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                                        <option value="1">Obat Bebas</option>
                                        <option value="2">Obat Bebas Terbatas</option>
                                        <option value="3">Obat Keras</option>
                                        <option value="4">Obat Tradisional</option>
                                    </select>
                                    <span class="text-sm text-red-500" v-if="form.errors.jenis">{{ form.errors.jenis }}</span>
                                </div>
                                <div class="mt-4">
                                    <label for="tipe" class="block text-sm text-gray-700 capitalize dark:text-gray-200">
                                        Satuan Obat
                                    </label>
                                    <select v-model="form.satuan" id="satuan" class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                                        <option value="tablet">Tablet</option>
                                        <option value="botol">Botol</option>
                                        <option value="ampul">Ampul</option>
                                    </select>
                                    <span class="text-sm text-red-500" v-if="form.errors.satuan">{{ form.errors.satuan }}</span>
                                </div>
                                <div class="mt-4">
                                    <label for="beli" class="block text-sm text-gray-700 capitalize dark:text-gray-200">
                                        Harga Beli
                                    </label>
                                    <input type="number" v-model="form.harga_beli"
                                        class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                                    <span class="text-sm text-red-500" v-if="form.errors.harga_beli">{{ form.errors.harga_beli }}</span>
                                </div>
                                <div class="mt-4">
                                    <label for="jual" class="block text-sm text-gray-700 capitalize dark:text-gray-200">
                                        Harga Jual
                                    </label>
                                    <input type="number" v-model="form.harga_jual"
                                        class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                                    <span class="text-sm text-red-500" v-if="form.errors.harga_jual">{{ form.errors.harga_jual }}</span>
                                </div>
                                <div class="flex justify-end mt-6">
                                    <button type="submit" :disabled="form.processing"
                                        class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50 disabled:bg-indigo-300">
                                        <span v-if="form.processing">Menyimpan</span>
                                        <span v-else>Simpan</span>
                                    </button>
                                </div>
                            </form>
                        </template>
                    </ModalVue>

                    <!-- Modal incoming -->
                    <ModalVue v-show="isIncomingEnable" judul="Update Penerimaan Obat">
                        <template #button>
                            <button @click="setIncoming" class="text-gray-600 focus:outline-none hover:text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </template>
                        <template #modal>
                            <form @submit.prevent="submitIncoming">
                                <div class="mt-2">
                                    <label for="obat" class="block text-lg text-gray-700 capitalize dark:text-gray-200">Obat</label>
                                    <select v-model="formIncoming.kode_obat" class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                                        <option :value="obat.id" v-for="obat in drugs" :key="obat.id">{{ obat.nama }}</option>
                                    </select>
                                    <span class="text-sm text-red-500" v-if="formIncoming.errors.kode_obat">{{ formIncoming.errors.kode_obat }}</span>
                                </div>
                                <div class="mt-4">
                                    <label for="batch" class="block text-lg text-gray-700 capitalize dark:text-gray-200">Kode Batch</label>
                                    <input type="text" v-model="formIncoming.kode_batch"
                                        class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                                    <span class="text-sm text-red-500" v-if="formIncoming.errors.kode_batch">{{ formIncoming.errors.kode_batch }}</span>
                                </div>
                                <div class="mt-4">
                                    <label for="batch" class="block text-lg text-gray-700 capitalize dark:text-gray-200">Supplier</label>
                                    <input type="text" v-model="formIncoming.supplier"
                                        class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                                    <span class="text-sm text-red-500" v-if="formIncoming.errors.supplier">{{ formIncoming.errors.supplier }}</span>
                                </div>
                                <div class="mt-4">
                                    <label for="batch" class="block text-lg text-gray-700 capitalize dark:text-gray-200">Jumlah</label>
                                    <input type="number" v-model="formIncoming.jumlah"
                                        class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                                    <span class="text-sm text-red-500" v-if="formIncoming.errors.jumlah">{{ formIncoming.errors.jumlah }}</span>
                                </div>
                                <div class="mt-4">
                                    <label for="batch" class="block text-lg text-gray-700 capitalize dark:text-gray-200">Tanggal Kadaluarsa</label>
                                    <input type="date" v-model="formIncoming.tgl_kadaluarsa"
                                        class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                                    <span class="text-sm text-red-500" v-if="formIncoming.errors.tgl_kadaluarsa">{{ formIncoming.errors.tgl_kadaluarsa }}</span>
                                </div>
                                <div class="flex justify-end mt-6">
                                    <button type="submit" :disabled="formIncoming.processing"
                                        class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50 disabled:bg-indigo-300">
                                        <span v-if="formIncoming.processing">proses...</span>
                                        <span v-else>Simpan Data</span>
                                    </button>
                                </div>
                            </form>
                        </template>
                    </ModalVue>
                </div>
            </div>
        </div>
    </AppLayout>
</template>