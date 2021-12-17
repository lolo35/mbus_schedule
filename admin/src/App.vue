<template>
  <router-view/>
</template>
<script>

export default {
  name: "App",
  created(){
    this.setUrl();
  },
  methods: {
    setUrl(){
      if(process.env.NODE_ENV === "development"){
        this.$store.dispatch('setUrl', "http://localhost:8000/admin/");
      }else{
        this.$store.dispatch('setUrl', "http://3.22.112.39/admin/");
      }
    },
  },
  computed: {
    
  }
}
</script>
<style>

</style>
