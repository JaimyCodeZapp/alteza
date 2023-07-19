<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import RatingForm from "@/Components/RatingForm.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";

defineProps({
    product: Object,
});
const product = usePage().props.product;

const form = useForm({
    product_id: product.id,
    rating: "",
    description: "",
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
            <div
                class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-row flex-wrap justify-between"
            >
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-[58%] p-6 text-gray-900 dark:text-gray-100"
                >
                    <img :src="product.image_url" alt="" />
                </div>

                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-[40%] p-6 text-gray-900 dark:text-gray-100"
                >
                    <h1 class="text-3xl uppercase tracking-wide font-bold">
                        {{ product.name }}
                    </h1>
                    <p class="mt-2">{{ product.description }}</p>

                    <div class="flex flex-row gap-4 mt-2 text-3xl">
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
                </div>
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-[100%] p-6 text-gray-900 dark:text-gray-100 mt-5"
                >
                    <h2
                        class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                    >
                        Ratings
                    </h2>
                    <div
                        v-for="rating in product.ratings"
                        :key="rating.id"
                        class="mt-3 border-b border-gray-500 pb-3"
                    >
                        <p>Name: {{ rating.user.name }}</p>
                        <p>Rating: {{ rating.rating }}</p>
                        <p>Description: {{ rating.description }}</p>
                    </div>
                </div>

                <div
                    v-if="$page.props.auth.user"
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-[100%] p-6 text-gray-900 dark:text-gray-100 mt-5"
                >
                    <h2
                        class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                    >
                        Post your Rating
                    </h2>

                    <RatingForm
                        :form="form"
                        :submitRoute="
                            () => {
                                form.post(route('rating.create'));
                            }
                        "
                    />
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
