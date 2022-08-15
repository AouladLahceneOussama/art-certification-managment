<div class="bg-purple-500 pb-4 shadow-xl">
    <div class="relative pt-6 px-4 sm:px-6 lg:px-8">

        <nav class="relative flex items-center justify-between sm:h-10" aria-label="Global">
            <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
                <div class="flex items-center justify-between w-full md:w-auto">
                    <a href="#">
                        <span class="sr-only">Workflow</span>
                        <img class="h-8 w-auto sm:h-10" src="/images/logowhite2.svg" alt="Art-certification-logo">
                    </a>
                    <div class="-mr-2 flex items-center md:hidden">
                        <button type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-expanded="false" id="openMenu">
                            <span class="sr-only">Open main menu</span>
                            <!-- Heroicon name: outline/menu -->
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="hidden md:block md:ml-10 md:pr-4 md:space-x-8">
                <a href="#" class="font-medium text-white hover:text-purple-100 transition duration-300 ease-in-out">{{ __('Acceuil') }}</a>
                <a href="#" class="font-medium text-white hover:text-purple-100 transition duration-300 ease-in-out">{{ __('Services') }}</a>
                <a href="#" class="font-medium text-white hover:text-purple-100 transition duration-300 ease-in-out">{{ __('A Propos') }}</a>
                <a href="#" class="font-medium text-white hover:text-purple-100 transition duration-300 ease-in-out">{{ __('Contact') }}</a>
                <a href="#" class="font-medium text-purple-800 hover:text-purple-100 transition duration-300 ease-in-out">{{ __('Se Connecter') }}</a>
            </div>
            <div class="flex items-center ml-6 lg:ml-2">
                <div x-data="{ dropdownOpen: false }" class="relative">
                    <button @click="dropdownOpen = !dropdownOpen" class="relative outline-none">
                        <i class="fas fa-language text-white text-3xl hover:text-purple-200 transition duration-300 ease-in-out"></i>
                    </button>

                    <div x-show="dropdownOpen" x-transition @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

                    <div x-show="dropdownOpen" x-transition class="absolute right-0 mt-2 w-16 text-center bg-white rounded-md overflow-hidden shadow-xl z-20">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">FR</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">US</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">ES </a>
                    </div>
                </div>
            </div>
        </nav>

    </div>

    <div class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right hidden" id="mobile-menu">
        <div class="rounded-lg shadow-md bg-white ring-1 ring-black ring-opacity-5 overflow-hidden">
            <div class="px-5 pt-4 flex items-center justify-between">
                <div>
                    <img class="h-8 w-auto" src="/images/logoPurple2.svg" alt="art-certification-logo">
                </div>
                <div class="-mr-2">
                    <button type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" id="closeMenu">
                        <span class="sr-only">Close main menu</span>
                        <!-- Heroicon name: outline/x -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 transition duration-300 ease-in-out">{{ __('Acceuil') }}</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 transition duration-300 ease-in-out">{{ __('Services') }}</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 transition duration-300 ease-in-out">{{ __('A Propos') }}</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 transition duration-300 ease-in-out">{{ __('Contact') }}</a>
            </div>
        </div>
    </div>
</div>

<script>
    const openMenu = document.querySelector("#openMenu");
    const closeMenu = document.querySelector("#closeMenu");
    const menu = document.querySelector("#mobile-menu");

    openMenu.addEventListener("click", () => {
        menu.classList.toggle("hidden");
    });
    closeMenu.addEventListener("click", () => {
        menu.classList.toggle("hidden");
    });
</script>