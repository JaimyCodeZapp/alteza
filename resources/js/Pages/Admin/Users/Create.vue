<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";
import UserForm from "./Partials/UserForm.vue";
import { hasPermission } from "@/Helpers/permissions";

defineProps({
    roles: Object,
    status: String,
});

const userPermissions = usePage().props.userPermissions;
const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    roles: [],
});

const submit = () => {
    if (hasPermission("edit_users", userPermissions)) {
        form.post(route("register"), {
            onFinish: () => form.reset("password", "password_confirmation"),
        });
    }
};
</script>

<template>
    <Head title="Roles" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Admin / Users
            </h2>
        </template>

        <div class="py-12">
            <a :href="route('dashboard')"></a>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                >
                    <h1 class="text-white text-xl font-bold">
                        Create new user
                    </h1>

                    <UserForm
                        :form="form"
                        :submitRoute="submit"
                        :roles="roles"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
