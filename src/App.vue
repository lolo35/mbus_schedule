<template>
  <div class="flex flex-col h-screen overflow-x-scroll mb-20">
    <router-view/>
  </div>
  <div class="flex flex-row w-full bg-white border px-3 py-3 fixed bottom-0 items-center justify-between" v-if="showNavBar">
    <router-link to="/favorites" title="Favorite">
      <i class="fas fa-heart" :class="$route.name === 'Favorites' ? 'text-blue-500' : 'text-gray-500'"></i>
    </router-link>
    <router-link to="/" title="Rute">
      <i class="fas fa-home" :class="$route.name === 'Home' ? 'text-blue-500' : 'text-gray-500'"></i>
    </router-link>
    <router-link to="/transportPlan" title="Planificare transport">
      <i class="fas fa-bus-alt" :class="$route.name === 'TransportPlan' ? 'text-blue-500': 'text-gray-500'"></i>
    </router-link>
    <router-link to="/transportRules">
      <i class="fas fa-file-alt" :class="$route.name === 'TransportRules' ? 'text-blue-500': 'text-gray-500'"></i>
    </router-link>
    <router-link to="/feedback" title="Sugestii/Reclamatii">
      <i class="fas fa-comments" :class="$route.name === 'Feedback' ? 'text-blue-500': 'text-gray-500'"></i>
    </router-link>
    <router-link to="/contact" title="Contact">
      <i class="fas fa-phone-square-alt" :class="$route.name === 'Contact' ? 'text-blue-500': 'text-gray-500'"></i>
    </router-link>
  </div>
</template>
<script>
import Cookies from 'js-cookie';
import localforage from 'localforage';

export default {
  name: "App",
  data(){
    return {
      
    }
  },
  created(){
    this.setUrl();
    this.checkLoginState();
    this.checkForFavorites();
  },
  methods: {
    async checkForFavorites(){
      const favorites = await localforage.getItem('favoriteRoutes');
      if(!favorites){
        await localforage.setItem('favoriteRoutes', []);
      }
    },
    setUrl(){
      if(process.env.NODE_ENV === "development"){
        this.$store.dispatch('setUrl', "http://localhost:8000/");
      }else{
        this.$store.dispatch('setUrl', "http://3.22.112.39/")
      }
    },
    async checkLoginState(){
      const loginState = Cookies.get('login');
      if(!loginState){
        this.$router.push('/login');
      }
    }
  },
  computed: {
    showNavBar(){
      if(this.$route.name === "login"){
        return false;
      }else if(this.$route.name === "createuser"){
        return false;
      }else{
        return true;
      }
    }
  }
}
</script>
<style>

</style>
