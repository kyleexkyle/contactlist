a<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Swal from "sweetalert2";
import {Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    data : {
        type: Object,
        required: true
    }
});

const form = useForm({
    name: props.data.contact.name,
    company: props.data.contact.company,
    phone: props.data.contact.phone,
    email: props.data.contact.email,
});

const submit = () => {
    form.transform(data => ({
        ...data,
    })).patch(route('contacts.update',{contact:props.data.contact.id}), {
        onSuccess: () => {
            form.reset()

            Swal.fire({
                icon: 'success',
                title: 'Contact has been updated!',
                showConfirmButton: false,
                timer: 1500
            });
        },onError: (error) => {
            console.log(error)
        }
    });
};
</script>

<template>
    <Head title="Create Task" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Task</h2>
        </template>

        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">

                    <InputLabel for="title" value="Create Task" />
                    <form @submit.prevent="submit" class="mt-6 space-y-6">
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
                            <InputLabel for="company" value="Company" />

                            <TextInput
                                id="company"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.company"
                                required
                            />

                            <InputError class="mt-2" :message="form.errors.company" />
                        </div>

                        <div>
                            <InputLabel for="phone" value="Phone" />

                            <TextInput
                                id="phone"
                                type="tel"
                                class="mt-1 block w-full"
                                v-model="form.phone"
                                required
                            />

                            <InputError class="mt-2" :message="form.errors.phone" />
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
                                autocomplete="title"
                            />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="flex items-center gap-4">
                            <PrimaryButton :disabled="form.processing">Submit</PrimaryButton>

                            <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                            </Transition>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
