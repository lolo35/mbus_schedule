<template>
    <div class="flex flex-col items-center justify-center h-screen px-3">
        <div class="bg-white shadow border px-3 py-1 w-full">
            <div class="flex flex-row justify-center items-center">
                <img src="../assets/icons8-bus-96.png" alt="">
            </div>
            <form class="flex flex-col space-y-3" @submit="loginUser()">
                <div class="flex flex-col w-full">
                    <label for="user" class="font-semibold">
                        <i class="far fa-id-card text-green-500"></i>
                        ID Autoliv
                    </label>
                    <input type="text" class="bg-white border-b appearance-none outline-none w-full px-3 py-1" :class="{'border-red-500': error}" placeholder="Ex: TRO07513" required v-model="autoliv_id">
                </div>
                <div class="flex flex-col w-full">
                    <label for="password" class="font-semibold">
                        <i class="fas fa-lock text-green-500"></i>
                        Parola
                    </label>
                    <input type="password" class="bg-white border-b appearance-none outline-none w-full px-3 py-1" :class="{'border-red-500': error}" required v-model="password">
                </div>
                <div class="flex flex-row bg-red-100">
                    <p class="font-bold text-red-500 px-3 py-1" v-if="error">Utilizator sau parola gresita</p>
                </div>
                <button type="submit" class="text-white px-3 py-1 w-full bg-green-500">
                    <i class="fas fa-sign-out-alt"></i>
                    Logare
                </button>
            </form>
            <div class="flex flex-row items-center justify-center">
                <p class="text-gray-500">sau</p>
            </div>
            <div class="flex flex-row w-full mb-3">
                <router-link to="/createuser" class="bg-indigo-400 w-full px-3 py-1 text-white text-center">
                    <i class="fas fa-user-plus"></i>
                    Creaza utilizator
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Cookies from 'js-cookie';

export default {
    name: "Login",
    data(){
        return {
            autoliv_id: "",
            password: "",
            error: false,
        }
    },
    methods: {
        async loginUser(){
            event.preventDefault();
            let formData = new FormData();
            formData.append('api_token', this.$store.state.apiKey);
            formData.append('autoliv_id', this.autoliv_id.toString().toUpperCase());
            formData.append('password', this.password);
            try {
                const response = await axios.post(`${this.$store.state.url}loginUser`, formData, { headers: {"Content-type": "application/x-www-form-urlencnded"}});
                if(process.env.NODE_ENV === "development"){
                    console.log(response.data);
                }
                if(response.data.success){
                    this.autoliv_id = "";
                    this.password = "";
                    Cookies.set('login', true, {expires: 7, path: '/'});
                    Cookies.set('division', response.data.division, {expires: 7, path: '/'});
                    Cookies.set('user_id', response.data.id, {expires: 7, path: "/"});
                    this.$router.push('/');
                }else{
                    this.error = true;
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