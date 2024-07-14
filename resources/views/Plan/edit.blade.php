@extends('layouts.basic')
@section('body')
    @include('layouts.header')

    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <form class="form-controller mx-auto p-2" method="post" action="{{route('plans.update',$plan->id)}}">
                    @csrf
                    @include('Plan.form',['buttonName'=>'ویرایش'])
                </form>
            </div>
            <div class="col-3"></div>

        </div>
    </div>
@endsection
