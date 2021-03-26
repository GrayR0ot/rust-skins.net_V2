<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-pink-300 leading-tight">
                Product #{{ product.id }}
            </h2>
        </template>
        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="py-3">
                        <div class="p-4 mx-4 bg-gray-200 rounded shadow">
                            <div class="flex sm:justify-between items-center">
                                <img class="w-1/4 hover:opacity-75" :src="product.picture_path"
                                     :alt="product.name"/>
                                <div class="sm:justify-between items-center pb-16">
                                    <div class="text-xl">{{ product.name }}</div>
                                    <div class="text-xl">{{ product.description }}</div>
                                    <div>{{ product.price }}€</div>
                                </div>

                                <div class="sm:justify-between items-center pb-4 ml-8">
                                    <div class="text-xl">
                                        <button
                                            class="bg-indigo-400 text-bg-gray-200 px-2 py-1 text-sm mt-3 inline-block rounded hover:bg-indigo-500"
                                            @click="purchase()">Buy this
                                            product
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <discount-progress-bar :discount="product.discount"></discount-progress-bar>
                            <br>
                            <div class="bg-gray-100 overflow-x-hidden">

                                <div class="px-6 py-8">
                                    <div class="flex justify-between container mx-auto">
                                        <div class="w-full lg:w-8/12">
                                            <div class="flex items-center justify-between">
                                                <h1 class="text-xl font-bold text-gray-700 md:text-2xl">Post</h1>
                                                <div>
                                                    <select v-model="currentOrder" @change="onChangeOrder()"
                                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                        <option value="orderByNew">Latest</option>
                                                        <option value="orderByLast">Oldest</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mt-6" v-for="(comment, index) in comments"
                                                 v-bind:key="comment.id">
                                                <div class="max-w-4xl px-10 py-6 bg-white rounded-lg shadow-md">
                                                    <div class="flex justify-between items-center"><span
                                                        class="font-light text-gray-600">{{ formatDate(comment.created_at) }}</span>
                                                    </div>
                                                    <div class="mt-2">
                                                        <p class="mt-2 text-gray-600">{{ comment.comment }}</p>
                                                    </div>
                                                    <div><a class="flex items-center"><img
                                                        :src="'/storage/' + comment.user.profile_photo_path"
                                                        :alt="comment.user.name"
                                                        class="mx-4 w-10 h-10 object-cover rounded-full hidden sm:block">
                                                        <h1 class="text-gray-700 font-bold hover:underline">{{
                                                            comment.user.name }}</h1>
                                                    </a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="heading text-center font-bold text-2xl mt-5 text-gray-800">New Post</div>
                            <form @submit.prevent="submit" class="editor w-full flex flex-col text-gray-800 border p-4">
                                <textarea v-model="form.comment"
                                          class="description bg-gray-100 sec p-3 h-60 border border-gray-300 outline-none"
                                          spellcheck="false"
                                          placeholder="Post your comment or question about this product."></textarea>

                                <div class="buttons flex mt-2" @submit.prevent="submit">
                                    <button type="submit"
                                            class="bg-green-500 text-gray-200 px-4 font-semibold p-1 mt-3 inline-block rounded hover:bg-green-400">
                                        Post
                                    </button>
                                </div>
                            </form>
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
    import DiscountProgressBar from "@/Pages/Product/DiscountProgressBar";
    import Button from "@/Jetstream/Button";
    import swal from 'sweetalert';
    import moment from 'moment';
    import momentTz from 'moment-timezone'

    export default {
        components: {
            Button,
            AppLayout,
            JetApplicationLogo,
            DiscountProgressBar
        },
        props: [
            'product',
            'comments'
        ],
        methods: {
            purchase() {
                axios.post('/order/buy', {
                    productId: this.product.id
                })
                    .then(response => {
                        swal("Success!", "The order #" + response['data'] + " as been placed.", "success");
                    })
            },
            formatDate(date) {
                momentTz.tz.setDefault('Europe/Paris');
                return moment(date).format('DD/MM/YYYY HH:mm');
            },
            submit() {
                var data = new FormData();
                data.append('comment', this.form.comment);
                data.append('product_id', this.product.id);
                this.$inertia.post('/product/comment', data);
                this.form.comment = "";
                swal("Success!", "You successfully post your comment to the product.", "success");
            },
            onChangeOrder() {
                console.log("1");
                this.comments.reverse();
            },
        },
        data() {
            return {
                form: {
                    comment: null,
                },
                currentOrder: 'orderByNew',
            }
        },
    }
</script>
