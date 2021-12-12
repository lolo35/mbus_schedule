<template>
    <div class="flex flex-row items-center justify-between bg-white border px-3 py-1">
        <div class="flex flex-row">
            <p class="text-sm font-semibold text-gray-600 italic">{{ station.station }} - {{ station.description }}</p>
        </div>
        <div class="flex flex-col">
            <p class="font-semibold text-gray-800">Tur:</p>
            <div class="flex flex-row items-center space-x-2">
                <schedule-input :shift="1" :hourVal="schedule[0] ? schedule[0].tur : ''" :station_id="parseInt(this.station.id)" :type="'tur'"></schedule-input>
                <schedule-input :shift="2" :hourVal="schedule[1] ? schedule[1].tur : ''" :station_id="parseInt(this.station.id)" :type="'tur'"></schedule-input>
                <schedule-input :shift="3" :hourVal="schedule[2] ? schedule[2].tur : ''" :station_id="parseInt(this.station.id)" :type="'tur'"></schedule-input>
            </div>
        </div>
        <div class="flex flex-col">
            <p class="font-semibold text-gray-800">Retur</p>
            <div class="flex flex-row items-center space-x-2">
                <schedule-input :shift="1" :hourVal="schedule[0] ? schedule[0].retur : ''" :station_id="parseInt(this.station.id)" :type="'retur'"></schedule-input>
                <schedule-input :shift="2" :hourVal="schedule[0] ? schedule[1].retur : ''" :station_id="parseInt(this.station.id)" :type="'retur'"></schedule-input>
                <schedule-input :shift="3" :hourVal="schedule[0] ? schedule[2].retur : ''" :station_id="parseInt(this.station.id)" :type="'retur'"></schedule-input>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import ScheduleInput from './ScheduleInput.vue';

export default {
    name: "Station",
    data(){
        return {
            schedule: [],
        }
    },
    components: {
        ScheduleInput,
    },
    props: {
        station: Object,
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
                if(response.data.success){
                    this.schedule = response.data.schedule;
                }
            } catch (error) {
                if(process.env.NODE_ENV === "development"){
                    console.error(error);
                }
            }
        },
    }
}
</script>

<style>

</style>