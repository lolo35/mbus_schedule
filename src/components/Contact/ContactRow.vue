<template>
    <div class="flex flex-col w-full px-3 py-4 border-t border-b bg-gray-50 shadow">
        <div class="flex flex-row">
            <h5 class="font-semibold">{{ contact.firm }}</h5>
        </div>
        <div class="flex flex-row px-2">
            <p class="text-lg font-bold italic text-gray-700">{{ contact.phone }}</p>
        </div>
    </div>
</template>

<script>
export default {
    name: "ContactRow",
    props: {
        contact: Object,
    }
}
</script>

<style>

</style>