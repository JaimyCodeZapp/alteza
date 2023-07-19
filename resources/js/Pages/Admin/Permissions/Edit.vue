<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";
import PermissionsForm from "./Partials/PermissionForm.vue";
import DeletePermissionForm from "./Partials/DeletePermissionForm.vue";
import { hasPermission } from "@/Helpers/permissions";

defineProps({
    permission: Object,
    status: String,
});

const userPermissions = usePage().props.userPermissions;
const permission = usePage().props.permission;

const form = useForm({
    name: permission.name,
    id: permission.id,
});
</script>

<template>
    <Head title="Permission" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Admin / Permission
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                >
                    <h1 class="text-white text-xl font-bold">
                        Edit permission "{{ permission.name }}"
                    </h1>

                    <PermissionsForm
                        :form="form"
                        :submitRoute="
                            () => {
                                if (
                                    hasPermission(
                                        'edit_permissions',
                                        userPermissions
                                    )
                                ) {
                                    form.patch(route('permissions.update'));
                                }
                            }
                        "
                    />
                </div>

                <div
                    v-if="hasPermission('edit_permissions', userPermissions)"
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                >
                    <DeletePermissionForm :permission="permission" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
