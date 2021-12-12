<template>
    <div class="relative">
        <label for="shift1" class="text-sm font-semibold text-gray-600">Sch {{ shift }}</label>
        <input type="text" id="shift1" class="text-sm font-semibold border-b appearance-none outline-none w-12 px-1" v-model="hour" @blur="saveChanges()">
        <i class="fas fa-check-circle text-green-500 absolute top-0 right-0" v-if="success"></i>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: "ScheduleInput",
    data(){
        return {
            success: false,
            hour: "",
        }
    },
    props: {
        shift: Number,
        type: String,
        station_id: Number,
        hourVal: String,
    },
    watch: {
        hourVal: function(){
            this.setValue();
        }
    },
    methods: {
        async saveChanges(){
            let formData = new FormData();
            formData.append('api_token', this.$store.state.apiKey);
            formData.append('type', this.type);
            formData.append('station_id', this.station_id);
            formData.append('shift', this.shift);
            formData.append(this.type, this.hour);
            try {
                const response = await axios.post(`${this.$store.state.url}stationSchedule`, formData, {headers: {"Content-type": "application/x-www-form-urlencded"}});
                if(process.env.NODE_ENV === "development"){
                    console.log(response.data);
                }
                if(response.data.success){
                    this.success = true;
                    setTimeout(() => {
                        this.success = false;
                    }, 5000);
                }
            } catch (error){
                if(process.env.NODE_ENV === "development"){
                    console.error(error);
                }
            }
        },
        setValue(){
            this.hour = this.hourVal;
        }
    }
}
</script>

<style>

</style>