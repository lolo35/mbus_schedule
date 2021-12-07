<template>
  <div class="flex flex-col h-screen overflow-x-scroll">
    <router-view/>
  </div>
  <div class="flex flex-row w-full bg-white border px-3 py-3 fixed bottom-0 items-center justify-between">
    <router-link to="/favorites" title="Favorite">
      <i class="fas fa-heart" :class="$route.name === 'favorites' ? 'text-blue-500' : 'text-gray-500'"></i>
    </router-link>
    <router-link to="/">
      <i class="fas fa-home" :class="$route.name === 'Home' ? 'text-blue-500' : 'text-gray-500'"></i>
    </router-link>
  </div>
</template>
<script>
export default {
  name: "App",
}
</script>
<style>

</style>
