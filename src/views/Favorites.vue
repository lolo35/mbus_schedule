<template>
    <div class="flex flex-col px-3 py-1">
        <div class="flex flex-row">
            <h5 class="font-semibold text-lg text-gray-700">
                <i class="fas fa-heart text-blue-500"></i>
                Rute favorite
            </h5>
        </div>
        <Route v-for="route in routes" :routeData="route" :key="route.id" />
    </div>
</template>

<script>
import localforage from 'localforage';
import Route from '../components/Routes/Route.vue';

export default {
    name: "Favorites",
    data(){
        return {
            routes: [],
        }
    },
    components: {
        Route,
    },
    created(){
        this.fetchFavorites();
    },
    methods: {
        async fetchFavorites(){
            const favorites = await localforage.getItem('favoriteRoutes');
            this.routes = favorites;
        }
    }
}
</script>

<style>

</style>