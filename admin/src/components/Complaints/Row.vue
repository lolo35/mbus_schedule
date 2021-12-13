<template>
    <tr>
        <td class="px-6 py-4 whitespace-nowrap"> {{ complaint.autoliv_id }}</td>
        <td class="px-6 py-4 whitespace-nowrap"> {{ complaint.title }}</td>
        <td class="px-6 py-4 whitespace-nowrap"> {{ complaint.complaint }}</td>
        <td class="px-6 py-4 whitespace-nowrap"> {{ complaint.route }}</td>
        <td class="px-6 py-4 whitespace-nowrap"> {{ complaint.created_at }}</td>
    </tr>
</template>

<script>
export default {
    name: "Row",
    props: {
        complaint: Object,
    }
}
</script>

<style>

</style>