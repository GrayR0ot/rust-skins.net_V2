<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-pink-300 leading-tight">
                Users
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="py-3" v-for="user in this.users" v-bind:key="user.id">
                        <div class="p-4 mx-4 bg-gray-200 rounded shadow">
                            <div class="flex sm:justify-between items-center">
                                <div class="flex sm:justify-between items-center">
                                    <img class="object-contain h-20 mt-2 pr-3 rounded" :src="user.profile_photo_url">
                                    <div class="sm:justify-between items-center">
                                        <div class="text-l">#{{ user.id }}</div>
                                        <div class="text-xl">{{ user.name }}</div>
                                        <div>{{ user.email }}</div>
                                        <div>{{ user.orders_count }} order(s)</div>
                                    </div>
                                </div>
                                <a href="#"
                                   class="bg-green-300 text-bg-gray-200 px-2 py-1 text-sm mt-3 inline-block rounded hover:bg-green-500">Check
                                    user</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo'

    export default {
        components: {
            AppLayout,
            JetApplicationLogo
        },
        props: [
            'users',
        ]
    }
</script>
