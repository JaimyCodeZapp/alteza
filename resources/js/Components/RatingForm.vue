<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Textarea from "@/Components/Textarea.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
    form: Object,
    submitRoute: Function,
});
</script>

<template>
    <form @submit.prevent="submitRoute()" class="mt-6 space-y-6">
        <input type="hidden" name="product_id" v-model="form.product_id" />

        <div>
            <InputLabel for="rating" value="Rating" />

            <TextInput
                id="rating"
                type="number"
                class="mt-1 block w-full"
                v-model="form.rating"
                required
                autocomplete="rating"
            />

            <InputError class="mt-2" :message="form.errors.rating" />
        </div>

        <div>
            <InputLabel for="description" value="Description" />

            <Textarea
                id="description"
                class="mt-1 block w-full"
                v-model="form.description"
                required
                autocomplete="description"
            />

            <InputError class="mt-2" :message="form.errors.description" />
        </div>

        <PrimaryButton :disabled="form.processing">Post</PrimaryButton>

        <Transition
            enter-from-class="opacity-0"
            leave-to-class="opacity-0"
            class="transition ease-in-out"
        >
            <p
                v-if="form.recentlySuccessful"
                class="text-sm text-gray-600 dark:text-gray-400"
            >
                Posted.
            </p>
        </Transition>
    </form>
</template>
