<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-pink-300 leading-tight">
                Home
            </h2>
        </template>

        <div class="py-12 bg-gray-700">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="holder mx-auto w-10/12 grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-4">
                        <div class="py-3 rounded-b-full" v-for="product in this.products" v-bind:key="product.id">
                            <div class="each mb-10 m-2 shadow-lg border-gray-800 bg-gray-700 relative h-full rounded-md">
                                <a :href="'/product/buy/' + product.id">
                                    <img class="w-full hover:opacity-75" :src="product.picture_path"
                                         :alt="product.name"/>
                                </a>
                                <div v-if="product.discount == 0"
                                     class="badge absolute top-0 right-0 bg-purple-400 m-1 text-gray-200 p-1 px-2 text-xs font-bold rounded">
                                    {{ product.price }}€
                                </div>
                                <div v-if="product.discount != 0"
                                     class="badge absolute top-0 right-0 bg-purple-400 m-1 text-gray-200 p-1 px-2 text-xs font-bold rounded">
                                    <div class="flex flex-wrap">
                                        <div class="line-through"> {{ product.price }}€</div>
                                        <div class="pl-1">{{ product.price-(product.price*(product.discount/100)) }}€</div>
                                    </div>
                                </div>
                                <div class="ml-2 mr-2 info-box text-xs flex p-1 font-semibold text-gray-500 bg-white rounded-md">
                                    <span class="mr-1 p-1 px-2 font-bold">{{ product.orders_count }} Purchase(s)</span>
                                    <span class="mr-1 p-1 px-2 font-bold border-l border-gray-400">{{ product.pending_orders_count }} Being bought</span>
                                    <span class="mr-1 p-1 px-2 font-bold border-l border-gray-400">{{ product.likes_count }} Like(s)</span>
                                    <span class="mr-1 p-1 px-2 font-bold border-l border-gray-400">{{ product.comments_count }} Comment(s)</span>
                                </div>
                                <div class="desc p-4 text-gray-800">
                                    <a :href="'/product/buy/' + product.id"
                                       class="title text-pink-300 font-bold block cursor-pointer hover:underline">{{ product.name
                                        }}</a>
                                    <span class="description text-sm text-white block py-2 border-gray-400 mb-2">{{ product.name }} {{ product.name }} {{ product.name }} {{ product.name }}</span>
                                </div>
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

    export default {
        components: {
            AppLayout,
        },
        props: [
            'products',
        ]
    }
</script>
