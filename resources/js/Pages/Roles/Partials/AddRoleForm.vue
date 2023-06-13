<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue'
import { useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { ref } from 'vue'

const nameInput = ref<HTMLInputElement | null>()
const form = useForm({
    name: '',
})
const addRole = () => {
    form.post(route('roles.store'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
            Swal.fire({
                title: 'Success',
                text: 'Added role succesfully',
                icon: 'success',
                timer: 2000,
            })
        },
        onError: () => {
            if(form.errors.name) {
                form.reset('name')
                nameInput.value?.focus()
            }
        }
    })
}
</script>

<template>
    <form class="p-6" @submit.prevent="addRole">
        <h2 class="text-gray-800 dark:text-gray-100">Add role</h2>
        <div>
            <InputLabel value="Name" for="role_name" />
            <TextInput
                id="role_name"
                ref="nameInput"
                v-model="form.name"
                type="text"
                class="mt-1 block w-full"
            />

            <InputError :message="form.errors.name" class="mt-2" />
        </div>
        <PrimaryButton class="mt-2" :disabled="form.processing" type="submit">Save</PrimaryButton>
    </form>
</template>
