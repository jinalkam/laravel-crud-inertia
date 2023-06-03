<script setup>
import { onMounted, ref } from 'vue';
import VueTailwindDatepicker from 'vue-tailwind-datepicker'
defineProps({
    modelValue: {
        type: String,
        required: true,
    },
});
const dateValue = ref([])
defineEmits(['update:modelValue']);

</script>

<template>
    <input type="date"  :value="modelValue" 
        @input="$emit('update:modelValue', $event.target.value)">
 

</template>
