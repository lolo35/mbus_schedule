<template>
    <div class="flex flex-col mt-2">
        <div class="flex flex-row bg-gray-900 px-3 py-1 rounded-t items-center space-x-3">
            <button class="rounded-full w-8 h-8 bg-red-500 hover:bg-red-700 text-white" title="Sterge ruta" @click="deleteRoute()">
                <i class="fas fa-trash-alt"></i>
            </button>
            <button class="text-blue-500 bg-gray-700 rounded-full w-8 h-8 hover:bg-gray-600" title="Adauga Statie" @click="dialogIsOpen = true">
                <i class="fas fa-plus"></i>
            </button>
            <button class="text-blue-500 bg-gray-700 rounded-full w-8 h-8 hover:bg-gray-600" title="Editeaza ruta" @click="showEdit = !showEdit">
                <i class="fas fa-edit"></i>
            </button>
            <h4 class="text-md font-bold text-gray-300" v-if="!showEdit">{{ routeName }} - {{ routeDescription }}</h4>
            <div v-if="showEdit" class="flex flex-row space-x-2">
                <form class="flex flex-row" @submit="changeRouteName()">
                    <input type="text" class="rounded-l px-3 py-1" v-model="routeName">
                    <button type="submit" class="rounded-r px-3 py-1 text-white"
                        :class="{'bg-blue-500 hover:bg-blue-700': !routeNameSaved, 'bg-green-500 hover:bg-green-700': routeNameSaved}"
                    >
                        <i class="far fa-save"></i>
                    </button>
                </form>
                <form class="flex flex-row" @submit="changeRouteDescription()">
                    <input type="text" class="rounded-l px-3 py-1" v-model="routeDescription">
                    <button type="submit" class="rounded-r px-3 py-1 text-white"
                        :class="{'bg-blue-500 hover:bg-blue-700': !routeDescriptionSaved, 'bg-green-500 hover:bg-green-700': routeDescriptionSaved}"
                    >
                        <i class="far fa-save"></i>
                    </button>
                </form>
            </div>
        </div>
        <div v-if="showStations">
            <Station v-for="(station, index) in stations" :index="index" :key="station.id" :station="station" v-on:deleteStation="deleteStation"></Station>
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
                    <input type="text" id="station" class="border-b px-3 py-1 appearance-none outline-none focus:bg-gray-100" v-model="description">
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
import Swal from 'sweetalert2';

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
            routeName: this.route.route,
            routeDescription: this.route.description,
            showEdit: false,
            routeNameSaved: false,
            routeDescriptionSaved: false,
        }
    },
    props: {
        route: Object,
        index: Number,
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
        deleteStation(payload){
            console.log(payload);
            this.stations.splice(payload, 1);
        },
        async deleteRoute(){
            const swal = await Swal.fire({
                icon: 'question',
                text: `Esti sigur ca vrei sa stergi ruta ${this.route.route}?`,
                showCancelButton: true,
                cancelButtonText: "Nu",
                cancelButtonColor: "red",
                confirmButtonText: "Da",
            });
            if(swal.isConfirmed){
                let formData = new FormData();
                formData.append('api_token', this.$store.state.apiKey);
                formData.append('route_id', this.route.id);
                const response = await axios.post(`${this.$store.state.url}deleteRoute`, formData, {headers: {"Content-type": "application/x-www-form-urlencoded"}});
                if(process.env.NODE_ENV === "development"){
                    console.log(response.data);
                }
                if(response.data.success){
                    this.$store.dispatch('routes/removeRoute', this.index);
                }
            }
        },
        async changeRouteDescription(){
            event.preventDefault();
            let formData = new FormData();
            formData.append('api_token', this.$store.state.apiKey);
            formData.append('route_id', this.route.id);
            formData.append('description', this.routeDescription);
            try {
                const response = await axios.post(`${this.$store.state.url}editRouteDescription`, formData, {headers: {"Content-type": "application/x-www-form-urlencoded"}});
                if(process.env.NODE_ENV === "development"){
                    console.log(response.data);
                }
                if(response.data.success){
                    this.routeDescriptionSaved = true;
                    setTimeout(() => {
                        this.routeDescriptionSaved = false;
                    }, 5000);
                }
            } catch (error){
                if(process.env.NODE_ENV === "development"){
                    console.error(error);
                }
            }
        },
        async changeRouteName(){
            event.preventDefault();
            let formData = new FormData();
            formData.append('api_token', this.$store.state.apiKey);
            formData.append('route', this.routeName);
            formData.append('route_id', this.route.id);
            try {
                const response = await axios.post(`${this.$store.state.url}editRouteName`, formData, {headers: {"Content-type": "application/x-www-form-urlencoded"}});
                if(process.env.NODE_ENV === "development"){
                    console.log(response.data);
                }
                if(response.data.success){
                    this.routeNameSaved = true;
                    setTimeout(() => {
                        this.routeNameSaved = false;
                    }, 5000);
                }
            } catch (error){
                if(process.env.NODE_ENV === "development"){
                    console.error(error);
                }
            }
        },
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
            let description = "";
            if(this.description.length == 0){
                description = "N/A";
            }else{
                description = this.description;
            }
            formData.append('api_token', this.$store.state.apiKey);
            formData.append('route_id', this.route.id);
            formData.append('station', this.station);
            formData.append('description', description);

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