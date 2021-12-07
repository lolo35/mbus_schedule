<template>
    <div class="flex flex-col px-3">
        <div class="flex-flex-row w-full items-center justify-between">
            <button class="flex flex-row w-full items-center justify-between" @click="showTimes = !showTimes">
                <div>
                    <i class="fas fa-sign text-blue-500"></i>
                    {{ station.name }}
                </div>
                <div>
                    <i class="fas" :class="{'fa-angle-double-down text-gray-700': !showTimes, 'fa-angle-double-up text-green-500': showTimes}"></i>
                </div>
            </button>
        </div>
        <div v-if="showTimes">
            <div class="flex flex-row px-3 items-center justify-between">
                <p class="text-sm font-bold text-gray-500 italic">Schimbul 1:</p>
                <p class="text-sm font-bold text-gray-500">{{ station.tur.sch1 }}</p>
            </div>
            <div class="flex flex-row px-3 items-center justify-between">
                <p class="text-sm font-bold text-gray-500 italic">Schimbul 2:</p>
                <p class="text-sm font-bold text-gray-500">{{ station.tur.sch2 }}</p>
            </div>
            <div class="flex flex-row px-3 items-center justify-between">
                <p class="text-sm font-bold text-gray-500 italic">Schimbul 3:</p>
                <p class="text-sm font-bold text-gray-500">{{ station.tur.sch3 }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Station",
    data(){
        return {
            showTimes: false,
        }
    },
    props: {
        station: Object,
    }
}
</script>

<style>

</style>