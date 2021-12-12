<template>
    <div class="flex flex-col mt-2">
        <div class="flex flex-row bg-gray-900 px-3 py-1 rounded-t items-center space-x-3">
            <button class="rounded-full w-8 h-8 bg-red-500 hover:bg-red-700 text-white" title="Sterge ruta">
                <i class="fas fa-trash-alt"></i>
            </button>
            <button class="text-blue-500 bg-gray-700 rounded-full w-8 h-8 hover:bg-gray-600" title="Adauga Statie" @click="dialogIsOpen = true">
                <i class="fas fa-plus"></i>
            </button>
            <h4 class="text-md font-bold text-gray-300">{{ route.route }} - {{ route.description }}</h4>
        </div>
        <div v-if="showStations">
            <Station v-for="station in stations" :key="station.id" :station="station"></Station>
        </div>
    </div>
    <Dialog 
        :open="dialogIsOpen" 
        @close="dialogIsOpen = false"
        class="fixed inset-0 z-10 overflow-y-auto"
    >
        <div class="flex items-center justify-center min-h-screen">
            <DialogOverlay class="fixed inset-0 bg-black opacity-30"/>
            <div class="relative mx-auto bg-white rounded px-3 py-1 shadow border w-1/3">
                <DialogTitle>
                    <h5 class="text-md font-bold">
                        <i class="fas fa-plus text-blue-500"></i>
                        Adauga Statie
                    </h5>
                </DialogTitle>
                <form class="flex flex-col" @submit="addStation()">
                    <label for="station" class="text-sm font-semibold">
                        <i class="fas fa-map-marked-alt text-blue-500"></i>
                        Statie
                    </label>
                    <input type="text" id="station" class="border-b px-3 py-1 appearance-none outline-none focus:bg-gray-100" required v-model="station">
                    <label for="description" class="text-sm font-semibold">
                        <i class="far fa-comment-dots text-blue-500"></i>
                        Descriere
                    </label>
                    <input type="text" id="station" class="border-b px-3 py-1 appearance-none outline-none focus:bg-gray-100" required v-model="description">
                    <div class="flex flex-row w-full bg-green-100 px-3 py-1" v-if="success">
                        <p class="text-green-500 font-semibold">
                            Statie adaugat cu success
                        </p>
                    </div>
                    <div class="flex flex-row space-x-2 mt-4">
                        <button class="rounded shadow hover:bg-blue-100 bg-white border border-blue-500 px-3 py-1" type="submit">Adaugare</button>
                        <button class="rounded shadow bg-red-500 text-white px-3 py-1 hover:bg-red-700" type="button" @click="dialogIsOpen = false">Anuleaza</button>
                    </div>
                </form>
            </div>
        </div>
    </Dialog>
</template>

<script>
import {
    Dialog,
    DialogTitle,
    DialogOverlay,
} from '@headlessui/vue';
import axios from 'axios';
import Station from './Station.vue';

export default {
    name: "IndRoutes", //individual Routes,
    data(){
        return {
            dialogIsOpen: false,
            station: "",
            description: "",
            success: false,
            showStations: false,
            stations: [],
        }
    },
    props: {
        route: Object,
    },
    components: {
        Dialog,
        DialogTitle,
        DialogOverlay,
        Station,
    },
    created(){
        this.fetchStations();
    },
    methods: {
        async fetchStations(){
            try {
                let params = `?api_token=${this.$store.state.apiKey}&route_id=${this.route.id}`;
                const response = await axios.get(`${this.$store.state.url}stations${params}`);
                if(process.env.NODE_ENV === "development"){
                    console.log(response.data);
                }
                if(response.data.success){
                    this.stations = response.data.stations;
                    this.showStations = true;
                }
            } catch (error){
                if(process.env.NODE_ENV === "development"){
                    console.error(error);
                }
            }
        },
        async addStation(){
            event.preventDefault();
            let formData = new FormData();
            formData.append('api_token', this.$store.state.apiKey);
            formData.append('route_id', this.route.id);
            formData.append('station', this.station);
            formData.append('description', this.description);

            try {
                const response = await axios.post(`${this.$store.state.url}addStation`, formData, {headers: {"Content-type": "application/x-www-form-urlencoded"}});
                if(process.env.NODE_ENV === "development"){
                    console.log(response.data);
                }
                if(response.data.success){
                    this.station = "";
                    this.description = "";
                    this.success = true;
                    setTimeout(() => {
                        this.success = false;
                    }, 5000);
                    this.stations.push(response.data.station);
                    this.showStations = true;
                }
            } catch (error){
                if(process.env.NODE_ENV === "development"){
                    console.error(error);
                }
            }
        }
    }
}
</script>

<style>

</style>