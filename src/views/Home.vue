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
		<Route v-for="route in routeResult" :key="route.route" :routeData="route"/>
	</div>
</template>

<script>
// @ is an alias to /src
import Route from '../components/Routes/Route.vue';
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
	computed: {
		routeResult(){
			if(this.routeSearch.toString().length > 0){
				return this.$store.state.Routes.routes.filter(element => {
					const search = this.routeSearch.toString().toLowerCase();
					const route = element.route.toString().toLowerCase();
					return route.includes(search);
				});
			}else{
				return this.$store.state.Routes.routes;
			}
		}
	}
}
</script>
