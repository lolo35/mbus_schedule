<template>
    <div class="flex flex-col px-3 py-1 space-y-3">
        <div class="flex flex-row w-full justify-center">
            <h5 class="text-lg font-semibold">Reclamatii/Sugestii</h5>
        </div>
        <div class="flex flex-col">
            <label for="feedback_type" class="block text-sm font-medium text-gray-700">Vrei sa faci o sugestie sau reclamatie?</label>
            <select id="feedback_type" class="bg-white px-3 py-1 border shadow outline-none" v-model="select">
                <option value="">Alege</option>
                <option value="1">Reclamatie</option>
                <option value="2">Sugestie</option>
            </select>
        </div>
        <complaints v-if="select === '1'" :type="'complaint'"></complaints>
        <complaints v-if="select === '2'" :type="'sugestion'"></complaints>
    </div>
</template>

<script>
import Complaints from '../components/Feedback/Complaints.vue';

export default {
    name: "Feedback",
    data(){
        return {
            select: "",
        }
    },
    components: {
        Complaints,
    }
}
</script>

<style>

</style>