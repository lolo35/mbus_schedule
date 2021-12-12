<template>
    <section class="flex flex-col w-full">
        <Bar />
        <Dialog 
            :open="$store.state.routes.modalIsOpen" 
            @close="$store.dispatch('routes/setModalIsOpen', false)"
            class="fixed inset-0 z-10 overflow-y-auto"
        >
            <div class="flex items-center justify-center min-h-screen">
                <DialogOverlay class="fixed inset-0 bg-black opacity-30"/>
                <div class="relative w-1/3 mx-auto bg-white rounded px-3 py-1 shadow border">
                    <DialogTitle>
                        <h5 class="text-md font-bold">Adaugare ruta</h5>
                    </DialogTitle>
                    <DialogDescription>
                        
                    </DialogDescription>
                    <form class="flex flex-col w-full space-y-3" @submit="addRoute()">
                        <div class="flex flex-row w-full">
                            <div class="flex flex-col w-full">
                                <label for="name" class="font-semibold text-sm text-gray-700">
                                    <i class="fas fa-route text-blue-500"></i>
                                    Nume ruta
                                </label>
                                <input type="text" class="px-3 py-1 border-b appearance-none outline-none" required v-model="routeName">
                            </div>
                        </div>
                        <div class="flex flex-row w-full">
                            <div class="flex flex-col w-full">
                                <label for="description" class="font-semibold text-sm text-gray-700">
                                    <i class="fas fa-map-marked text-blue-500"></i>
                                    Descriere ruta
                                </label>
                                <input type="text" class="px-3 py-1 border-b appearance-none outline-none" required v-model="routeDescription">
                            </div>
                        </div>
                        <div class="bg-green-100 flex flex-row px-3 py-1" v-if="successMessage">
                            <p class="text-sm font-semibold text-green-600">Ruta a fost adaugat cu success</p>
                        </div>
                        <div class="flex flex-row space-x-2">
                            <button class="rounded shadow hover:bg-blue-100 bg-white border border-blue-500 px-3 py-1" type="submit">Adaugare</button>
                            <button class="rounded shadow bg-red-500 text-white px-3 py-1 hover:bg-red-700" type="button" @click="$store.dispatch('routes/setModalIsOpen', false)">Anuleaza</button>
                        </div>
                    </form>
                </div>
            </div>
        </Dialog>
        <div id="routes" v-if="$store.state.routes.showRoutes">
            <ind-routes v-for="route in routeData" :key="route.id" :route="route"></ind-routes>
        </div>
    </section>
</template>

<script>
import Bar from '../components/Menubar/Bar.vue';
import axios from 'axios';
import {
    Dialog,
    DialogOverlay,
    DialogTitle,
    DialogDescription
} from '@headlessui/vue';
import Cookies from 'js-cookie';
import IndRoutes from '../components/Routes/IndRoutes.vue';
import { mapGetters } from 'vuex';

export default {
    name: "Routes",
    data(){
        return {
            routeName: "",
            routeDescription: "",
            successMessage: false,
        }
    },
    components: {
        Bar,
        Dialog,
        DialogOverlay,
        DialogTitle,
        DialogDescription,
        IndRoutes,
    },
    created(){
        this.getRoutes();
    },
    methods: {
        async getRoutes(){
            try {
                const response = await axios.get(`${this.$store.state.url}routes?api_token=${this.$store.state.apiKey}&division=${Cookies.get('division', { path: '/'})}`);
                if(process.env.NODE_ENV === "development"){
                    console.log(response.data);
                }
                if(response.data.success){
                    this.$store.dispatch('routes/setRoutes', response.data.data);
                    this.$store.dispatch('routes/setShowRoutes', true);
                }
            } catch (error){
                if(process.env.NODE_ENV === "development"){
                    console.error(error);
                }
            }
        },
        async addRoute(){
            event.preventDefault();
            let formData = new FormData();
            formData.append('api_token', this.$store.state.apiKey);
            formData.append('route', this.routeName);
            formData.append('description', this.routeDescription);
            formData.append('division', Cookies.get('division', {path: '/'}));
            try {
                const response = await axios.post(`${this.$store.state.url}addRoute`, formData, {headers: {"Content-type": "application/x-www-form-urlencoded"}});
                if(process.env.NODE_ENV === "development"){
                    console.log(response.data);
                }
                if(response.data.success){
                    this.$store.dispatch('routes/addToRoutes', response.data.route);
                    this.routeName = "";
                    this.routeDescription = "";
                    this.successMessage = true;
                    setTimeout(() => {
                        this.successMessage = false;
                    }, 5000);
                }
            } catch (error){
                if(process.env.NODE_ENV === "development"){
                    console.error(error);
                }
            }
        }
    },
    computed: {
        ...mapGetters("routes", [
            'routeData',
        ]),
    }
}
</script>

<style>

</style>