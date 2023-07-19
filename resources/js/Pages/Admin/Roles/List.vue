<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import { hasPermission } from "@/Helpers/permissions";

const userPermissions = usePage().props.userPermissions;

defineProps({
    roles: Object,
    status: String,
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
                    <a
                        v-if="hasPermission('edit_roles', userPermissions)"
                        :href="route('roles.create')"
                        class="button"
                        >Create new role</a
                    >
                    <div v-if="roles.length > 0" class="mt-4">
                        <table class="table-auto text-white w-full text-left">
                            <thead>
                                <tr class="border-b border-gray-500">
                                    <th class="py-2 px-4">Name</th>
                                    <th class="py-2 px-4"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(role, index) in roles"
                                    :key="index"
                                    class="border-b border-gray-500"
                                >
                                    <td class="py-2 px-4">{{ role.name }}</td>
                                    <td class="py-2 px-4 text-right">
                                        <a
                                            :href="
                                                route('roles.edit', {
                                                    id: role.id,
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
