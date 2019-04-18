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
                    <?php $explination = 1; ?>
                    @foreach($questions as $question)
                        <div class="col-lg-12 text-center add-question">
                            <li>
                                <h5 class="form-heading text-left"> {{ $question->text }}</h5>
                                @if($question->type == "Single")
                                    @foreach($question->answers as $answer)
                                        <label for="{{$answer->text}}">{{ $answer->text }} <input type="radio" id="published" name="{{$answer->text}}"/></label>
                                    @endforeach
                                @elseif($question->type == "Multiple")
                                    @foreach($question->answers as $a_index => $answer)
                                        <label for="{{$answer->text}}">{{ $answer->text }} <input type="checkbox" id="published" name="{{$answer->text}}"/></label>
                                    @endforeach
                                @else
                                    <?php $explination++ ?>
                                    <input class="form-control" name="answer_{{$explination}}" type="text" placeholder="Answer"/>
                                @endif
                            </li>
                        </div>
                    @endforeach
                    <input type="hidden" name="explination_number" value="{{$explination}}">
                </ul>
                <div class="col-lg-12 text-center add-question">
                    <button type="submit" id="submit" class="btn btn-success">Submit test</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
