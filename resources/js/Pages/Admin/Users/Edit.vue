<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";
import UserForm from "./Partials/UserForm.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
import { hasPermission } from "@/Helpers/permissions";

defineProps({
    user: Object,
    userRoles: Object,
    roles: Object,
});

const user = usePage().props.user;
const userPermissions = usePage().props.userPermissions;

const form = useForm({
    id: user.id,
    name: user.name,
    email: user.email,
    roles: user.roles ? user.roles.map((rule) => rule.id) : [],
});
</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Admin / Users
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                >
                    <h1 class="text-white text-xl font-bold">
                        Edit user "{{ user.name }}"
                    </h1>
                    <UserForm
                        :form="form"
                        :user="user"
                        :roles="roles"
                        :submitRoute="
                            () => {
                                if (
                                    hasPermission('edit_users', userPermissions)
                                ) {
                                    form.patch(route('users.update'));
                                }
                            }
                        "
                    />
                </div>

                <div
                    v-if="hasPermission('edit_users', permissions)"
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                >
                    <DeleteUserForm :user="user" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
