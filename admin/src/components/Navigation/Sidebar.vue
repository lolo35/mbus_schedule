<template>
    <aside class="w-80 h-screen bg-gray shadow-md hidden sm:block">
        <div class="flex flex-col justify-between h-screen p-4 bg-gray-800">
            <div class="text-sm">
                <div class="bg-gray-900 text-white p-2 rounded mt-2 cursor-pointer hover:bg-gray-700 hover:text-blue-300">Releases</div>
                <router-link 
                    to="/routes" 
                >
                    <div 
                        class="bg-gray-900 p-2 rounded mt-2 cursor-pointer hover:bg-gray-700 hover:text-blue-500"
                        :class="$route.name === 'Routes' ? 'text-blue-300' : 'text-white'"
                    >
                        Rute
                    </div>
                </router-link>
            </div>
            <button class="flex p-3 text-white bg-red-500 rounded cursor-pointer text-center text-sm" @click="logout()">
                <div class="rounded inline-flex items-center">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="font-semibold">Logout</span>
                </div>
            </button>
        </div>
    </aside>
</template>

<script>
import Cookies from 'js-cookie';

export default {
    name: "Sidebar",
    data(){
        return {

        }
    },
    methods: {
        async logout(){
            try {
                Cookies.remove('jwt', {path: '/'});
                Cookies.remove('division', {path: '/'});
                this.$router.push('/login');
            } catch (error) {
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