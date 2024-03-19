<nav x-data="{ activeLink: '{{ request()->routeIs('dashboard') ? 'dashboard' : (request()->routeIs('account') ? 'account' : (request()->routeIs('invest') ? 'invest' : (request()->routeIs('cashout') ? 'cashout' : 'profile'))) }}' }"
    class="fixed mt-10 w-full bottom-0 left-0 right-0 h-16 p-1 bg-skin-primary">
    <div class="container flex mx-auto my-1 justify-around items-center">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
            x-bind:class="{ 'text-skin-secondary group bg-': activeLink === 'dashboard' }"
            class="flex items-center flex-col px-4 py-2 group">
            <svg class="w-5 h-5 mb-1 text-skin-inverted dark:text-gray-400 group-focus:text-skin-secondary group-hover:text-lime-600 dark:group-hover:text-skin-secondary"
                :class="{ 'text-skin-secondary dark:text-skin-secondary': activeLink === 'dashboard' }" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
            </svg>
            <span :class="{ 'text-skin-secondary dark:text-skin-secondary': activeLink === 'dashboard' }" class="text-sm text-skin-inverted">Dashboard</span>
        </a>
        <!-- Account -->
        <a href="{{ route('account') }}" x-bind:class="{ 'text-skin-secondary group bg-purple-100': activeLink === 'account' }"
            class="flex items-center flex-col px-4 py-2  group">
            <svg class="w-5 h-5 mb-1  text-skin-inverted group-focus:text-skin-secondary group-hover:text-lime-600 dark:group-hover:text-skin-secondary"
                :class="{ 'text-skin-secondary dark:text-skin-secondary': activeLink === 'account' }" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
            </svg>

            <span  :class="{ 'text-skin-secondary dark:text-skin-secondary': activeLink === 'account' }" class="text-sm text-skin-inverted focus:text-skin-secondary">{{ __('Team') }}</span>
        </a>
        <a href="{{ route('invest') }}" x-bind:class="{ 'text-skin-secondary group bg-blue-100': activeLink === 'invest' }"
            class="flex items-center flex-col px-4 py-2  group"> 
            <svg class="w-5 h-5 mb-1  text-skin-inverted group-focus:text-skin-secondary group-hover:text-lime-600 dark:group-hover:text-skin-secondary"
                :class="{ 'text-skin-secondary dark:text-skin-secondary': activeLink === 'invest' }" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
            </svg>

            <span :class="{ 'text-skin-secondary dark:text-skin-secondary': activeLink === 'invest' }"  class="text-sm text-skin-inverted">{{ __('Invest') }}</span>
        </a>
        <a href="{{ route('cashout') }}" x-bind:class="{ 'text-skin-secondary group bg-purple-100': activeLink === 'cashout' }"
            class="flex items-center flex-col px-4 py-2  group">
            <svg class="w-5 h-5 mb-1  text-skin-inverted group-focus:text-skin-secondary group-hover:text-lime-600 dark:group-hover:text-purple-500"
                :class="{ 'text-skin-secondary dark:text-skin-secondary': activeLink === 'cashout' }" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M11.074 4 8.442.408A.95.95 0 0 0 7.014.254L2.926 4h8.148ZM9 13v-1a4 4 0 0 1 4-4h6V6a1 1 0 0 0-1-1H1a1 1 0 0 0-1 1v13a1 1 0 0 0 1 1h17a1 1 0 0 0 1-1v-2h-6a4 4 0 0 1-4-4Z" />
                <path
                    d="M19 10h-6a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1Zm-4.5 3.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2ZM12.62 4h2.78L12.539.41a1.086 1.086 0 1 0-1.7 1.352L12.62 4Z" />
            </svg>
            <span :class="{ 'text-skin-secondary dark:text-skin-secondary': activeLink === 'cashout' }" class="text-sm text-skin-inverted">{{ __('Cashout') }}</span>
        </a>
    </div>
</nav>
