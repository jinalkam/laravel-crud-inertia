<script setup>
import Modal from '@/Components/Modal.vue';
import TextInput from '@/Components/TextInput.vue';
import ToggleSwitch from '@/Components/ToggleSwitch.vue';
import DateInput from '@/Components/DateInput.vue';
import { computed } from 'vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    showModal: {
        type: Boolean,
    },
    form: {
        type:Object
    }

});

const emit = defineEmits(['onModelClose', 'onSuccess']);
const headerTitle = computed(() => !props.form.id ? 'Add Company' : 'Edit Company');

const submit = () => {
    if(props.form.id) {
        props.form.put(route("companies.update", props.form.id),{
        preserveScroll: true,
        onSuccess: () =>  emit('onSuccess'),

    });
    }else {
      props.form.post(route("companies.store"),{
        preserveScroll: true,
        onSuccess: () =>  emit('onSuccess'),
    });
     }
};



</script>

<template>
    <section class="">

        <Modal :show="showModal" @close="emit('onModelClose')">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                   
                  <h2 class="text-lg font-medium text-gray-900">{{ headerTitle }}</h2>
                    
                    <div class="py-12">
                        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                            <div class="shadow-sm sm:rounded-lg">
                                <div class="p-6 border-b border-gray-200"> 
                                    <form @submit.prevent="submit">
                                        <div class="mb-6">
                                            <label for="Name"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Company Name</label>
                                                <TextInput
                                                id="name"
                                                type="text"
                                                class="mt-1 block w-full"
                                                v-model="form.name"
                                                
                                                />
                                            <div v-if="form.errors.name" class="text-sm text-red-600">
                                                {{ form.errors.name }}
                                            </div>
                                        </div>
                                        <div class="mb-6">
                                            
                                            <label for="Established Date"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Established Date</label>
                                               
                                                <DateInput
                                                id="established_date"
                                                class="mt-1 block w-full"
                                                v-model="form.established_date"
                                                
                                                />
                                            <div v-if="form.errors.established_date" class="text-sm text-red-600">
                                                {{ form.errors.established_date }}
                                            </div>
                                        </div>
                                        <div class="mb-6">
                                            <label for="slug"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Confirmed</label>
                                               
                                               
                                                <ToggleSwitch
                                                
                                                v-model:checked="form.confirmed"
                                                id="confirmed"
                                                class="mt-1 block w-full"
                                                
                                                
                                                />
                                            <div v-if="form.errors.confirmed" class="text-sm text-red-600">
                                                {{ form.errors.confirmed }}
                                            </div>
                                        </div>
                                        <button type="submit"
                                            class="text-white bg-blue-700  focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 "
                                            :disabled="form.processing" :class="{ 'opacity-25': form.processing }">
                                            Submit
                                        </button>
                                    </form>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </Modal>
    </section>
</template>
