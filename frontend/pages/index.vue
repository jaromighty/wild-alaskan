<template>
    <div class="mt-12 space-y-8">
        <form class="flex items-center max-w-lg mx-auto gap-x-1" @submit.prevent="handleSearch">
            <div>
                <label for="keyword" class="sr-only">Keyword</label>
                <div class="relative w-full">
                    <input type="text" id="keyword" v-model="keyword"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="Search recipes" required/>
                </div>
            </div>
            <div>
                <label for="author" class="sr-only">Author</label>
                <div class="relative w-full">
                    <select id="author" v-model="author"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                        <option value="" disabled selected hidden>Select an author</option>
                        <option v-for="author in authors" :value="author.email" :key="author.email">{{
                                author.email
                            }}
                        </option>
                    </select>
                </div>
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

        <div>
            <RecipeList :recipes="recipes"/>
        </div>

        <div v-if="pagination.total > pagination.per_page">
            <div class="flex justify-between mx-auto max-w-2xl">
                <!-- Previous Button -->
                <a href="#"
                   class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Previous
                </a>

                <!-- Next Button -->
                <a href="#"
                   class="flex items-center justify-center px-3 h-8 ms-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Next
                </a>
            </div>
        </div>
    </div>
</template>

<script setup>
import {ref} from 'vue';

const authors = ref([]);
const pages = ref({
    next: '',
    prev: '',
});
const pagination = ref({
    per_page: 0,
    total: 0,
});
const recipes = ref([]);

const search = ref('');
const keyword = ref('');
const author = ref('');

const getAuthors = async () => {
    try {
        const {data} = await $fetch(`/api/authors`, {
            method: 'GET',
            baseURL: 'http://localhost:8888',
            headers: {
                'Accept': 'application/json',
            },
        });
        authors.value = data;
    } catch (error) {
        console.error('Failed to query authors: ' + error);
    }
}
getAuthors();

const queryRecipes = async () => {
    try {
        const {data, links, meta} = await $fetch(`/api/search?search=${keyword.value}&author=${author.value}`, {
            method: 'GET',
            baseURL: 'http://localhost:8888',
            headers: {
                'Accept': 'application/json',
            },
            data: {search: keyword.value}
        });
        recipes.value = data;
        pages.value = links
        pagination.value = meta;
    } catch (error) {
        console.error('Failed to query recipes: ' + error);
    }
}

const handleSearch = () => {
    queryRecipes();
}
</script>
