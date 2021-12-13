<template>
    <div class="flex flex-col bg-white shadow border px-3 py-1">
        <div class="flex flex-row justify-between">
            <h5 class="text-md font-semibold">
                <i class="fas fa-bus text-green-500"></i>
                {{ routeData.route }}
            </h5>
            <button class="text-blue-500" v-if="!favorite" title="Adauga la favorite" @click="addToFavorites()">
                <i class="far fa-heart"></i>
            </button>

            <button class="text-blue-500" v-if="favorite" title="Elimina de la favorite" @click="removeFromFavorites()">
                <i class="fas fa-heart"></i>
            </button>
        </div>
        <div v-if="showStations">
            <Station v-for="station in stations" :key="station.id" :station="station" />
        </div>
    </div>
</template>

<script>
import Station from './Station.vue';
import axios from 'axios';
import localforage from 'localforage';

export default {
    name: "Route",
    data() {
        return {
            stations: [],
            showStations: false,
            favorite: false,
        }
    },
    props: {
        routeData: Object,
    },
    components: {
        Station,
    },
    created(){
        this.fetchStations();
        this.checkforFavorite();
    },
    methods: {
        async fetchStations(){
            let params = `?api_token=${this.$store.state.apiKey}&route_id=${this.routeData.id}`;
            console.log(params);
            try {
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
        async addToFavorites(){
            let favorites = await localforage.getItem('favoriteRoutes');
            let route = Object.assign({}, this.routeData);
            favorites.push(route);
            await localforage.setItem('favoriteRoutes', favorites);
            this.favorite = true;
            // favorites.filter(element => {
            //     console.log(element);
            // });
        },
        async removeFromFavorites(){
            const favorites = await localforage.getItem('favoriteRoutes');
            if(favorites.length > 1){
                let newFavorites;
                for(let i = 0; i < favorites.length; i++){
                    if(this.routeData.id === favorites[i].id){
                        console.log(favorites[i].id);
                        newFavorites = favorites.splice(i, 1);
                        break;
                    }
                }
                await localforage.setItem('favoriteRoutes', newFavorites);
            }else{
                await localforage.setItem('favoriteRoutes', []);
            }
            this.favorite = false;
        },
        async checkforFavorite(){
            const favorites = await localforage.getItem('favoriteRoutes');
            for(let i = 0; i < favorites.length; i++){
                if(this.routeData.id === favorites[i].id){
                    this.favorite = true;
                    break;
                }
            }
        }
    }
}
</script>

<style>

</style>