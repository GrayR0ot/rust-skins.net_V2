<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-pink-300 leading-tight">
                Order #{{ order.id }}
            </h2>
        </template>
        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="py-3">
                        <div class="p-4 mx-4 bg-gray-200 rounded shadow">
                            <div class="flex sm:justify-between items-center">
                                <div class="sm:justify-between items-center pb-16">
                                    <div class="text-xl">{{ order.user.name }}</div>
                                    <div class="text-xl">{{ order.name }}</div>
                                    <div>{{ order.price }}€</div>
                                </div>

                                <div class="sm:justify-between items-center pb-4 ml-8">
                                    <div class="text-xl">
                                        <button
                                            class="bg-yellow-400 text-bg-gray-200 px-2 py-1 text-sm mt-3 inline-block rounded hover:bg-yellow-500"
                                            @click="changeStatus(1)">Mark as waiting for paiement
                                        </button>
                                    </div>
                                    <div class="text-xl">
                                        <button
                                            class="bg-blue-400 text-bg-gray-200 px-2 py-1 text-sm mt-3 inline-block rounded hover:bg-blue-500"
                                            @click="changeStatus(3)">Mark as delivering
                                        </button>
                                    </div>
                                    <div class="text-xl">
                                        <button
                                            class="bg-green-400 text-bg-gray-200 px-2 py-1 text-sm mt-3 inline-block rounded hover:bg-green-500"
                                            @click="changeStatus(4)">Mark as complete
                                        </button>
                                    </div>
                                    <div class="text-xl">
                                        <button
                                            class="bg-red-400 text-bg-gray-200 px-2 py-1 text-sm mt-3 inline-block rounded hover:bg-red-500"
                                            @click="deleteOrder()">Delete
                                            order
                                        </button>
                                    </div>
                                    <div class="text-xl">
                                        <button
                                            class="bg-pink-400 text-bg-gray-200 px-2 py-1 text-sm mt-3 inline-block rounded hover:bg-pink-500"
                                            @click="getInvoice()">Invoice
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <order-progress-bar :status="order.status"></order-progress-bar>
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
    import OrderProgressBar from "@/Pages/Order/OrderProgressBar";
    import Button from "@/Jetstream/Button";
    import swal from 'sweetalert';

    export default {
        components: {
            Button,
            AppLayout,
            JetApplicationLogo,
            OrderProgressBar
        },
        props: [
            'order',
            'status',
        ],
        methods: {
            changeStatus(status) {
                swal("Success!", "You successfully updated #" + this.order.id + " order.", "success");
                axios.post('/order/update', {
                    orderId: this.order.id,
                    status: status,
                })
                    .then(response => {
                        this.order.status = status;
                    })
            },
            deleteOrder() {
                swal("Success!", "You successfully deleted #" + this.order.id + " order.", "success");
                axios.post('/order/delete', {
                    orderId: this.order.id
                })
                    .then(response => {
                        console.log(response);
                    });
                this.$inertia.visit("/orders");
            },
            getInvoice() {
                window.open("/order/invoice/" + this.order.id, "_blank");
            }
        }
    }
</script>
