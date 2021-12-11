<template>
    <div class="flex flex-col items-center justify-center h-screen" id="login">
        <form class="bg-white shadow border px-3 py-1 w-1/4" @submit="login()">
            <div class="flex flex-row justify-center">
                <h5 class="text-lg font-semibold">Transport admin</h5>
            </div>
            <div class="flex flex-row px-3 py-1">
                <div class="flex flex-col w-full">
                    <label for="user" class="text-sm font-semibold text-gray-500">
                        <i class="fas fa-user text-blue-500"></i>
                        Utilizator
                    </label>
                    <input 
                        type="text" 
                        id="user" 
                        class="w-full border-b appearance-none outline-none px-3 py-1" 
                        required 
                        v-model="user"
                        :class="{'border-red-500': error}"
                    >
                </div>
            </div>
            <div class="flex flex-row px-3 py-1 mb-3">
                <div class="flex flex-col w-full">
                    <label for="password" class="text-sm font-semibold text-gray-500">
                        <i class="fas fa-lock text-blue-500"></i>
                        Parola
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        class="w-full border-b appearance-none outline-none px-3 py-1 focus:bg-gray-100" 
                        :class="{'border-red-500': error}" 
                        required 
                        v-model="password"
                    >
                </div>
            </div>
            <div class="flex flex-row px-3 py-1 bg-red-100 justify-center" v-if="error">
                <p class="text-red-600 font-semibold">Utilizator sau parola gresita</p>
            </div>
            <div class="flex flex-row px-3 py-1">
                <button class="bg-indigo-500 text-white px-3 py-1 w-full" type="submit">
                    <i class="fas fa-unlock"></i>
                    Logare
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
import Cookies from 'js-cookie';

export default {
    name: "Login",
    data(){
        return {
            user: "",
            password: "",
            error: false,
        }
    },
    methods: {
        async login(){
            event.preventDefault();
            let formData = new FormData();
            formData.append('api_token', this.$store.state.apiKey);
            formData.append('username', this.user);
            formData.append('password', this.password);
            try {
                const response = await axios.post(`${this.$store.state.url}login`, formData, {headers: {"Content-type": "application/x-www-form-urlencoded"}});
                if(process.env.NODE_ENV === "development"){
                    console.log(response.data);
                }
                if(!response.data.success){
                    if(response.data.error === "login_failed"){
                        this.error = true;
                    }
                }
                if(response.data.success){
                    Cookies.set('jwt', true, { expires: 1, path: '/'});
                    this.$router.push('/');
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
#login {
    background: white;
    background-image: url('../assets/wp2120656.jpg');
    background-size: cover;
}
</style>