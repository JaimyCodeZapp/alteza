<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
    form: Object,
    submitRoute: Function,
});
</script>

<template>
    <form @submit.prevent="submitRoute()" class="mt-6 space-y-6">
        <input type="hidden" name="id" v-model="form.id" />

        <div>
            <InputLabel for="name" value="Name" />

            <TextInput
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.name"
                required
                autofocus
                autocomplete="name"
            />

            <InputError class="mt-2" :message="form.errors.name" />
        </div>

        <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

        <Transition
            enter-from-class="opacity-0"
            leave-to-class="opacity-0"
            class="transition ease-in-out"
        >
            <p
                v-if="form.recentlySuccessful"
                class="text-sm text-gray-600 dark:text-gray-400"
            >
                Saved.
            </p>
        </Transition>
    </form>
</template>
