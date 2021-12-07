<template>
    <div class="flex flex-col bg-white shadow border px-3 py-1">
        <div class="flex flex-row">
            <h5 class="text-md font-semibold">
                <i class="fas fa-bus text-green-500"></i>
                {{ routeData.route }}
            </h5>
        </div>
        <Station v-for="station in routeData.stations" :key="station.name" :station="station"/>
    </div>
</template>

<script>
import Station from './Station.vue';

export default {
    name: "Route",
    props: {
        routeData: Object,
    },
    components: {
        Station,
    }
}
</script>

<style>

</style>