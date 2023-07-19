<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Checkbox from "@/Components/Checkbox.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
    form: Object,
    submitRoute: Function,
    roles: Object,
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

        <div>
            <InputLabel for="email" value="Email" />

            <TextInput
                id="email"
                type="email"
                class="mt-1 block w-full"
                v-model="form.email"
                required
                autofocus
                autocomplete="email"
            />

            <InputError class="mt-2" :message="form.errors.email" />
        </div>

        <div v-if="form.password !== undefined">
            <InputLabel for="password" value="Password" />

            <TextInput
                id="password"
                type="password"
                class="mt-1 block w-full"
                v-model="form.password"
                required
                autofocus
                autocomplete="password"
            />

            <InputError class="mt-2" :message="form.errors.password" />
        </div>

        <div v-if="form.password_confirmation !== undefined">
            <InputLabel
                for="password_confirmation"
                value="Password confirmation"
            />

            <TextInput
                id="password_confirmation"
                type="password"
                class="mt-1 block w-full"
                v-model="form.password_confirmation"
                required
                autofocus
                autocomplete="password"
            />

            <InputError
                class="mt-2"
                :message="form.errors.password_confirmation"
            />
        </div>

        <div>
            <InputLabel for="roles" value="Roles" />

            <div
                v-for="role in roles"
                :key="role.id"
                class="flex flex-row items-center gap-2 mb-1"
            >
                <Checkbox
                    :id="`role-${role.name}`"
                    v-model="form.roles"
                    :value="role.id"
                />
                <InputLabel :for="`role-${role.name}`" :value="role.name" />
            </div>

            <InputError class="mt-2" :message="form.errors.roles" />
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
