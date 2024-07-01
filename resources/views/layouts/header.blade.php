<header class="container-fluid p-3">
    <div class=" d-flex flex-row justify-content-around">
        <p>   {{auth()->user()->name}}</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-dropdown-link :href="route('logout')"
                             onclick="event.preventDefault();
                 this.closest('form').submit();">
                <span>خروج</span>
            </x-dropdown-link>
        </form>

    </div>
</header>
