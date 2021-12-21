<template>
    <div class="flex flex-col mb-20">
        <router-link :to="route_path" class="flex flex-row px-3 py-4 items-center space-x-3">
            <i class="fas fa-arrow-left"></i>
            <p>Inapoi</p>
        </router-link>
        <div class="flex flex-row items-center justify-center border-b">
            <h5 class="text-lg font-bold text-gray-700">
                <i class="fas fa-bus text-green-500"></i>
                {{ route_name }}
                <button class="text-blue-500" v-if="!favorite" title="Adauga la favorite" @click="addToFavorites()">
                    <i class="far fa-heart"></i>
                </button>

                <button class="text-blue-500" v-if="favorite" title="Elimina de la favorite" @click="removeFromFavorites()">
                    <i class="fas fa-heart"></i>
                </button>
            </h5>
        </div>
        <div v-if="showStations">
            <ind-station v-for="station in stations" :key="station.id" :station="station"></ind-station>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import localforage from 'localforage';
import IndStation from '../components/Routes/IndStation.vue';

export default {
    name: "Station",
    data(){
        return {
            stations: [],
            showStations: false,
            favorite: false,
        }
    },
    props: {
        query: String,
        route_name: String,
        route_path: String,
    },
    components: {
        IndStation,
    },
    created(){
        this.fetchStations();
        this.checkforFavorite();
    },
    methods: {
        async fetchStations(){
            let params = `?api_token=${this.$store.state.apiKey}&route_id=${this.query}`;
            //console.log(params);
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
        async checkforFavorite(){
            let route_id = parseInt(this.query);
            const favorites = await localforage.getItem('favoriteRoutes');
            for(let i = 0; i < favorites.length; i++){
                if(route_id === favorites[i].id){
                    this.favorite = true;
                    break;
                }
            }
        },
        async addToFavorites(){
            let favorites = await localforage.getItem('favoriteRoutes');
            let division = await localforage.getItem('division');
            let route = Object.assign({}, {id: parseInt(this.query), division: division, route: this.route_name});
            favorites.push(route);
            await localforage.setItem('favoriteRoutes', favorites);
            this.favorite = true;
            // favorites.filter(element => {
            //     console.log(element);
            // });
        },
        async removeFromFavorites(){
            const favorites = await localforage.getItem('favoriteRoutes');
            let route_id = parseInt(this.query);
            if(favorites.length > 1){
                let newFavorites;
                for(let i = 0; i < favorites.length; i++){
                    if(route_id === favorites[i].id){
                        //console.log(favorites[i].id);
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
    }
}
</script>

<style>

</style>