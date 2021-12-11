<template>
	<Navbar />
	<main class="flex w-full h-screen">
		<Sidebar />
		<section class="w-full p-4 overflow-scroll">
			<router-view name="home"></router-view>
		</section>
	</main>
</template>

<script>
import Navbar from '../components/Navigation/Navbar.vue';
import Sidebar from '../components/Navigation/Sidebar.vue';

export default {
	name: "Home",
	data(){
		return {

		}
	},
	components: {
		Navbar,
		Sidebar,
	}
}
</script>

<style>

</style>