<template>
    <form class="flex flex-col space-y-2" @submit="addComplaint()">
        <div class="flex flex-col">
            <label for="subject" class="block text-sm font-semibold text-gray-700">Subiect</label>
            <input type="text" required class="border-b px-3 py-1 outline-none appearance-none focus:border-blue-500" v-model="subject">
        </div>
        <div class="flex flex-col">
            <label for="route" class="block text-sm font-semibold text-gray-700">Ruta</label>
            <select id="route" class="bg-white px-3 py-1 border shadow outline-none" v-model="route_id">
                <option value="">Alege ruta</option>
                <option :value="route.id" v-for="route in $store.state.routes.routes" :key="route.id">{{ route.route }}</option>
            </select>
        </div>
        <div class="flex flex-col">
            <label for="problem" class="block text-sm font-semibold text-gray-700" v-if="type === 'complaint'">Reclamatie</label>
            <label for="problem" class="block text-sm font-semibold text-gray-700" v-if="type === 'sugestion'">Sugestie</label>
            <textarea id="problem" cols="10" rows="15" class="border appearance-none outline-none px-2 py-1 focus:border-blue-500" v-model="complaint"></textarea>
        </div>
        <div class="flex flex-row w-full">
            <button type="submit" class="w-full text-white bg-blue-500 hover:bg-blue-700 focus:bg-blue-700 px-3 py-1 rounded">
                <i class="fas fa-paper-plane"></i>
                Trimite
            </button>
        </div>
    </form>
</template>

<script>
import localforage from 'localforage';
import Cookies from 'js-cookie';
import axios from 'axios';
import Swal from "sweetalert2";

export default {
    name: "Complaints",
    data(){
        return {
            subject: "",
            complaint: "",
            route_id: "",
        }
    },
    props: {
        type: String,
    },
    created() {
        if(this.$store.state.routes.routes.length == 0){
            this.fetchRoutes();
        }
    },
    methods: {
        async addComplaint(){
            event.preventDefault();
            let division = await localforage.getItem('division');
            let formData = new FormData();
            formData.append('api_token', this.$store.state.apiKey);
            formData.append('division', division);
            formData.append('user_id', Cookies.get('user_id', {path: '/'}));
            if(this.type === "complaint"){
                formData.append('complaint', this.complaint);
            }else if(this.type === "sugestion"){
                formData.append('sugestion', this.complaint);
            }
            formData.append('title', this.subject);
            formData.append('route_id', this.route_id);
            try {
                const response = await axios.post(`${this.$store.state.url}${this.type}`, formData, {headers: {"Content-type": "application/x-www-form-urlencoded"}});
                if(process.env.NODE_ENV === "development"){
                    console.log(response.data);
                }
                if(response.data.success){
                    this.subject = "";
                    this.complaint = "";
                    this.route_id = "";
                    if(this.type === "complaint"){
                        Swal.fire({
                            icon:'success',
                            text: "Reclamatia ta a fost trimisa cu success",
                        });
                    }else if(this.type === "sugestion"){
                        Swal.fire({
                            icon:'success',
                            text: "Sugestia ta a fost trimisa cu success",
                        });
                    }
                }
            } catch (error){
                if(process.env.NODE_ENV === "development") {
                    console.error(error);
                }
            }
        },
        async fetchRoutes(){
			const division = await localforage.getItem('division');
			if(division){
				let params = `?api_token=${this.$store.state.apiKey}&division=${division}`
				try {
					const response = await axios.get(`${this.$store.state.url}routes${params}`);
					if(process.env.NODE_ENV === "development"){
						console.log(response.data);
					}
					if(response.data.success){
						this.$store.dispatch('routes/setRoutes', response.data.data);
					}
				} catch (error){
					if(process.env.NODE_ENV === "development"){
						console.error(error);
					}
				}
			}
		},
    }
}
</script>

<style>

</style>