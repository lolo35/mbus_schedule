<template>
    <div class="flex flex-col px-3">
        <div class="flex-flex-row w-full items-center justify-between">
            <button class="flex flex-row w-full items-center justify-between" @click="showTimes = !showTimes">
                <div class="flex flex-row flex-wrap">
                    <i class="fas fa-sign text-blue-500"></i>
                    <p>{{ station.station }} </p>
                    <!-- - {{ station.description }} -->
                </div>
                <div>
                    <i class="fas" :class="{'fa-angle-double-down text-gray-700': !showTimes, 'fa-angle-double-up text-green-500': showTimes}"></i>
                </div>
            </button>
        </div>
        <div v-if="showTimes">
            <schedule v-for="schedule in schedules" :key="schedule.id" :schedule="schedule"></schedule>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Schedule from './Schedule.vue';

export default {
    name: "Station",
    data(){
        return {
            showTimes: false,
            schedules: [],
        }
    },
    props: {
        station: Object,
    },
    components: {
        Schedule,
    },
    created(){
        this.fetchSchedule();
    },
    methods: {
        async fetchSchedule(){
            let params = `?api_token=${this.$store.state.apiKey}&station_id=${this.station.id}`;
            try {
                const response = await axios.get(`${this.$store.state.url}stationSchedule${params}`);
                if(process.env.NODE_ENV === "development"){
                    console.log(response.data);
                }
                if(response.data.success) {
                    this.schedules = response.data.schedule;
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