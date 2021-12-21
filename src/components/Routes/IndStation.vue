<template>
    <div class="flex flex-col border-t border-b px-3 py-4">
        <div class="flex flex-row items-center space-x-2">
            <i class="fas fa-sign text-blue-500"></i>
            <h5 class="font-semibold">{{ station.station }}</h5>
        </div>
        <div class="flex flex-row">
            <h5 class="text-sm font-bold">Tur: </h5>
        </div>
        <div class="flex flex-row items-center justify-between border-b mb-2">
            <div class="flex flex-row w-full justify-between items-center" v-if="showSchedules">
                <!-- <Schedule v-for="schedule in schedules" :key="schedule.id" :schedule="schedule"></Schedule> -->
                <p v-for="schedule in schedules" :key="schedule.id" class="text-sm font-semibold">Sch. {{ schedule.shift }}: <span class="font-bold italic text-gray-900"> {{ schedule.tur }}</span></p>
            </div>
        </div>
        <div class="flex flex-row mb-2">
            <h5 class="text-sm font-bold">Retur: </h5>
        </div>
        <div class="flex flex-row items-center justify-between border-b">
            <div class="flex flex-row w-full justify-between items-center" v-if="showSchedules">
                <p v-for="schedule in schedules" :key="schedule.id" class="text-sm font-semibold">Sch. {{ schedule.shift }}: <span class="font-bold italic text-gray-900"> {{ schedule.retur }}</span></p>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
// import Schedule from '../Routes/Schedule.vue'
export default {
    name: "IndStation",
    data(){
        return {
            schedules: [],
            showSchedules: false,
        }
    },
    props: {
        station: Object,
    },
    components: {
        // Schedule,
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
                    this.showSchedules = true;
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