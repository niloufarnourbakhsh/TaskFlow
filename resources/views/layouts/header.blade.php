<header class="container-fluid ">
    <div class="d-flex flex-row justify-content-around p-2 my-1">
        <p class="bg-green-four text-white p-2 px-4 rounded-1">   {{auth()->user()->name}}</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-dropdown-link :href="route('logout')"
                             onclick="event.preventDefault();
                 this.closest('form').submit();">
                <span class="p-2 px-4 bg-green-three text-white rounded-1">خروج</span>
            </x-dropdown-link>
        </form>

    </div>
    <div class="horizontal-line"></div>
</header>
