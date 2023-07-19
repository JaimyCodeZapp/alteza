<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    products: Object,
});
</script>

<template>
    <Head title="Home" />

    <GuestLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Products
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4"
                >
                    <div
                        v-for="product in products"
                        :key="product.id"
                        class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                    >
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <img
                                :src="product.image_url"
                                :alt="product.name"
                                class="w-[70%] mx-auto"
                            />
                            <h3
                                class="text-center text-xl font-bold tracking-wide"
                            >
                                {{ product.name }}
                            </h3>
                            <div
                                class="flex flex-row gap-4 mt-2 text-3xl justify-center py-2"
                            >
                                <p
                                    :class="[
                                        product.sale_price
                                            ? 'line-through  text-gray-600'
                                            : 'text-white',
                                    ]"
                                >
                                    {{ product.formatted_price }}
                                </p>
                                <p
                                    v-if="product.sale_price"
                                    :class="['text-green-500']"
                                >
                                    {{ product.formatted_sale_price }}
                                </p>
                            </div>
                            <div class="text-center mt-4">
                                <a
                                    :href="product.url"
                                    class="button w-full block"
                                >
                                    More info
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
