@extends('layouts.basic')
@section('body')
    @include('layouts.header')
    <div class="horizontal-line"></div>
    <div class="container">
        <div class="row row-cols-3 p-2 mt-5">
            @forelse($plans as $plan)
                <div class="col my-3 ">
                <div class="card bg-green-two">
                    <a href="{{route('plans.show',$plan->id)}}">
                        <div class="body p-3">
                            {{\Illuminate\Support\Str::limit($plan->description,120)}}
                        </div>
                    </a>
                    <div class="d-flex flex-row justify-content-between">
                        <form action="{{route('plans.destroy',$plan->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" name="delete">
                                <i class="fa-solid fa-square-minus px-3 t-red"></i>
                            </button>
                        </form>
                        <p class="px-2 py-1 m-1">{{$plan->created_at}}</p>
                    </div>
                </div>
            </div>
            @empty
                No Content Yet
            @endforelse
        </div>
    </div>

@endsection
