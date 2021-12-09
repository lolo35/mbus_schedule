<template>
    <div class="flex flex-col items-center justify-center h-screen px-3">
        <div class="bg-white shadow border px-3 py-1 w-full">
            <div class="flex flex-row justify-center items-center">
                <img src="../assets/icons8-bus-96.png" alt="">
            </div>
            <form class="flex flex-col space-y-3" @submit="createUser()">
                <div class="flex flex-col w-full">
                    <label for="user" class="font-semibold">
                        <i class="far fa-id-card text-green-500"></i>
                        ID Autoliv
                    </label>
                    <input type="text" class="bg-white border-b appearance-none outline-none w-full px-3 py-1" placeholder="Ex: TRO07513" required v-model="autoliv_id">
                </div>
                <div class="flex flex-col w-full">
                    <label for="password" class="font-semibold">
                        <i class="fas fa-lock text-green-500"></i>
                        Parola
                    </label>
                    <input type="password" class="bg-white border-b appearance-none outline-none w-full px-3 py-1" required v-model="password">
                </div>
                <div class="flex flex-col w-full">
                    <label for="password" class="font-semibold">
                        <i class="fas fa-lock text-green-500"></i>
                        Repeta parola
                    </label>
                    <input type="password" class="bg-white border-b appearance-none outline-none w-full px-3 py-1" required v-model="repeat_password">
                </div>
                <button type="submit" class="bg-indigo-400 text-white w-full px-3 py-1">
                    <i class="fas fa-user-plus"></i>
                    Creaza utilizator
                </button>
            </form>
            <div class="flex flex-row items-center justify-center">
                <p class="text-gray-500">sau</p>
            </div>
            <div class="flex flex-row w-full mb-3">
                <router-link to="/login" class="px-3 py-1 text-white text-center bg-green-500 w-full">
                    <i class="fas fa-sign-out-alt"></i>
                    Logare
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    name: "CreateUser",
    data(){
        return {
            autoliv_id: "",
            password: "",
            repeat_password: "",
        }
    },
    methods: {
        async createUser(){
            event.preventDefault();
            let passCheck = this.checkPassword();
            if(passCheck){
                let formData = new FormData();
                formData.append('api_token', this.$store.state.apiKey);     
                formData.append('autoliv_id', this.autoliv_id.toString().toUpperCase());
                formData.append('password', this.password);
                try {
                    const response = await axios.post(`${this.$store.state.url}createUser`, formData, { headers: {'Content-type': 'application/x-www-form-urlencoded'}});
                    if(process.env.NODE_ENV === "development"){
                        console.log(response.data);
                    }
                    if(response.data.success){
                        Swal.fire({
                            icon: "success",
                            text: "User creat cu success, acum te poti loga",
                            timer: 5000
                        });
                        this.autoliv_id = "";
                        this.password = "";
                        this.repeat_password = "";
                    }
                } catch (error){
                    if(process.env.NODE_ENV === "development"){
                        console.error(error);
                    }
                }
            }
        },
        checkPassword(){
            if(this.password === this.repeat_password){
                return true;
            }
        }
    }
}
</script>

<style>

</style>