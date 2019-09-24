<div class="w-64 bg-gray-800 h-screen">
    <div class="text-center text-white font-bold border-b border-gray-600 pb-4">
        <h1 class="text-xl text-center  mt-3">WoolHouse</h1>
        <h2 class="text-normal">REPORTING DASHBOARD</h2>
    </div>
    <div class="mt-5 text-gray-500 px-4 ">
        <a href="/" class="block py-3 flex items-center hover:text-white {{ (strpos(Route::currentRouteName(), 'home') === 0) ? 'active' : '' }}">
            <svg aria-hidden="true" focusable="false"
                data-prefix="fas" data-icon="home" class="w-5 h-5"
                role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                <path fill="currentColor" d="M280.37 148.26L96 300.11V464a16 16 0 0 0 16 16l112.06-.29a16
                                    16 0 0 0 15.92-16V368a16 16 0 0 1 16-16h64a16 16 0 0 1 16 16v95.64a16 16 0 0 0 16 16.05L464
                                    480a16 16 0 0 0 16-16V300L295.67 148.26a12.19 12.19 0 0 0-15.3 0zM571.6 251.47L488 182.56V44.05a12
                                    12 0 0 0-12-12h-56a12 12 0 0 0-12 12v72.61L318.47 43a48 48 0 0 0-61 0L4.34 251.47a12 12 0 0 0-1.6
                                    16.9l25.5 31A12 12 0 0 0 45.15 301l235.22-193.74a12.19 12.19 0 0 1 15.3 0L530.9 301a12 12 0 0 0
                                    16.9-1.6l25.5-31a12 12 0 0 0-1.7-16.93z"></path>
            </svg>
            <span class="ml-2">Home </span>
        </a>
        <a href="/sales" class="block py-3 flex items-center hover:text-white {{ (strpos(Route::currentRouteName(), 'sales') === 0) ? 'active' : '' }}">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="shopping-cart" 
                class="w-5 h-5" role="img" xmlns="http://www.w3.org/2000/svg" 
                viewBox="0 0 576 512">
                <path fill="currentColor" d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 
                10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 
                56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 
                426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 
                56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 
                20.92-7.754 23.403-18.681z"></path>
            </svg>
            <span class="ml-2">Sales Report</span>
        </a>
        <a href="#" class="block py-3 flex items-center hover:text-white">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="calendar-week" 
                class="w-5 h-5" role="img" 
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path fill="currentColor" d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm64-192c0-8.8 
                7.2-16 16-16h288c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 
                16H80c-8.8 0-16-7.2-16-16v-64zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 
                16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 
                112v48h448v-48c0-26.5-21.5-48-48-48z"></path>
            </svg>
            <span class="ml-2">Weekly Report</span>
        </a>
        <div class="mt-4 border-t border-gray-700 text-gray-500 py-4">
            Management
        </div>
        <a href="#" class="block py-3 flex items-center hover:text-white">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bus" 
                class="h-5 w-5" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="currentColor" d="M488 128h-8V80c0-44.8-99.2-80-224-80S32 35.2 32 80v48h-8c-13.25 0-24 
                10.74-24 24v80c0 13.25 10.75 24 24 24h8v160c0 17.67 14.33 32 32 32v32c0 
                17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32v-32h192v32c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 
                32-32v-32h6.4c16 0 25.6-12.8 25.6-25.6V256h8c13.25 0 24-10.75 24-24v-80c0-13.26-10.75-24-24-24zM112 
                400c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm16-112c-17.67 
                0-32-14.33-32-32V128c0-17.67 14.33-32 32-32h256c17.67 0 32 14.33 32 32v128c0 17.67-14.33 
                32-32 32H128zm272 112c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32z"></path>
            </svg>
            <span class="ml-2">Tour Agents</span>
        </a>
        <a href="#" class="block py-3 flex items-center hover:text-white">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-tie" 
                class="w-5 h-5" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm95.8 32.6L272 
                480l-32-136 32-56h-96l32 56-32 136-47.8-191.4C56.9 292 0 350.3 0 422.4V464c0 26.5 21.5 
                48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-72.1-56.9-130.4-128.2-133.8z"></path>
            </svg>
            <span class="ml-2">Tour Guides</span>
        </a>
        <a href="#" class="block py-3 flex items-center hover:text-white">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="tags" 
                class="w-5 h-5" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                <path fill="currentColor" d="M497.941 225.941L286.059 14.059A48 48 0 0 0 252.118 0H48C21.49 0 0 
                21.49 0 48v204.118a48 48 0 0 0 14.059 33.941l211.882 211.882c18.744 18.745 49.136 18.746 67.882 
                0l204.118-204.118c18.745-18.745 18.745-49.137 0-67.882zM112 160c-26.51 0-48-21.49-48-48s21.49-48 
                48-48 48 21.49 48 48-21.49 48-48 48zm513.941 133.823L421.823 497.941c-18.745 18.745-49.137 18.745-67.882 
                0l-.36-.36L527.64 323.522c16.999-16.999 26.36-39.6 26.36-63.64s-9.362-46.641-26.36-63.64L331.397 
                0h48.721a48 48 0 0 1 33.941 14.059l211.882 211.882c18.745 18.745 18.745 49.137 0 67.882z"></path>
            </svg>
            <span class="ml-2">Products</span>
        </a>
        <div class="mt-4 border-t border-gray-700 text-gray-500 py-4">
            Utilities
        </div>
        <a href="#" class="block py-3 flex items-center hover:text-white">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user" 
                class="w-5 h-5" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 
                128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 
                422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"></path>
            </svg>
            <span class="ml-2">Users</span>
        </a>
        <a  class="block py-3 flex items-center hover:text-white"
            href="{{ route('logout') }}"
            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sign-out-alt" 
                class="w-5 h-5" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="currentColor" d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 
                10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 
                436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 
                12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z"></path>
            </svg>
            <span class="ml-2">Logout</span>
        </a>
    </div>
</div>
