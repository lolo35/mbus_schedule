<template>
    <div class="flex flex-col bg-white shadow border px-3 py-1">
        <div class="flex flex-row">
            <h5 class="text-md font-semibold">
                <i class="fas fa-bus text-green-500"></i>
                {{ routeData.route }}
            </h5>
        </div>
        <div v-if="showStations">
            <Station v-for="station in stations" :key="station.id" :station="station" />
        </div>
    </div>
</template>

<script>
import Station from './Station.vue';
import axios from 'axios';

export default {
    name: "Route",
    data() {
        return {
            stations: [],
            showStations: false,
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
        }
    }
}
</script>

<style>

</style>