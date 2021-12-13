<template>
    <tr>
        <td class="px-6 py-4 whitespace-nowrap">{{ sugestions.autoliv_id }}</td>
        <td class="px-6 py-4 whitespace-nowrap">{{ sugestions.title }}</td>
        <td class="px-6 py-4 whitespace-nowrap">{{ sugestions.sugestion }}</td>
        <td class="px-6 py-4 whitespace-nowrap">{{ sugestions.route }}</td>
        <td class="px-6 py-4 whitespace-nowrap">{{ sugestions.created_at }}</td>
    </tr>
</template>

<script>
export default {
    name: "Row",
    data(){
        return {

        }
    },
    props: {
        sugestions: Object,
    }
}
</script>

<style>

</style>