<template>
    <div>
        <jet-banner/>

        <div class="min-h-screen bg-gray-100">
            <nav class="bg-gray-800 border-b border-gray-800">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex-shrink-0 flex items-center">
                                <inertia-link :href="route('home')">
                                    <jet-application-mark class="block h-12 w-auto"/>
                                </inertia-link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <jet-nav-link :href="route('home')" :active="route().current('home')">
                                    Home
                                </jet-nav-link>
                                    <jet-nav-link v-if="$page.props.user != null" :href="route('dashboard')" :active="route().current('dashboard')">
                                        Dashboard
                                    </jet-nav-link>
                                    <jet-nav-link v-if="$page.props.user != null" :href="route('users.index')" :active="route().current('users.index')">
                                        Users
                                    </jet-nav-link>
                                    <jet-nav-link v-if="$page.props.user != null" :href="route('products.index')"
                                                  :active="route().current('products.index')">
                                        Products
                                    </jet-nav-link>
                                    <jet-nav-link v-if="$page.props.user != null" :href="route('orders.index')"
                                                  :active="route().current('orders.index')">
                                        Orders
                                    </jet-nav-link>
                                <jet-nav-link :href="route('policy.show')" :active="route().current('policy.show')">
                                    Privacy Policy
                                </jet-nav-link>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <div class="ml-3 relative">
                                <!-- Teams Dropdown -->
                                <jet-dropdown align="right" width="60" v-if="$page.props.jetstream.hasTeamFeatures">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                {{ $page.props.user.current_team.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                          d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                          clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <div class="w-60">
                                            <!-- Team Management -->
                                            <template v-if="$page.props.jetstream.hasTeamFeatures">
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    Manage Team
                                                </div>

                                                <!-- Team Settings -->
                                                <jet-dropdown-link
                                                    :href="route('teams.show', $page.props.user.current_team)">
                                                    Team Settings
                                                </jet-dropdown-link>

                                                <jet-dropdown-link :href="route('teams.create')"
                                                                   v-if="$page.props.jetstream.canCreateTeams">
                                                    Create New Team
                                                </jet-dropdown-link>

                                                <div class="border-t border-gray-100"></div>

                                                <!-- Team Switcher -->
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    Switch Teams
                                                </div>

                                                <template v-for="team in $page.props.user.all_teams">
                                                    <form @submit.prevent="switchToTeam(team)" :key="team.id">
                                                        <jet-dropdown-link as="button">
                                                            <div class="flex items-center">
                                                                <svg v-if="team.id == $page.props.user.current_team_id"
                                                                     class="mr-2 h-5 w-5 text-green-400" fill="none"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     stroke-width="2" stroke="currentColor"
                                                                     viewBox="0 0 24 24">
                                                                    <path
                                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                                </svg>
                                                                <div>{{ team.name }}</div>
                                                            </div>
                                                        </jet-dropdown-link>
                                                    </form>
                                                </template>
                                            </template>
                                        </div>
                                    </template>
                                </jet-dropdown>
                            </div>

                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative" v-if="$page.props.user != null">
                                <jet-dropdown align="right" width="48">
                                    <template #trigger>
                                        <button v-if="$page.props.jetstream.managesProfilePhotos"
                                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                            <img class="h-8 w-8 rounded-full object-cover"
                                                 :src="$page.props.user.profile_photo_url"
                                                 :alt="$page.props.user.name"/>
                                            <a class="mt-auto mb-auto ml-1 mr-2 text-pink-300">{{ $page.props.user.name }}</a>
                                        </button>

                                        <span v-else class="inline-flex rounded-md">
                                            <button type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                {{ $page.props.user.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                          clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Manage Account
                                        </div>

                                        <jet-dropdown-link :href="route('profile.show')">
                                            Profile
                                        </jet-dropdown-link>

                                        <jet-dropdown-link :href="route('api-tokens.index')"
                                                           v-if="$page.props.jetstream.hasApiFeatures">
                                            API Tokens
                                        </jet-dropdown-link>

                                        <div class="border-t border-gray-100"></div>

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <jet-dropdown-link as="button">
                                                Logout
                                            </jet-dropdown-link>
                                        </form>
                                    </template>
                                </jet-dropdown>
                            </div>
                            <div class="ml-3 relative" v-if="$page.props.user == null">
                                <jet-nav-link :href="route('login')" :active="route().current('login')">
                                    Login
                                </jet-nav-link>
                                <jet-nav-link :href="route('register')" :active="route().current('register')">
                                    Register
                                </jet-nav-link>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = ! showingNavigationDropdown"
                                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"/>
                                    <path
                                        :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}"
                     class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <jet-responsive-nav-link :href="route('home')" :active="route().current('home')">
                            Home
                        </jet-responsive-nav-link>
                        <jet-responsive-nav-link v-if="$page.props.user != null" :href="route('dashboard')"
                                                 :active="route().current('dashboard')">
                            Dashboard
                        </jet-responsive-nav-link>
                        <jet-responsive-nav-link v-if="$page.props.user != null" :href="route('users.index')"
                                                 :active="route().current('users.index')">
                            Users
                        </jet-responsive-nav-link>
                        <jet-responsive-nav-link v-if="$page.props.user != null" :href="route('products.index')"
                                                 :active="route().current('products.index')">
                            Products
                        </jet-responsive-nav-link>
                        <jet-responsive-nav-link v-if="$page.props.user != null" :href="route('orders.index')"
                                                 :active="route().current('orders.index')">
                            Orders
                        </jet-responsive-nav-link>
                        <jet-responsive-nav-link :href="route('policy.show')" :active="route().current('policy.show')">
                            Privacy Policy
                        </jet-responsive-nav-link>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200" v-if="$page.props.user != null">
                        <div class="flex items-center px-4">
                            <div v-if="$page.props.jetstream.managesProfilePhotos" class="flex-shrink-0 mr-3">
                                <img class="h-10 w-10 rounded-full object-cover"
                                     :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name"/>
                            </div>

                            <div>
                                <div class="font-medium text-base text-gray-800">{{ $page.props.user.name }}</div>
                                <div class="font-medium text-sm text-gray-500">{{ $page.props.user.email }}</div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <jet-responsive-nav-link :href="route('profile.show')"
                                                     :active="route().current('profile.show')">
                                Profile
                            </jet-responsive-nav-link>

                            <jet-responsive-nav-link :href="route('api-tokens.index')"
                                                     :active="route().current('api-tokens.index')"
                                                     v-if="$page.props.jetstream.hasApiFeatures">
                                API Tokens
                            </jet-responsive-nav-link>

                            <!-- Authentication -->
                            <form method="POST" @submit.prevent="logout">
                                <jet-responsive-nav-link as="button">
                                    Logout
                                </jet-responsive-nav-link>
                            </form>

                            <!-- Team Management -->
                            <template v-if="$page.props.jetstream.hasTeamFeatures">
                                <div class="border-t border-gray-200"></div>

                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Manage Team
                                </div>

                                <!-- Team Settings -->
                                <jet-responsive-nav-link :href="route('teams.show', $page.props.user.current_team)"
                                                         :active="route().current('teams.show')">
                                    Team Settings
                                </jet-responsive-nav-link>

                                <jet-responsive-nav-link :href="route('teams.create')"
                                                         :active="route().current('teams.create')">
                                    Create New Team
                                </jet-responsive-nav-link>

                                <div class="border-t border-gray-200"></div>

                                <!-- Team Switcher -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Switch Teams
                                </div>

                                <template v-for="team in $page.props.user.all_teams">
                                    <form @submit.prevent="switchToTeam(team)" :key="team.id">
                                        <jet-responsive-nav-link as="button">
                                            <div class="flex items-center">
                                                <svg v-if="team.id == $page.props.user.current_team_id"
                                                     class="mr-2 h-5 w-5 text-green-400" fill="none"
                                                     stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                     stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <div>{{ team.name }}</div>
                                            </div>
                                        </jet-responsive-nav-link>
                                    </form>
                                </template>
                            </template>
                        </div>
                    </div>
                    <div class="pt-4 pb-1 border-t border-gray-200" v-if="$page.props.user == null">
                        <div class="mt-3 space-y-1">
                            <jet-responsive-nav-link :href="route('login')"
                                                     :active="route().current('login')">
                                Login
                            </jet-responsive-nav-link>

                            <jet-responsive-nav-link :href="route('register')"
                                                     :active="route().current('register')">
                                Register
                            </jet-responsive-nav-link>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header"></slot>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot></slot>
            </main>

            <!-- Modal Portal -->
            <portal-target name="modal" multiple>
            </portal-target>
        </div>

        <footer class="bg-gray-800 pt-10 sm:mt-10 pt-10">
            <div class="max-w-6xl m-auto text-gray-800 flex flex-wrap justify-left">
                <!-- Col-1 -->
                <div class="p-5 w-1/2 sm:w-4/12 md:w-3/12">
                    <!-- Col Title -->
                    <div class="text-xs uppercase text-gray-400 font-medium mb-6">
                        Products
                    </div>

                    <!-- Links -->
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Bloody Bypass
                    </a>
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Bloody Bypass
                    </a>
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Bloody Bypass
                    </a>
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Bloody Bypass
                    </a>
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Bloody Bypass
                    </a>
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Bloody Bypass
                    </a>
                </div>

                <!-- Col-2 -->
                <div class="p-5 w-1/2 sm:w-4/12 md:w-3/12">
                    <!-- Col Title -->
                    <div class="text-xs uppercase text-gray-400 font-medium mb-6">
                        Products
                    </div>

                    <!-- Links -->
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Bloody Bypass
                    </a>
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Bloody Bypass
                    </a>
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Bloody Bypass
                    </a>
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Bloody Bypass
                    </a>
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Bloody Bypass
                    </a>
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Bloody Bypass
                    </a>
                </div>

                <!-- Col-3 -->
                <div class="p-5 w-1/2 sm:w-3/12 md:w-3/12">
                    <!-- Col Title -->
                    <div class="text-xs uppercase text-gray-400 font-medium mb-6">
                        Products
                    </div>

                    <!-- Links -->
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Bloody Bypass
                    </a>
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Bloody Bypass
                    </a>
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Bloody Bypass
                    </a>
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Bloody Bypass
                    </a>
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Bloody Bypass
                    </a>
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Bloody Bypass
                    </a>
                </div>

                <!-- Col-4 -->
                <div class="p-5 w-1/2 sm:w-3/12 md:w-3/12">
                    <!-- Col Title -->
                    <div class="text-xs uppercase text-gray-400 font-medium mb-6">
                        Products
                    </div>

                    <!-- Links -->
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Bloody Bypass
                    </a>
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Bloody Bypass
                    </a>
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Bloody Bypass
                    </a>
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Bloody Bypass
                    </a>
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Bloody Bypass
                    </a>
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Bloody Bypass
                    </a>
                </div>

            </div>

            <!-- Copyright Bar -->
            <div class="pt-2">
                <div class="flex pb-5 px-3 m-auto pt-5
            border-t border-gray-500 text-gray-400 text-sm
            flex-col md:flex-row max-w-6xl">
                    <div class="mt-2">
                        © Copyright 2020-2021. All Rights Reserved.
                    </div>

                    <!-- Required Unicons (if you want) -->
                    <div class="md:flex-auto md:flex-row-reverse mt-2 flex-row flex">
                        <a href="https://www.facebook.com/leo.mrc.7/" target="_blank" class="w-6 mx-1">
                            <i class="uil uil-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/GrayR0ot" target="_blank" class="w-6 mx-1">
                            <i class="uil uil-twitter-alt"></i>
                        </a>
                        <a href="https://www.youtube.com/channel/UCznTB41twvU5u0ZjYi4pm2w" target="_blank"
                           class="w-6 mx-1">
                            <i class="uil uil-youtube"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/l%C3%A9o-moriceau-44743b1a1/" target="_blank"
                           class="w-6 mx-1">
                            <i class="uil uil-linkedin"></i>
                        </a>
                        <a href="https://github.com/GrayR0ot/" target="_blank" class="w-6 mx-1">
                            <i class="uil uil-github"></i>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
    import JetApplicationMark from '@/Jetstream/ApplicationMark'
    import JetBanner from '@/Jetstream/Banner'
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetNavLink from '@/Jetstream/NavLink'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'

    export default {
        components: {
            JetApplicationMark,
            JetBanner,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },

        methods: {
            switchToTeam(team) {
                this.$inertia.put(route('current-team.update'), {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },

            logout() {
                this.$inertia.post(route('logout'));
            },
        }
    }
</script>
