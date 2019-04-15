<!DOCTYPE html>
<html>
<head>
    <title>Review tests </title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="/design/theme/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body>
<div class="container" id="home-container">
    <div class="row justify-content-center align-items-center pt-4">
        <div class="col-12 col-md-10 col-lg-10 ">
            <h4 class="form-heading text-center">Click the test you want to review.</h4>
            @for($x = 1; $x<=$test->questions_number; $x++)
                <div class="field">
                    <input type="hidden" value="{{ $x }}" class="questions">
                    <label for="name"> What will be your question number {{ $x }} ? </label><br/>
                    <input type="text" class="form-control" id="question_{{$x}}" name="question_{{$x}}" placeholder=" Question {{$x}}" required>
                    <a style="cursor:pointer;" class="btn btn-primary add_new"> Add Answer </a>
                </div>
            @endfor
        </div>
    </div>
</div>
</body>

<script>
    var questions = document.getElementsByClassName('questions')[0].value;

    $('.add_new').click(function () {
        var field = $(this).closest('div');
            field.append('<input type="text" class="answer" placeholder="Answer" />');
    });
</script>

</html>
