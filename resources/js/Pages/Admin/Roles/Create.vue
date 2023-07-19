<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";
import RoleForm from "./Partials/RoleForm.vue";
import { hasPermission } from "@/Helpers/permissions";

defineProps({
    status: String,
    permissions: Object,
});

const userPermissions = usePage().props.userPermissions;
const form = useForm({
    name: "",
    permissions: [],
});
</script>

<template>
    <Head title="Roles" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Admin / Roles
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                >
                    <h1 class="text-white text-xl font-bold">
                        Create new role
                    </h1>

                    <RoleForm
                        :form="form"
                        :permissions="permissions"
                        :submitRoute="
                            () => {
                                if (
                                    hasPermission('edit_roles', userPermissions)
                                ) {
                                    form.post(route('roles.insert'));
                                }
                            }
                        "
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
