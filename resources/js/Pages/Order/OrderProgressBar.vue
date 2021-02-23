<template>
    <div>
        <div class="bg-gray-500 w-full rounded">
            <div class="bg-green-500 text-white rounded-l text-center" :style="'width:' + percentage + '%'">{{
                percentage }}% - {{ displayStatus }}
            </div>
        </div>
    </div>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo'

    export default {
        props: [
            'status',
        ],
        computed: {
            percentage() {
                if (this.status == 1) {
                    return 25;
                } else if (this.status == 2) {
                    return 50;
                } else if (this.status == 3) {
                    return 75;
                } else if (this.status == 4) {
                    return 100;
                } else {
                    return 0;
                }
            },
            displayStatus() {
                if (this.status == 1) {
                    return "Waiting for payment";
                } else if (this.status == 2) {
                    return "Payment verification";
                } else if (this.status == 3) {
                    return "Delivering your order";
                } else if (this.status == 4) {
                    return "Order complete";
                } else {
                    return "Waiting";
                }
            }
        }
    }
</script>
