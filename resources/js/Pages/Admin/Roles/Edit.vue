<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";
import RoleForm from "./Partials/RoleForm.vue";
import DeleteRoleForm from "./Partials/DeleteRoleForm.vue";
import { hasPermission } from "@/Helpers/permissions";

defineProps({
    role: Object,
    permissions: Object,
    status: String,
});

const role = usePage().props.role;
const userPermissions = usePage().props.userPermissions;

const form = useForm({
    name: role.name,
    permissions: role.permissions
        ? role.permissions.map((role) => role.id)
        : [],
    id: role.id,
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
                        Edit role "{{ role.name }}"
                    </h1>
                    <RoleForm
                        :form="form"
                        :permissions="permissions"
                        :submitRoute="
                            () => {
                                if (
                                    hasPermission('edit_roles', userPermissions)
                                ) {
                                    form.patch(route('roles.update'));
                                }
                            }
                        "
                    />
                </div>

                <div
                    v-if="hasPermission('edit_roles', userPermissions)"
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                >
                    <DeleteRoleForm :role="role" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
