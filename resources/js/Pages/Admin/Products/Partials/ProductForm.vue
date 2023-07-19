<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Checkbox from "@/Components/Checkbox.vue";
import TextInput from "@/Components/TextInput.vue";
import Textarea from "@/Components/Textarea.vue";
import { ref } from "vue";

defineProps({
    form: Object,
    submitRoute: Function,
});

const imageInput = ref(null);

const onFileChange = (form) => {
    const file = imageInput.value.files[0];
    if (file) {
        form.image = file;
        form.previewImage = URL.createObjectURL(file);
    } else {
        form.image = {};
        form.previewImage = "";
    }
};
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
            <InputLabel for="slug" value="Slug" />

            <TextInput
                id="slug"
                type="text"
                class="mt-1 block w-full"
                v-model="form.slug"
                required
                autofocus
                autocomplete="slug"
            />

            <InputError class="mt-2" :message="form.errors.slug" />
        </div>

        <div>
            <InputLabel for="description" value="Description" />

            <Textarea
                id="description"
                type="text"
                class="mt-1 block w-full"
                v-model="form.description"
                required
                autofocus
                autocomplete="description"
            />

            <InputError class="mt-2" :message="form.errors.description" />
        </div>

        <div>
            <InputLabel for="price" value="Price" />

            <TextInput
                id="price"
                type="number"
                class="mt-1 block w-full"
                v-model="form.price"
                required
                autofocus
                autocomplete="price"
            />

            <InputError class="mt-2" :message="form.errors.price" />
        </div>

        <div>
            <InputLabel for="sale_price" value="Sale Price" />

            <TextInput
                id="sale_price"
                type="number"
                class="mt-1 block w-full"
                v-model="form.sale_price"
                autofocus
                autocomplete="sale_price"
            />

            <InputError class="mt-2" :message="form.errors.sale_price" />
        </div>

        <div>
            <InputLabel for="image" value="Image" />

            <input
                id="image"
                type="file"
                class="mt-1 block w-full py-2 px-3 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                autofocus
                ref="imageInput"
                @change="onFileChange(form)"
                autocomplete="image"
            />

            <img
                class="w-[200px] mt-4 py-2 px-3 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                :src="form.previewImage"
                alt=""
            />

            <InputError class="mt-2" :message="form.errors.image" />
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
