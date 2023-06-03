<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import CompanyForm from './Partials/CompanyForm.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { useForm, Head } from '@inertiajs/vue3';
import {  ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import moment from 'moment';
const props = defineProps({
    companies: {
        type: Object,
        default: () => ({}),
    },
    message: {
        type: String
    }

});

const showModal = ref(false);
const showNotif = ref(false)
const form = ref();

// add company data
const addCompany = () => {
    form.value = useForm({
        name: '',
        established_date: '',
        confirmed: false
    });
    showModal.value = true;
};


// edit company data
const editCompany = (company) => {
    form.value = useForm({
        name: company.name,
        established_date: company.established_date,
        confirmed: company.confirmed,
        id: company.id,
    });
    showModal.value = true;
};


const closeModal = () => {
    showModal.value = false;
    form.value.reset();
    
};

const onSuccessModal = () => {
    closeModal()
    showNotif.value = true;
    setTimeout(() => {
        showNotif.value = false;
    }, 7000);
};


</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Companies
            </h2>
        </template>
        <CompanyForm class="max-w-xl" :showModal="showModal" :form="form" @onModelClose="closeModal" @onSuccess="onSuccessModal" />
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                
                <div v-if="$page.props.flash?.success && showNotif"
                    class="transition  ease-in-out delay-150 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                    role="alert">
                    <span class="font-medium">
                        {{ $page.props.flash.success }}
                    </span>
                </div>
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-2 block">
                            <div class="py-4 sm:py-8">
                                <PrimaryButton @click="addCompany">Add Company</PrimaryButton>

                            </div>
                        </div>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">


                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">#</th>
                                        <th scope="col" class="px-6 py-3">
                                            Company Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Established Date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Confirmed
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Edit
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Delete
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="company in companies" :key="company.id"
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            {{ company.id }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            {{ company.name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ moment((company.established_date)).format('DD/MM/YYYY') }}
                                        
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ company.confirmed }}
                                        </td>

                                        <td class="px-6 py-4">
                                            <SecondaryButton @click="editCompany(company)"> Edit </SecondaryButton>
                                        </td>
                                        <td class="px-6 py-4">
                                      
                                        <Link as="button" :href="route('companies.destroy', company.id)" method="delete">
                                            <DangerButton >
                                                Delete
                                            </DangerButton>
                                            </Link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
