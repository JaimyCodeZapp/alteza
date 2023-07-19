<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";
import ProductForm from "./Partials/ProductForm.vue";
import DeleteProductForm from "./Partials/DeleteProductForm.vue";
import { hasPermission } from "@/Helpers/permissions";

defineProps({
    product: Object,
    status: String,
});

const product = usePage().props.product;
const userPermissions = usePage().props.userPermissions;

const form = useForm({
    id: product.id,
    name: product.name,
    slug: product.slug,
    description: product.description,
    price: product.price,
    sale_price: product.sale_price,
    image: {},
    previewImage: product.image_url,
});
</script>

<template>
    <Head title="Products" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Admin / Products
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                >
                    <h1 class="text-white text-xl font-bold">
                        Edit product "{{ product.name }}"
                    </h1>
                    <ProductForm
                        :form="form"
                        :submitRoute="
                            () => {
                                if (
                                    hasPermission(
                                        'edit_products',
                                        userPermissions
                                    )
                                ) {
                                    form.post(route('products.update'));
                                }
                            }
                        "
                    />
                </div>

                <div
                    v-if="hasPermission('edit_products', userPermissions)"
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                >
                    <DeleteProductForm :product="product" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
