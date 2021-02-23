<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-pink-300 leading-tight">
                New Product
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="submit" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <div class="mb-4">
                        <label for="name" class="block text-sm text-gray-700 font-bold mb-2">Product name</label>
                        <input id="name"
                               class="rounded shadow appearance-none w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               v-model="form.name"/>
                    </div>

                    <label for="description" class="block text-sm text-gray-700 font-bold mb-2">Description</label>
                    <textarea id="description"
                              class="rounded shadow appearance-none w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                              v-model="form.description"></textarea>

                    <div class="mb-4">
                        <label for="picture_path" class="block text-sm text-gray-700 font-bold mb-2">Picture URL</label>
                        <input id="picture_path"
                               class="rounded shadow appearance-none w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               v-model="form.picture_path"/>
                    </div>

                    <div class="mb-4">
                        <label for="picture_path" class="block text-sm text-gray-700 font-bold mb-2">Price EUR</label>
                        <input id="price" type="number" step="0.01"
                               class="rounded shadow appearance-none w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               v-model="form.price"/>
                    </div>

                    <button type="submit"
                            class="bg-green-300 text-bg-gray-200 px-2 py-1 text-sm mt-3 inline-block rounded hover:bg-green-500">
                        Create the product
                    </button>
                </form>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import swal from "sweetalert";

    export default {
        components: {
            AppLayout,
        },
        data() {
            return {
                form: {
                    name: null,
                    description: null,
                    picture_path: null,
                    price: null,
                },
            }
        },
        methods: {
            submit() {
                this.$inertia.post('/product/create', this.form);
                swal("Success!", "You successfully created the product.", "success");
                //this.$inertia.visit("/products");
            }
        }

    }
</script>
