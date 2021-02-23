<template>
    <div>
        <header class="lg:px-16 px-6 bg-gray-800 flex flex-wrap items-center lg:py-0 py-2">
            <div class="flex-1 flex justify-between items-center">
                <a href="#">
                    <img src="https://rust-skins.net/images/logo.png"
                         class="rounded-full w-1/2 h-1/2 my-2 border-2 border-transparent hover:border-indigo-400"
                         alt="Logo">
                </a>
            </div>
            <label for="menu-toggle" class="pointer-cursor lg:hidden block">
                <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                     viewBox="0 0 20 20"><title>menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
                </svg>
            </label>
            <input class="hidden" type="checkbox" id="menu-toggle"/>

            <div class="hidden lg:flex lg:items-center lg:w-auto w-full" id="menu">
                <nav>
                    <ul class="lg:flex items-center justify-between text-base text-gray-500 pt-4 lg:pt-0">
                        <li>
                            <a href="#" class="lg:p-4 py-3 px-0 block border-b-2 border-transparent">
                                <div class="flex items-center justify-between">
                                    <svg class="fill-current text-gray-300 mr-2" xmlns="http://www.w3.org/2000/svg"
                                         width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                    Home
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="lg:p-4 py-3 px-0 block border-b-2 border-transparent">Features</a>
                        </li>
                        <li>
                            <a href="#" class="lg:p-4 py-3 px-0 block border-b-2 border-transparent">Features</a>
                        </li>
                        <li>
                            <a href="#" class="lg:p-4 py-3 px-0 block border-b-2 border-transparent">Features</a>
                        </li>
                    </ul>
                </nav>
                <a href="#" class="lg:ml-4 flex text-white items-center justify-start lg:mb-0 mb-4 cursor-pointer">
                    <img src="/logo.png"
                         class="rounded-full w-10 h-10 border-2 border-transparent bg-white hover:border-indigo-400"
                         alt="Logo">
                    <p class="ml-2">I'm Mike</p>
                </a>
            </div>
        </header>
        <div class="px-4">
            <div class="max-w-3xl bg-white rounded-lg mx-auto my-16 p-16">
                <h1 class="text-2xl font-medium mb-2">Let's try it !</h1>
                <h2 class="text-font-medium text-sm text-indigo-400 mb-4 uppercase tracking-wide">Responsive !</h2>
                This is responsive !
            </div>
        </div>
    </div>
</template>

<style>
    #menu-toggle:checked + #menu {
        display: block;
    }
</style>

<script>

    import Label from "@/Jetstream/Label";

    export default {
        components: {Label}
    }
</script>
