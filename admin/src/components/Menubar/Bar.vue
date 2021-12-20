<template>
    <div class="flex flex-row bg-gray-900 py-1 px-3 rounded space-x-2 justify-between">
        <div class="flex flex-row">
            <button 
                title="Adauga ruta" 
                class="text-white bg-gray-700 rounded-full w-8 h-8 hover:bg-gray-800"
                @click="$store.dispatch('routes/setModalIsOpen', true)"
            >
                <i class="fas fa-plus"></i>
            </button>
        </div>
        <div class="flex flex-row space-x-2 items-center">
            <div class="flex flex-row space-x-2">
                <button class="text-blue-500 hover:text-blue-700" @click="$store.dispatch('routes/decPageNumber')">
                    <i class="fas fa-chevron-circle-left"></i>
                </button>
                <p class="text-white">
                    {{ this.currentPage }} / {{ this.totalPages }}
                </p>
                <button class="text-blue-500 hover:text-blue-700" @click="$store.dispatch('routes/incPageNumber')">
                    <i class="fas fa-chevron-circle-right"></i>
                </button> 
            </div>
            <input type="text" class="bg-white px-3 py-1 border-b" placeholder="Cautare..." v-model="searchTerm">
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    name: "Bar",
    computed: {
        searchTerm: {
            get(){
                return this.$store.state.routes.searchTerm;
            },
            set(value){
                this.$store.dispatch('routes/setSearchTerm', value);
            }
        },
        ...mapGetters("routes", [
            'currentPage',
            'totalPages'
        ]),
    }
}
</script>

<style>

</style>