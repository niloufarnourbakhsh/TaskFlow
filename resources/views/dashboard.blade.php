<x-app-layout>
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">--}}
{{--            {{ __('Dashboard') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

    <div class="py-12">
        <div class="container my-5 p-2 ">
            <div class="row row-cols-2  g-2 box-height ">
                <div class="col my-2 bg-green-one">
                    <a href="{{route('plans.create')}}" >
                        <div class=" bg-brown text-center">
                            <p class="pt-5">اضافه کردن پلن جدید</p>
                        </div>
                    </a>
                </div>
                <div class="col my-2 box-height bg-green-two">
                    <a href="">
                        <div class=" bg-golbey text-center">
                            <p class="pt-5"> مشاهده ی پلن های هفته ی اخیر</p>
                        </div>
                    </a>
                </div>
                <div class="col my-2 box-height bg-green-three">
                    <a href="">
                        <div class=" bg-light-yellow text-center">
                            <p class="card-text pt-5"> مشاهده پلن سالانه و ماهانه</p>
                        </div>
                    </a>
                </div>
                <div class="col my-2 box-height bg-green-four">
                    <a href="">
                        <div class=" bg-cream text-center">
                            <p class="card-text py-5">This is a longer card with supporting text  bit longer.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">--}}
{{--                <div class="p-6 text-gray-900 dark:text-gray-100">--}}
{{--                    {{ __("You're logged in!") }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</x-app-layout>
