a<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Pagination from "@/Components/Pagination.vue";
import {ref, watch} from "vue";
import { router } from '@inertiajs/vue3'
import Swal from "sweetalert2";

const props = defineProps({
    contacts : {
        type: Object,
        required: true
    },
    filters : Object
});

const form = useForm({});

const removeContact = (contact,index) => {
    Swal.fire({
        icon: "warning",
        title: 'Are you sure you want to DELETE?',
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes, I am sure!',
        cancelButtonText: "No, cancel it!"
    }).then(
        function (result) {
            if (result['isConfirmed']){

                form.delete(route('contacts.destroy',{contact:contact.id}), {
                    onSuccess: (response) => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Contact has been removed!',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        props.contacts.data.splice(index,0);
                    },onError: (error) => {
                        console.log(error)
                    }
                });
            }
        },
        function () { return false; });
}

let search = ref(props.filters.search);

watch(search, value => {
    router.get(
        '/contacts',{...(value !== "" ? { search: value } : null)},{
            preserveState: true,
            replace: true
        })
});

const resetFilters = () => {
    search.value = ''; // or some default value
}

</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Contacts</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-2">
                <div class="flex justify-between ">
                    <div class="space-x-2">
                        <input v-model="search"
                               type="text"
                               placeholder="Search..."
                               class="border-none  shadow-sm px-2 rounded-lg"/>

                        <button @click="resetFilters()"
                                class="bg-white px-4 py-3 text-sm leading-4 shadow rounded-lg hover:bg-indigo-600 hover:text-white dark:hover:bg-gray-700 dark:hover:text-white">
                            Reset Filters
                        </button>

                    </div>

                    <Link :href="route('contacts.create')"
                          class="bg-white px-4 py-3 text-sm leading-4 shadow rounded-lg hover:bg-indigo-600 hover:text-white dark:hover:bg-gray-700 dark:hover:text-white"
                          preserve-scroll>
                        Add Contact
                    </Link>
                </div>

                <div class="bg-white shadow rounded-lg p-1.5">
                    <table
                        class="w-full text-sm text-left lg:overflow-auto overflow-x-scroll"
                    >
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50"
                        >
                        <tr>
                            <th scope="col" class="uppercase px-6 py-3">Name</th>
                            <th scope="col" class="uppercase px-6 py-3">Company</th>
                            <th scope="col" class="uppercase px-6 py-3">Phone</th>
                            <th scope="col" class="uppercase px-6 py-3">Email</th>
                            <th scope="col" class="uppercase px-6 py-3">Action</th>
                        </tr>


                        </thead>
                        <tbody>
                        <tr
                            class="bg-white border-b odd:bg-white even:bg-gray-50"
                            v-for="(contact,index) in contacts.data"
                            :key="contact.id"
                        >
                            <td class="px-6 py-4">
                                {{ contact.name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ contact.company }}
                            </td>
                            <td class="px-6 py-4">
                                {{ contact.phone }}
                            </td>
                            <td class="px-6 py-4">
                                {{ contact.email }}
                            </td>


                            <td class="px-6 py-4 space-x-2">
                                <Link class="text-yellow-500 " :href="route('contacts.edit',{contact:contact.id})">
                                    Edit
                                </Link>

                                <button @click="removeContact(contact,index)" class="text-red-500">Delete</button>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>

                <Pagination :links="contacts.meta.links" />
            </div>
        </div>
    </AuthenticatedLayout>

    <div class="text-red-800 bg-red-300 text-green-800
    bg-green-300 underline animate-ping">

    </div>
</template>
