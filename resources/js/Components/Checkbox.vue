<script setup>
import { computed, defineEmits } from "vue";
const props = defineProps({
    modelValue: { type: [Array, Boolean] },
    value: { type: [Boolean, Object, String, Number] },
    label: { type: String },
});
const emit = defineEmits(["update:modelValue"]);
const model = computed({
    get() {
        return props.modelValue;
    },
    set(value) {
        emit("update:modelValue", value);
    },
});
</script>
<template>
    <input
        type="checkbox"
        v-model="model"
        :value="value"
        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
    />
</template>
