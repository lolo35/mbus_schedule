<template>
	<div class="flex flex-col space-y-2 px-3">
		<div class="flex flex-row px-3 py-1">
			<h5 class="text-lg font-semibold text-gray-600">
				<i class="fas fa-search text-blue-500"></i>
				Cautare rute
			</h5>
		</div>
		<div class="flex flex-row w-full px-3">
			<input type="text" class="border-b p-2 w-full appearance-none outline-none" v-model="routeSearch">
		</div>
		<!-- <div class="flex flex-row">
			<p class="text-sm font-bold">
				Angajatii vor fi in statii cu 10 min inaintea orelor din grafic
			</p>
		</div> -->
		<Route v-for="route in routeResult" :key="route.id" :routeData="route"/>
	</div>
</template>

<script>
// @ is an alias to /src
import Route from '../components/Routes/Route.vue';
import localforage from 'localforage';
import Cookies from 'js-cookie';
import Swal from "sweetalert2";
import axios from 'axios';

export default {
	name: 'Home',
	data() {
		return {
			routeSearch: "",
		}
	},
	components: {
		Route,
	},
	created(){
		this.checkForDivision();
		this.fetchRoutes();
	},
	methods: {
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
		async checkForDivision(){
			try {
				const division = await localforage.getItem('division');
				if(!division){
					const cookieDiv = Cookies.get('division', {path: '/'});
					let inputOptions = {};
					if(cookieDiv === "TRO"){
						inputOptions = {
							'TRO': "Autoliv - Lugoj",
							'TROR': "Autoliv - Resita"
						}
					}
					console.log(division);
					const swal = await Swal.fire({
						icon: 'question',
						text: 'Se pare ca nu ai ales localitatea',
						input: 'select',
						inputPlaceholder: "Alege localitatea",
						inputOptions: inputOptions
					});

					if(swal.isConfirmed){
						await localforage.setItem('division', swal.value);
						this.fetchRoutes();
					}
				}
			} catch (error) {
				if(process.env.NODE_ENV === "development"){
					console.error(error);
				}
			}
		}
	},
	computed: {
		routeResult(){
			if(this.routeSearch.toString().length > 0){
				return this.$store.state.routes.routes.filter(element => {
					const search = this.routeSearch.toString().toLowerCase();
					const route = element.route.toString().toLowerCase();
					return route.includes(search);
				});
			}else{
				return this.$store.state.routes.routes;
			}
		}
	}
}
</script>
