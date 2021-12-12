<template>
    <div class="flex flex-row px-3 items-center justify-between">
        <p class="text-sm font-bold text-gray-500 italic">Schimbul {{ schedule.shift }}:</p>
        <p class="text-sm font-bold text-gray-500">{{ schedule.tur }}</p>
    </div>
</template>

<script>
export default {
    name: "Schedule",
    props: {
        schedule: Object,
    }
}
</script>

<style>

</style>