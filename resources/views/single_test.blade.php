<!DOCTYPE html>
<html>
<head>
    <title>Review tests </title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body>
<div class="container" id="home-container">
    <div class="row justify-content-center align-items-center pt-4">
        <form method="post" action="/tests/{{ $test->id }}/questions" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 question-header">
                    <h2 class="text-center">Add questions</h2>
                </div>
                <div class="col-12 col-md-12 col-lg-12 input-question-header">
                    <label for="name"> Enter your question. </label><br/>
                    <input style="margin-bottom: 10px" type="text" class="form-control" name="question" placeholder=" Question ">
                </div>
                @for($x = 1; $x<=6; $x++)
                    <div class="col-md-6 col-xs-12 col-lg-6 ">
                        <label for="name"> Answer number {{ $x }} </label><br/>
                        <input style="margin-bottom: 10px" type="text" class="form-control" name="answer_{{ $x }}" placeholder=" Question {{ $x }}">
                        <label for="correct"> Correct </label>
                        <input type="checkbox" name="correct_{{ $x }}" placeholder=" Question ">
                    </div>
                @endfor
                <div class="col-lg-12 text-center add-question">
                    <button type="submit" id="submit" class="btn btn-success">Add question</button>
                </div>
            </div>
        </form>
        {{--<input type="hidden" id="number" value="{{ $test->questions_number }}" />--}}
        {{--<div class="col-12 col-md-10 col-lg-10 ">--}}
            {{--<form method="post" action="/tests/{{$test->id}}/questions" name="Form" enctype="multipart/form-data">--}}
                {{--{{ csrf_field() }}--}}
                {{--<h4 class="form-heading text-center">Complete the test by adding your questions.</h4>--}}
                {{--@for($x = 1; $x<=$test->questions_number; $x++)--}}
                    {{--<div style="margin: 10px" class="field">--}}
                        {{--<input type="hidden" value="{{ $x }}" class="questions">--}}
                        {{--<label for="name"> What will be your question number {{ $x }} ? </label><br/>--}}
                        {{--<input style="margin-bottom: 10px" type="text" class="form-control" name="question_{{$x}}" placeholder=" Question {{$x}}">--}}
                        {{--<button type="button" class="btn btn-primary" id="add_new_{{ $x }}"> Add Answer </button>--}}
                    {{--</div>--}}
                {{--@endfor--}}
                {{--<div class="col-lg-12 text-center">--}}
                    {{--<div class="panel-body">--}}
                        {{--<button type="submit" id="submit" class="btn btn-success">Save Changes</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</form>--}}
        {{--</div>--}}
    </div>
</div>
</body>

<script>
    // var questions_number = document.getElementById('number').value;
    // var is_clicked = 0;
    //
    // for(var i = 1; i<= questions_number; i++) {
    //     $('#add_new_'+i).click(function () {
    //         is_clicked++;
    //         var field = $(this).closest('div');
    //         var question = $(this).siblings('.questions').val();
    //         field.append('<input type="text" class="answer" name="question_'+question+'_answer_'+is_clicked+'" placeholder="Answer" />');
    //     });
    // }


</script>

</html>
