@extends('layouts.app')
@section('title', 'Review test ' . $test->id)

@section('content')
<div class="container" id="home-container">
    <div class="row justify-content-center align-items-center pt-4">

        <div class="col-12 col-md-10 col-lg-10 ">
            <h4 class="form-heading text-center"> Questions for test number {{ $test->id }}</h4>
            <div class="example table-responsive">
                <table class="table">
                    <thead class="thead-success">
                    <tr>
                        <th>Id</th>
                        <th>Question</th>
                        <th>Type</th>
                        <th>Answers Number</th>
                        <th>Created</th>
                    </tr>
                    </thead>
                    @foreach($questions as $question)
                        <tbody>
                        <tr>
                            <td class="alignment">{{ $question->id }}</td>
                            <td class="alignment">{{ $question->text }}</td>
                            <td class="alignment">{{ $question->type }}</td>
                            <td class="alignment">{{ $question->answers_number }}</td>
                            <td class="alignment">{{ $question->created_at }}</td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>

        <form method="post" action="/tests/{{ $test->id }}/questions" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 question-header">
                    <h2 class="text-center">Add questions</h2>
                </div>
                <div class="col-12 col-md-8 col-lg-8 input-question-header">
                    <label class="label-input" for="name"> Enter your question. </label><br/>
                    <input style="margin-bottom: 10px" type="text" class="form-control" name="question" placeholder=" Question " required>
                </div>
                <div class="col-12 col-md-2 col-lg-2 input-question-header">
                    <label class="label-input" for="name"> Question type </label><br/>
                    <input style="margin-bottom: 10px" type="text" class="form-control" name="type" placeholder=" Type " required>
                </div>
                <div class="col-12 col-md-2 col-lg-2 input-question-header">
                    <label class="label-input" for="name"> Answers number </label><br/>
                    <input style="margin-bottom: 10px" type="number" class="form-control" name="number" placeholder=" Number " required>
                </div>
                @for($x = 1; $x<=6; $x++)
                    <div class="col-md-6 col-xs-12 col-lg-6 ">
                        <label class="label-input" for="name"> Answer number {{ $x }} </label><br/>
                        <input style="margin-bottom: 10px" type="text" class="form-control" name="answer_{{ $x }}" placeholder=" Question {{ $x }}">
                        <label for="correct"> Correct
                            <input type="checkbox" name="correct_{{ $x }}" placeholder=" Question ">
                        </label>
                    </div>
                @endfor
                <div class="col-lg-12 text-center add-question">
                    <button type="submit" id="submit" class="btn btn-success">Add question</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

