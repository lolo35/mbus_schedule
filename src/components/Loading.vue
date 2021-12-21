<template>
    <div class="absolute top-0 bottom-0 left-0 right-0 opacity-50 bg-white z-10">
        
    </div>
    <div class="absolute top-0 bottom-0 left-0 right-0 z-20">
        <div class="flex flex-col w-full h-full items-center justify-center space-y-5">
            <!-- <i class="fas fa-spinner fa-2x animate-spin"></i> -->
            <div class="loader"></div>
            <p class="font-semibold">Alimentam autobuzele...</p>
        </div>
    </div>
</template>

<script>
export default {    
    name: "Loading",
}
</script>

<style scoped>
.loader {
        position: absolute;
        transform: translate(-40%, -40%);
        border: 16px solid #f3f3f3; /* Light grey */
        border-top: 16px solid #3498db; /* Blue */
        border-radius: 50%;
        width: 80px;
        height: 80px;
        animation: spin 2s linear infinite;
      }

      @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }
</style>