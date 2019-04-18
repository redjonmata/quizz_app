@extends('layouts.app')
@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 row">
            <div class="col-12 col-md-12 col-lg-12 question-header">
                <h2 class="text-center">Available tests</h2>
            </div>
            @foreach($tests as $test)
                        {{--<div class="card col-md-4 card-home">--}}
                            {{--<div class="card-header text-center">Completed</div>--}}
                        {{--</div>--}}
                    {{--@else--}}
                        <div class="card col-md-4 card-home">
                            <div class="card-header text-center">{{ $test->name }}</div>
                            <div class="card-body text-center">
                                <h5>Questions: {{ $test->questions_number }}</h5>
                                <h5>Time: {{ $test->timer . " minutes" }}</h5>
                                <a class="text-right" href="{{ url("/tests/$test->id") }}">Take</a>
                            </div>
                        </div>
                    {{--@endif--}}
            @endforeach
        </div>
    </div>
</div>
@endsection
