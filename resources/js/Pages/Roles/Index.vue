<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import AddRoleForm from './Partials/AddRoleForm.vue'
import { computed } from 'vue'

interface Role {
    id: number
    name: string
}

const props = defineProps<{
    roles?: Role[]
}>()

const hasRoles = computed(() => {
    return Array.isArray(props.roles) && props.roles?.length > 0
})
</script>

<template>
    <Head title="Roles" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Roles
            </h2>
        </template>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <h1
                class="text-grey-800 dark:text-gray-100 text-center leading-tight font-semibold text-2xl pt-10"
            >
                List of Roles
            </h1>

            <div
                v-if="hasRoles"
                class="space-y-4 p-2 bg-gray-400 dark:bg-gray-700 rounded-md"
            >
                <div
                    class="text-gray-800 flex justify-between dark:text-gray-100 bg-white dark:bg-gray-800 p-4 rounded-md"
                    v-for="{ id, name } in roles"
                    :key="id"
                >
                    <p>Name: {{ name }}</p>
                    <Link
                        :href="route('roles.show', id)"
                        class="bg-gray-400 dark:bg-gray-500 text-gray-800 dark:text-gray-100 px-2 py-1 rounded-md hover:text-gray-200 hover:bg-gray-700 dark:hover:bg-gray-600 dark:hover:text-gray-300"
                    >
                        View
                    </Link>
                </div>
            </div>
            <div v-else>
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        There are no roles
                    </div>
                </div>
            </div>
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
            >
                <AddRoleForm />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
