<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-pink-300 leading-tight">
                Products
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <a href="/product/new"
                       class="p-8 mx-4 flex bg-green-300 text-bg-gray-200 px-2 py-1 mb-4 text-sm mt-3 inline-block rounded hover:bg-green-500">New product</a>
                    <div class="py-3" v-for="product in this.products" v-bind:key="product.id">
                        <div class="p-4 mx-4 bg-gray-200 rounded shadow">
                            <div class="flex sm:justify-between items-center">
                                <img class="object-contain h-20 mt-2 pr-3 rounded" :src="product.picture_path">
                                <div class="sm:justify-between items-center">
                                    <div class="text-l">#{{ product.id }}</div>
                                    <div class="text-xl">{{ product.name }}</div>
                                    <div>{{ product.price }}€</div>
                                </div>
                                <a :href="'/product/' + product.id"
                                   class="bg-green-300 text-bg-gray-200 px-2 py-1 text-sm mt-3 inline-block rounded hover:bg-green-500">Check
                                    product</a>
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
            'products',
        ]
    }
</script>
