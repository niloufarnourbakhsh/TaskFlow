@extends('layouts.basic')
@section('body')
    @include('layouts.header')

    <div class="container ">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <form class="form-controller mx-auto p-2" method="post" action="{{route('plans.store')}}">
                    @csrf
 @include('Plan.form',['plan'=>new App\Models\Plan(),'buttonName'=>'ذخیره'])
                </form>
            </div>
            <div class="col-4"></div>
        </div>
    </div>
@endsection
