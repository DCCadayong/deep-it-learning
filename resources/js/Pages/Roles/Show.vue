<script setup lang="ts">
import DangerButton from '@/Components/DangerButton.vue'
import Modal from '@/Components/Modal.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Role } from '@/types/models/role'
import { Head, useForm } from '@inertiajs/vue3'
import Swal from 'sweetalert2'
import { ref, inject } from 'vue'

const props = defineProps<{
    role: Role
}>()

// const swal = inject<any>('$swal')
const form = useForm({})

const confirmingRoleDeletion = ref<boolean>(false)
const confirmRoleDeletion = () => {
    confirmingRoleDeletion.value = true
}
const closeModal = () => {
    confirmingRoleDeletion.value = false
}

const deleteRole = () => {
    form.delete(route('roles.destroy', props.role.id), {
        onSuccess: () => Swal.fire({
            title: "Success!",
            icon: "success",
            timer: 2000,
            text: "Deleted role successfully."
        }),
    })

    Swal.fire
}
</script>

<template>
    <Head :title="role.name" />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                View Role
            </h2>
        </template>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-3">
            <div
                class="dark:bg-gray-600 text-gray-800 dark:text-gray-200 px-4 py-2 rounded-md"
            >
                <p class="py-2 ps-1">Name: {{ role.name }}</p>
                <div class="grid grid-cols-2 space-x-2">
                    <PrimaryButton class="col-span-1">Edit</PrimaryButton>
                    <SecondaryButton
                        class="col-span-1"
                        @click="confirmRoleDeletion"
                        >Delete</SecondaryButton
                    >
                </div>
            </div>
        </div>

        <Modal :show="confirmingRoleDeletion" @close="closeModal">
            <div class="p-6">
                <h2
                    class="text-lg font-medium text-gray-900 dark:text-gray-100"
                >
                    Are you sure you want to delete {{ role.name }}?
                </h2>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal">
                        Cancel
                    </SecondaryButton>

                    <DangerButton
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteRole"
                    >
                        Delete Role
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
