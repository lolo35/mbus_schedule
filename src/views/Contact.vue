<template>
    <div class="flex flex-col py-2">
        <div class="flex flex-row justify-center">
            <h4 class="font-bold text-lg text-gray-800">Contact urgente</h4>
        </div>
        <div class="flex flex-row justify-center">
            <p class="font-semibold text-sm text-gray-500">Pentru orice intarzieri/urgente</p>
        </div>
    </div>
    <div v-if="showContacts">
        <contact-row v-for="contact in contact" :key="contact.id" :contact="contact"></contact-row>
    </div>
</template>

<script>
import localforage from 'localforage';
import axios from 'axios';
import ContactRow from '../components/Contact/ContactRow.vue';

export default {
    name: "Contact",
    data(){
        return {
            contact: [],
            showContacts: false,
        }
    },
    components: {
        ContactRow,
    },
    created(){
        this.getContact();
    },
    methods: {
        async getContact(){
            let division = await localforage.getItem('division');
            let url = `${this.$store.state.url}contact?api_token=${this.$store.state.apiKey}&division=${division}`;
            try {
                const response = await axios.get(url);
                if(process.env.NODE_ENV === "development"){
                    console.log(response.data);
                }
                if(response.data.success){
                    this.contact = response.data.data;
                    this.showContacts = true;
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