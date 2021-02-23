<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-pink-300 leading-tight">
                Orders
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="py-3" v-for="order in this.orders" v-bind:key="order.id">
                        <div class="p-4 mx-4 bg-gray-200 rounded shadow">
                            <div class="flex sm:justify-between items-center">
                                <div class="sm:justify-between items-center">
                                    <div class="text-l">#{{ order.id }}</div>
                                    <div class="text-xl">{{ order.user.name }}</div>
                                    <div class="text-xl">{{ order.name }}</div>
                                    <div>{{ order.price }}€</div>
                                </div>
                                <a :href="'/order/' + order.id"
                                   class="bg-green-300 text-bg-gray-200 px-2 py-1 text-sm mt-3 inline-block rounded hover:bg-green-500">Check
                                    order</a>
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
            'orders',
        ]
    }
</script>
