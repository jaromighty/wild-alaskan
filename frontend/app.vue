<template>
    <div class="mt-12">
        <form class="flex items-center max-w-lg mx-auto" @submit.prevent="handleSearch">
            <label for="search" class="sr-only">Search</label>
            <div class="relative w-full">
                <input type="text" id="search" v-model="search"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="Search recipes" required/>
            </div>
            <button type="submit"
                    class="inline-flex items-center py-2.5 px-3 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
                Search
            </button>
        </form>

        <div class="mt-8">
            <RecipeList :recipes="recipes" />
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const search = ref('');
const recipes = ref([]);

const queryRecipes = async () => {
    try {
        const {data} = await $fetch(`/api/search?search=${search.value}`, {
            method: 'GET',
            baseURL: 'http://localhost:8888',
            headers: {
                'Accept': 'application/json',
            },
            data: {search: search.value}
        });
        recipes.value = data;
    } catch (error) {
        console.error('Failed to query recipes: ' + error);
    }
}

const handleSearch = () => {
    queryRecipes();
}
</script>
