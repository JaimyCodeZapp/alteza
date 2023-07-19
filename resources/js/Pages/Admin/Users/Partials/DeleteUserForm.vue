<script setup>
import DangerButton from "@/Components/DangerButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { ref } from "vue";

const confirmingUserDeletion = ref(false);

defineProps({
    user: Object,
});

const id = usePage().props.user.id;

const form = useForm({
    id: id,
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;
};

const deleteUser = () => {
    form.delete(route("user.destroy", { id: id }), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Delete user
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Once this user is deleted, all of its resources and data will be
                permanently deleted. Before deleting a user, please download any
                data or information that you wish to retain.
            </p>
        </header>

        <DangerButton @click="confirmUserDeletion">Delete User</DangerButton>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6">
                <h2
                    class="text-lg font-medium text-gray-900 dark:text-gray-100"
                >
                    Are you sure you want to delete this user?
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Once this User is deleted, all of its resources and data
                    will be permanently deleted. Before deleting a user, please
                    download any data or information that you wish to retain.
                </p>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal">
                        Cancel
                    </SecondaryButton>

                    <DangerButton
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Delete User
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
