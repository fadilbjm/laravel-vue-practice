<script setup>
import { ref } from 'vue';

const props = defineProps({
    drugs: Array
})
let tambahanTr = ref(false);

const clickText = () => {
    tambahanTr.value = !tambahanTr.value;
}
// console.log(props.drugs)
</script>

<template>
    <table class="mr-2 ml-2 w-full table">
        <thead class="bg-black text-white">
            <th class="p-2 font-thin text-center text-lg">#</th>
            <th class="p-2 font-thin text-center text-lg">Nama Obat</th>
            <th class="p-2 font-thin text-center text-lg">Jenis Obat</th>
            <th class="p-2 font-thin text-center text-lg">Satuan</th>
            <th class="p-2 font-thin text-center text-lg">Harga Beli</th>
            <th class="p-2 font-thin text-center text-lg">Harga Jual</th>
            <th class="p-2 font-thin text-center text-lg">Stok</th>
        </thead>
        <tbody v-for="(drug, index) in drugs">
            <tr :key="drug.id" class="border-y-2">
                <td class="p-1 border-r-2 text-center">{{ index + 1 }}</td>
                <td class="p-1 border-r-2 underline"><div @click="clickText()">{{ drug.nama }}</div></td>
                <td class="p-1 border-r-2">{{ drug.jenis_obat.nama }}</td>
                <td class="p-1 border-r-2">{{ drug.satuan }}</td>
                <td class="p-1 border-r-2">{{ drug.harga_beli }}</td>
                <td class="p-1 border-r-2">{{ drug.harga_jual }}</td>
                <td class="p-1 border-r-2">{{ drug.stok }}</td>
            </tr>
        </tbody>
    </table>
</template>