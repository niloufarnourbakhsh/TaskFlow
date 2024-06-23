@extends('Include.header')
@section('body')
    <div class="container bg-danger">
        <form class="form-controller mx-auto p-2" method="post" action="{{route('plans.store')}}">
            @csrf
            <div class="m-3 p-3">
                <label class="form-label">description:</label>
                <input type="text" name="description">
            </div>
            <input name="category_id" value="1">

            <div class="m-3 p-3">
                <label class="form-label">summation:</label>
                <textarea class="summation"></textarea>
            </div>
            <button class="btn btn-warning" type="submit">create plan</button>
        </form>
    </div>
@endsection
