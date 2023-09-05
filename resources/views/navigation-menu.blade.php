<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        {{-- <x-application-mark class="block h-9 w-auto" /> --}}
                        <img
                            src="data:image/png;base64,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">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @if (request()->routeIs('create.contaspagar'))
                        <x-nav-link href="{{ route('index.contaspagar') }}" :active="request()->routeIs('create.contaspagar')">
                            {{ __('Contas a Pagar') }}
                        </x-nav-link>
                    @elseif(request()->routeIs('edit.contaspagar'))
                        <x-nav-link href="{{ route('index.contaspagar') }}" :active="request()->routeIs('edit.contaspagar')">
                            {{ __('Contas a Pagar') }}
                        </x-nav-link>
                    @else
                        <x-nav-link href="{{ route('index.contaspagar') }}" :active="request()->routeIs('index.contaspagar')">
                            {{ __('Contas a Pagar') }}
                        </x-nav-link>
                    @endif
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @if (request()->routeIs('create.contasreceber'))
                        <x-nav-link href="{{ route('index.contasreceber') }}" :active="request()->routeIs('create.contasreceber')">
                            {{ __('Contas a Receber') }}
                        </x-nav-link>
                    @elseif (request()->routeIs('edit.contasreceber'))
                        <x-nav-link href="{{ route('index.contasreceber') }}" :active="request()->routeIs('edit.contasreceber')">
                            {{ __('Contas a Receber') }}
                        </x-nav-link>
                    @else
                        <x-nav-link href="{{ route('index.contasreceber') }}" :active="request()->routeIs('index.contasreceber')">
                            {{ __('Contas a Receber') }}
                        </x-nav-link>
                    @endif
                </div>

            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ml-3 relative">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-dropdown-link>
                                    @endcan

                                    <!-- Team Switcher -->
                                    @if (Auth::user()->allTeams()->count() > 1)
                                        <div class="border-t border-gray-200"></div>

                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Switch Teams') }}
                                        </div>

                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-switchable-team :team="$team" />
                                        @endforeach
                                    @endif
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-200"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">

            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if (request()->routeIs('create.contaspagar'))
                <x-responsive-nav-link href="{{ route('index.contaspagar') }}" :active="request()->routeIs('create.contaspagar')">
                    {{ __('Contas a Pagar') }}
                </x-responsive-nav-link>
            @elseif(request()->routeIs('edit.contaspagar'))
                <x-responsive-nav-link href="{{ route('index.contaspagar') }}" :active="request()->routeIs('edit.contaspagar')">
                    {{ __('Contas a Pagar') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link href="{{ route('index.contaspagar') }}" :active="request()->routeIs('index.contaspagar')">
                    {{ __('Contas a Pagar') }}
                </x-responsive-nav-link>
            @endif

            @if (request()->routeIs('create.contasreceber'))
                <x-responsive-nav-link href="{{ route('index.contasreceber') }}" :active="request()->routeIs('create.contasreceber')">
                    {{ __('Contas a Receber') }}
                </x-responsive-nav-link>
            @elseif (request()->routeIs('edit.contasreceber'))
                <x-responsive-nav-link href="{{ route('index.contasreceber') }}" :active="request()->routeIs('edit.contasreceber')">
                    {{ __('Contas a Receber') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link href="{{ route('index.contasreceber') }}" :active="request()->routeIs('index.contasreceber')">
                    {{ __('Contas a Receber') }}
                </x-responsive-nav-link>
            @endif

        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                        :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-responsive-nav-link>
                    @endcan

                    <!-- Team Switcher -->
                    @if (Auth::user()->allTeams()->count() > 1)
                        <div class="border-t border-gray-200"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Switch Teams') }}
                        </div>

                        @foreach (Auth::user()->allTeams() as $team)
                            <x-switchable-team :team="$team" component="responsive-nav-link" />
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
</nav>
