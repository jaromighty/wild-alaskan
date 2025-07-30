<script setup lang="ts">
const props = defineProps(['recipes']);
</script>

<template>
    <div class="mx-auto max-w-2xl">
        <ul v-if="recipes.length > 0" role="list" class="border border-gray-200 rounded divide-y divide-gray-200">
            <li v-for="recipe in recipes" :key="recipe.id">
                <NuxtLink :to="`/recipes/${recipe.slug}`" class="block p-4 hover:bg-gray-100">{{ recipe.name }}</NuxtLink>
            </li>
        </ul>
    </div>
</template>
