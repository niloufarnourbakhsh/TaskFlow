@extends('layouts.basic')
@section('body')
    @include('layouts.header')

    <div class="container mt-5">
        <div class="row">
            <div class="col-3 ">
                <div class="bg-green-two p-2 rounded-1">
                    <p>{{$plan->description}}</p>
                    <p>{{$plan->summation}}</p>
                    <p>{{$plan->created_at}}</p>
                </div>
            </div>
            <div class="col-1"></div>
            <div class="col-4 bg-green-one rounded-1 pt-2">
                <div>
                    <form action="{{route('tasks.store',$plan->id)}}" method="post">
                        @csrf
                        <input name="body" class="form-control">
                        <input type="hidden" name="status" value="notdone">
                    </form>
                </div>
                <div class="d-flex flex-row">
                    @foreach($plan->tasks as $task)
                        <div class="bg-green-two p-2 px-4 my-2 d-flex flex-column m-auto rounded-1">
                            <p >{{$task->body}}</p>
                            <div >
                            @foreach($statuses as $status)

                                    <input type="radio" name="status" value="{{$status->value}}"
                                           class=" bg-yellow rounded-1">
                                    <label class="my-3 ml-4">{{$status->value}}</label>

                            @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-1"></div>
            <div class="col-3 bg-green-two rounded-1"></div>
        </div>
    </div>

@endsection
