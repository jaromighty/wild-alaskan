<script setup lang="ts">
    const route = useRoute();
    const slug = route.params.slug;

    const recipe = ref(null);

    const getRecipe = async () => {
        try {
            const {data} = await $fetch(`/api/recipes/${slug}`, {
                method: 'GET',
                baseURL: 'http://localhost:8888',
                headers: {
                    'Accept': 'application/json',
                },
            });
            recipe.value = data;
        } catch (error) {
            console.error('Failed to query recipe: ' + error);
        }
    }

    onMounted(() => {
        getRecipe();
    });
</script>

<template>
    <div class="relative mt-12 mx-auto max-w-5xl flex flex-col space-y-8">
        <div class="flex">
            <div>
                <h1 class="scroll-m-20 text-4xl font-extrabold tracking-tight text-balance">
                    {{ recipe?.name }}
                </h1>
            </div>
        </div>

        <div class="grid grid-cols-9 gap-12">
            <div class="col-span-3">
                <h2 class="text-2xl font-semibold tracking-tight text-balance">Ingredients</h2>
                <ul role="list" class="mt-4 divide-y divide-gray-100">
                    <li v-for="ingredient in recipe?.ingredients" :key="index" class="py-3">
                        {{ ingredient.description }}
                    </li>
                </ul>
            </div>
            <div class="col-span-6">
                <h2 class="text-2xl font-semibold tracking-tight text-balance">Instructions</h2>
                <ul role="list" class="mt-4 space-y-2">
                    <li v-for="(step, index) in recipe?.steps" :key="index">
                        <div class="relative flex space-x-1">
                            <div>
                                <span
                                    class="flex size-10 items-center justify-center font-semibold text-lg"
                                >
                                    {{ index + 1 }}
                                </span>
                            </div>
                            <div
                                class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                <div>
                                    <p class="text-sm/6 text-gray-800">
                                        {{ step.description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
