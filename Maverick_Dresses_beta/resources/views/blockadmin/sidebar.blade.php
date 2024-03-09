<aside class="flex-shrink-0 hidden w-64 bg-white border-r dark:border-primary-darker dark:bg-darker md:block">
    <div class="flex flex-col h-full">
        <nav aria-label="Main" class="flex-1 px-2 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto">
            <a href="{{route('home')}}">
                <img src="{{asset('assets/img/logo.png')}}" 
                class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light ">
            </a>

            
            <div x-data="{ isActive: false, open: false }">
                <a
                    href="#"
                    @click="$event.preventDefault(); open = !open"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                    :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }"
                    role="button"
                    aria-haspopup="true"
                    :aria-expanded="(open || isActive) ? 'true' : 'false'"
                >
                    <span aria-hidden="true">
                        <i class="fa-solid fa-border-all"></i>
                        <span class="ml-2 text-sm"> Category </span>
                    </span>
                    <span aria-hidden="true" class="ml-auto">
                        <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </a>
                <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Components">
                    <a href="{{route('admin.category.create')}}" role="menuitem" class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                        <i class="fa-solid fa-calendar-plus"></i>
                        <span class="ml-2 text-sm"> Create Category </span>
                    </a>
                    <a href="{{route('admin.category.index')}}" role="menuitem" class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                        <i class="fa-solid fa-square-check"></i>
                        <span class="ml-2 text-sm"> List Category </span>
                    </a>
                </div>
            </div>
            <div x-data="{ isActive: false, open: false }">
                <a
                    href="#"
                    @click="$event.preventDefault(); open = !open"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                    :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }"
                    role="button"
                    aria-haspopup="true"
                    :aria-expanded="(open || isActive) ? 'true' : 'false'"
                >
                    <span aria-hidden="true">
                        <i class="fa-solid fa-atom"></i>
                        <span class="ml-2 text-sm"> Product </span>
                    </span>
                    <span aria-hidden="true" class="ml-auto">
                        <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </a>
                <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Pages">
                    <a href="{{route('admin.product.create')}}" role="menuitem" class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                        <i class="fa-solid fa-plus"></i>
                        <span class="ml-2 text-sm"> Create Product </span>
                    </a>
                    <a href="{{route('admin.product.index')}}" role="menuitem" class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                        <i class="fa-solid fa-clipboard-list"></i>

                        <span class="ml-2 text-sm"> List Product </span>
                    </a>
                    <a href="{{route('admin.product.createsize')}}" role="menuitem" class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                        <i class="fa-solid fa-plus"></i>

                        <span class="ml-2 text-sm"> Create size </span>
                    </a>
                    <a href="{{route('admin.product.indexsize')}}" role="menuitem" class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                        <i class="fa-solid fa-clipboard-list"></i>

                        <span class="ml-2 text-sm"> List Size </span>
                    </a>
                </div>
            </div>
            <div x-data="{ isActive: false, open: false}">
                <a
                    href="#"
                    @click="$event.preventDefault(); open = !open"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                    :class="{'bg-primary-100 dark:bg-primary': isActive || open}"
                    role="button"
                    aria-haspopup="true"
                    :aria-expanded="(open || isActive) ? 'true' : 'false'"
                >
                    <span aria-hidden="true">
                        <i class="fa-solid fa-users"></i>
                    </span>
                    <span class="ml-2 text-sm"> User </span>
                    <span aria-hidden="true" class="ml-auto">
                        <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </a>
                <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Authentication">
                    <a href="{{route('admin.user.create')}}" role="menuitem" class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                        <i class="fa-solid fa-user-plus"></i>
                        <span class="ml-2 text-sm"> Create User </span>
                    </a>
                    <a href="{{route('admin.user.index')}}" role="menuitem" class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                        <i class="fa-solid fa-list-check"></i>
                        <span class="ml-2 text-sm"> List User </span>
                    </a>
                </div>
            </div>
            <div x-data="{ isActive: false, open: false}">
                
                <a
                    href="#"
                    @click="$event.preventDefault(); open = !open"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                    :class="{'bg-primary-100 dark:bg-primary': isActive || open}"
                    role="button"
                    aria-haspopup="true"
                    :aria-expanded="(open || isActive) ? 'true' : 'false'"
                >
                    <span aria-hidden="true">
                            <i class="fa-solid fa-cart-plus"></i>
                    </span>
                    <span class="ml-2 text-sm"> Cart </span>
                    <span aria-hidden="true" class="ml-auto">
                        <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </a>
                <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Authentication">
                    <a href="{{route('admin.cart.orders_confirmation')}}" role="menuitem" class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                        <i class="fa-solid fa-truck-fast"></i> 
                        <span class="ml-2 text-sm">  Orders confirmation  </span>
                    </a>
                    <a href="{{route('admin.cart.orders_confirmated')}}" role="menuitem" class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                        <i class="fa-solid fa-truck-fast"></i>
                        <span class="ml-2 text-sm">  Orders confirmated  </span>
                    </a>
                    <a href="{{route('admin.cart.orders_delivering')}}" role="menuitem" class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                        <i class="fa-solid fa-truck-fast"></i>
                        <span class="ml-2 text-sm">  Orders delivering  </span>
                    </a>
                    <a href="{{route('admin.cart.list_order')}}" role="menuitem" class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                        <i class="fa-solid fa-truck-fast"></i>
                        <span class="ml-2 text-sm">  Order Successfully </span>
                    </a>
                    <a href="{{route('admin.cart.order_cancel')}}" role="menuitem" class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                        <i class="fa-solid fa-truck-fast"></i>
                        <span class="ml-2 text-sm"> Order Cancel  </span>
                    </a>
                    <a href="{{route('admin.cart.returns_oder')}}" role="menuitem" class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                        <i class="fa-solid fa-truck-fast"></i>
                        <span class="ml-2 text-sm"> Returns Oder </span>
                    </a>
                    <a href="{{route('admin.cart.list_returns_oder')}}" role="menuitem" class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                        <i class="fa-solid fa-truck-fast"></i>
                        <span class="ml-2 text-sm">  Returns Successfully  </span>
                    </a>
                    <a href="{{route('admin.cart.online')}}" role="menuitem" class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                        <i class="fa-solid fa-coins"></i>
                        <span class="ml-2 text-sm"> Paid </span>
                    </a>
                    <a href="{{route('admin.cart.immidiate')}}" role="menuitem" class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                        <i class="fa-solid fa-coins"></i>
                        <span class="ml-2 text-sm"> Unpaid </span>
                    </a>
                    <a href="{{route('admin.cart.rating_products')}}" role="menuitem" class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                        <i class="fa-solid fa-comment"></i>
                        <span class="ml-2 text-sm">  Rating Product </span>
                    </a>
                </div>
                
            </div>
            

            {{-- // ----------------------------------------------------------------  --}}
            <div x-data="{ isActive: false, open: false}">
                <a
                    href="#"
                    @click="$event.preventDefault(); open = !open"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                    :class="{'bg-primary-100 dark:bg-primary': isActive || open}"
                    role="button"
                    aria-haspopup="true"
                    :aria-expanded="(open || isActive) ? 'true' : 'false'"
                >
                    <span aria-hidden="true">
                        <i class="fa-solid fa-coins"></i>
                    </span>
                    <span class="ml-2 text-sm"> Total </span>
                    <span aria-hidden="true" class="ml-auto">
                        <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </a>
                <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Authentication">
                    <a href="{{route('admin.total.quater_1')}}" role="menuitem" class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                        <i class="fa-solid fa-coins"></i>
                        <span class="ml-2 text-sm"> Quater  </span>
                    </a>
                    
                    <a href="{{route('admin.total.total_month')}}" role="menuitem" class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                        <i class="fa-solid fa-coins"></i>
                        <span class="ml-2 text-sm"> Total by Month </span>
                    </a>
                </div>
            </div>
        </nav>

        
    </div>
</aside>