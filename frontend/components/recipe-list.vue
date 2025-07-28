<script setup lang="ts">
const props = defineProps(['recipes']);
</script>

<template>
    <div class="mx-auto max-w-2xl">
        <ul v-if="recipes.length > 0" role="list" class="border border-gray-200 rounded divide-y divide-gray-200">
            <li v-for="recipe in recipes" :key="recipe.id" class="p-4">
                <p>{{ recipe.name }}</p>
            </li>
        </ul>
    </div>
</template>
