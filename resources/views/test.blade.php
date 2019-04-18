@extends('layouts.app')
@section('title', 'Test ' . $test->id)


@section('content')
<div class="container" id="home-container">
    <div class="row justify-content-center align-items-center pt-4">
        <div class="col-12 col-md-10 col-lg-10 ">
            <h3 class="form-heading text-center"> {{ $test->description }}</h3>
            <form method="post" action="/tests/{{ $test->id }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <ul>
                    @foreach($questions as $idx => $question)
                        <div class="col-lg-12 text-center add-question">
                            <li>
                                <h5 class="form-heading text-left"> {{ $question->text }}</h5>
                                @foreach($question->answers as $index => $answer)
                                    <div class="text-left">
                                        @if($question->type == "single")
                                            <label for="answer_{{$idx}}_{{$index}}">
                                                <input
                                                    type="radio"
                                                    value="{{$answer->text}}"
                                                    id="answer_{{$idx}}_{{$index}}"
                                                    name="answers[{{$idx}}][0]"
                                                />
                                                <span>{{ $answer->text }}</span>
                                            </label>
                                        @elseif($question->type == "multiple")
                                            <label for="answer_{{$idx}}_{{$index}}">
                                                <input
                                                    value="{{$answer->text}}"
                                                    type="checkbox"
                                                    id="answer_{{$idx}}_{{$index}}"
                                                    name="answers[{{$idx}}][{{$index}}]"
                                                />
                                                <span>{{ $answer->text }}</span>
                                            </label>
                                        @else
                                            <input
                                                id="answer_{{$idx}}_{{$index}}"
                                                class="form-control"
                                                name="answers[{{$idx}}][{{$index}}]"
                                                type="text"
                                                placeholder="Answer"
                                            />
                                        @endif
                                    </div>
                                @endforeach
                            </li>
                        </div>
                    @endforeach
                    {{--<input type="hidden" name="explination_number" value="{{$explination}}">--}}
                </ul>
                <div class="col-lg-12 text-center add-question">
                    <button type="submit" id="submit" class="btn btn-success">Submit test</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
