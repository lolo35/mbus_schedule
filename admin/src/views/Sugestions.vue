<template>
    <div class="flex flex-col">
        <Table v-if="showSugestions"/>
    </div>
</template>

<script>
import Cookies from 'js-cookie';
import axios from 'axios';
import Table from '../components/Sugestions/Table.vue';

export default {
    name: "Sugestions",
    data(){
        return {
            showSugestions: false,
        }
    },
    components: {
        Table,
    },
    created(){
        this.fetchSugestions();
    },
    methods: {
        async fetchSugestions(){
            let division = Cookies.get('division', { path: '/'});
            let params = `?api_token=${this.$store.state.apiKey}&division=${division}`;

            try {
                const response = await axios.get(`${this.$store.state.url}sugestions${params}`);
                if(process.env.NODE_ENV === "development"){
                    console.log(response.data);
                }
                if(response.data.success){
                    this.$store.dispatch('sugestions/setSugestions', response.data.sugestions);
                    this.showSugestions = true;
                }
            } catch (error){
                if(process.env.NODE_ENV === "development"){
                    console.log(error);
                }
            }
        }
    }
}
</script>

<style>

</style>