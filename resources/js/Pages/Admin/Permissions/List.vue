<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import { hasPermission } from "@/Helpers/permissions";

const userPermissions = usePage().props.userPermissions;

defineProps({
    permissions: Object,
    status: String,
});
</script>

<template>
    <Head title="Permissions" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Admin / Permissions
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                >
                    <a
                        v-if="
                            hasPermission('edit_permissions', userPermissions)
                        "
                        :href="route('permissions.create')"
                        class="button"
                        >Create new permissions</a
                    >
                    <div v-if="permissions.length > 0" class="mt-4">
                        <table class="table-auto text-white w-full text-left">
                            <thead>
                                <tr class="border-b border-gray-500">
                                    <th class="py-2 px-4">Name</th>
                                    <th class="py-2 px-4"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(permission, index) in permissions"
                                    :key="index"
                                    class="border-b border-gray-500"
                                >
                                    <td class="py-2 px-4">
                                        {{ permission.name }}
                                    </td>
                                    <td class="py-2 px-4 text-right">
                                        <a
                                            :href="
                                                route('permissions.edit', {
                                                    id: permission.id,
                                                })
                                            "
                                            class="text-red-500"
                                            >Edit</a
                                        >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
