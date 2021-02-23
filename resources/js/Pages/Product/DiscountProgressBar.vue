<template>
    <div>
        <div class="bg-gray-500 w-full rounded">
            <div class="bg-green-500 text-white rounded-l text-center" :style="'width:' + discount + '%'">{{ discount }}% OFF
            </div>
        </div>
    </div>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo'

    export default {
        props: [
            'discount',
        ]
    }
</script>
