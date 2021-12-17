<template>
    <div class="flex flex-row items-center justify-between bg-white border px-3 py-1">
        <div class="flex flex-row items-center justify-center space-x-2">
            <button class="text-xs font-semibold text-red-500 hover:text-red-600 hover:underline" @click="deleteStation()">
                <i class="fas fa-trash-alt"></i>
                Sterge
            </button>
            <button class="text-xs text-blue-500 hover:text-blue-600 hover:underline" v-if="!edit" @click="toggleEdit()">
                <i class="fas fa-edit"></i>
                Editare
            </button>
            <button class="text-xs text-green-500 hover:text-green-600 hover:underline" v-if="edit" @click="saveEdit()">
                <i class="fas fa-save"></i>
                Salveaza
            </button>
            <p class="text-sm font-semibold text-gray-600 italic" v-if="!edit">{{ stationM }} - {{ station.description }}</p>
            <input type="text" v-model="stationM" class="border-b appearance-none outline-none px-3 py-1" v-if="edit">
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
import Swal from 'sweetalert2';

export default {
    name: "Station",
    data(){
        return {
            schedule: [],
            stationM: this.station.station,
            edit: false,
        }
    },
    components: {
        ScheduleInput,
    },
    props: {
        station: Object,
        index: Number,
    },
    created(){
        this.fetchSchedule();
    },
    emits: ['deleteStation'],
    methods: {
        toggleEdit(){
            this.edit = !this.edit;
        },
        async saveEdit(){
            let formData = new FormData();
            formData.append('api_token', this.$store.state.apiKey);
            formData.append('station_id', this.station.id);
            formData.append('value', this.stationM);
            try {
                const response = await axios.post(`${this.$store.state.url}editStation`, formData, {headers: {"Content-type": "application/x-www-form-urlencoded"}});
                if(process.env.NODE_ENV === "development"){
                    console.log(response.data);
                }
                if(response.data.success){
                    this.toggleEdit();
                }
            } catch (error){
                if(process.env.NODE_ENV === "development"){
                    console.error(error);
                }
            }
        },
        async deleteStation(){
            const swal = await Swal.fire({
                icon: 'question',
                text: `Esti sigur ca vrei sa stergi statia ${this.station.station}?`,
                showCancelButton: true,
                cancelButtonText: "Nu",
                cancelButtonColor: "red",
                confirmButtonText: "Da",
            });
            if(swal.isConfirmed){
                console.log('its confirmed');
                let formData = new FormData();
                formData.append('api_token', this.$store.state.apiKey);
                formData.append('station_id', this.station.id);
                const response = await axios.post(`${this.$store.state.url}deleteStation`, formData, {headers: {"Content-type":"application/x-www-form-urlencoded"}});
                if(process.env.NODE_ENV === "development"){
                    console.log(response.data);
                }
                if(response.data.success){
                    this.$emit('deleteStation', this.index);
                }
            }
        },
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