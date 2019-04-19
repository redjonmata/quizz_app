@extends('layouts.app')
@section('title', 'Test ' . $test->id)


@section('content')
<div class="container" id="home-container">
    <div class="row justify-content-center align-items-center pt-4">
        <div class="col-12 col-md-10 col-lg-10 ">

            <div class="col-12 text-center">
                <input type="hidden" value="{{$test->timer}}" id="test_time">
                <h5 id="time">Time remaining: {{ $test->timer }}:00 minutes!</h5>
            </div>

            <h3 class="form-he1ading text-center"> {{ $test->description }}</h3>
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
                </ul>
                <div class="col-lg-12 text-center add-question">
                    <button type="submit" id="submit" class="btn btn-success">Submit test</button>
                    <a href id="reset" class="btn btn-primary d-none text-white">Retry</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


<script>
    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        const interval = setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            display.textContent = 'Time remaining: ' + minutes + ":" + seconds + ' minutes!';

            if (--timer < 0) {
                clearInterval(interval);
                display.textContent = "Time is up!";
                const btn = document.querySelector('#submit');
                const resetBtn = document.querySelector('#reset');
                btn.classList.add('disabled');
                btn.disabled = true;
                resetBtn.classList.remove('d-none');
            }
        }, 1000);
    }

    window.onload = function () {
        var test_time = document.getElementById('test_time').value;
        var seconds = 60 * test_time - 1,
            display = document.querySelector('#time');
            startTimer(seconds, display);
    };

</script>
