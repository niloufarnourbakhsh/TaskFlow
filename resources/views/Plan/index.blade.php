@extends('layouts.basic')
@section('body')
    @include('layouts.header')
    <div class="horizontal-line"></div>
    <div class="container my-5 p-2 ">
        <div class="row row-cols-2  g-2 box-height ">
            <div class="col my-2 bg-brown">
                <a href="{{route('plans.create')}}" >
                    <div class=" bg-brown text-center">
                        <p class="pt-5">اضافه کردن پلن جدید</p>
                    </div>
                </a>
            </div>
            <div class="col my-2 bg-golbey box-height">
                <a href="">
                    <div class=" bg-golbey text-center">
                        <p class="pt-5"> مشاهده ی پلن های هفته ی اخیر</p>
                    </div>
                </a>
            </div>
            <div class="col my-2 bg-light-yellow box-height">
                <a href="">
                    <div class=" bg-light-yellow text-center">
                        <p class="card-text pt-5"> مشاهده پلن سالانه و ماهانه</p>
                    </div>
                </a>
            </div>
            <div class="col my-2 bg-cream box-height">
                <a href="">
                    <div class=" bg-cream text-center">
                        <p class="card-text py-5">This is a longer card with supporting text  bit longer.</p>
                    </div>
                </a>
            </div>
            </div>
        </div>


@endsection
