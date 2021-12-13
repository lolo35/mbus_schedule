<template>
    <div class="flex flex-col">
        <Table v-if="showComplaints" />
    </div>
</template>

<script>
import Cookies from 'js-cookie';
import axios from 'axios';
import Table from '../components/Complaints/Table.vue';

export default {
    name: "Complaints",
    data(){
        return {
            showComplaints: false,
        }
    },
    components: {
        Table,
    },
    created(){
        this.fetchComplaints();
    },
    methods: {
        async fetchComplaints(){
            let division = Cookies.get('division', {path: "/"});
            let params = `?api_token=${this.$store.state.apiKey}&division=${division}`;
            try {
                const response = await axios.get(`${this.$store.state.url}complaints${params}`);
                if(process.env.NODE_ENV === "development"){
                    console.log(response.data);
                }
                if(response.data.success) {
                    this.$store.dispatch('complaints/setComplaints', response.data.complaints);
                    this.showComplaints = true;
                }
            } catch (error){
                if(process.env.NODE_ENV === "development"){
                    console.error(error);
                }
            }
        }
    }
}
</script>

<style>

</style>