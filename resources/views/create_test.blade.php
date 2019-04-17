@extends('layouts.app')
@section('title', 'Create Tests')

@section('content')
<div class="container" id="home-container">
    <div class="row justify-content-center align-items-center pt-4">
        <div class="col-12 col-md-10 col-lg-8 ">
            <form method="post" action="/create-test" name="Form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <h4 class="form-heading text-center">Create new test for your quizz!</h4>

                <div class="field">
                    <label for="name"> Enter a name for your test </label><br/>
                    <input type="text" class="form-control" id="name" name="name" placeholder=" Name" required>
                </div>

                <div class="field">
                    <label for="description"> Enter a description for your test </label><br/>
                    <textarea type="text" class="form-control" id="description" name="description" placeholder="Description" required></textarea>
                </div>

                <div class="field">
                    <label for="questions_number"> Enter how many questions you want in your test </label><br/>
                    <input type="number" class="form-control" id="questions_number" name="questions_number" placeholder=" Number" required>
                </div>

                <div class="field">
                    <p> Test will be published or not?  </p><br/>
                    <input type="radio" id="published" name="published"/>
                    <label for="published">Published</label>
                    <input type="radio" id="not_published" name="not_published"/>
                    <label for="not_published">Not published</label>
                </div>

                <div class="field">
                    <p> Test will be public or not?  </p><br/>
                    <input type="radio" id="public" name="public"/>
                    <label for="public">Public</label>
                    <input type="radio" id="not_public" name="not_public"/>
                    <label for="not_public">Not public</label>
                </div>

                <div class="field">
                    <label for="timer"> How much is your test going to last? </label><br/>
                    <input type="number" class="form-control" id="timer" name="timer" placeholder=" Minutes" required>
                </div>

                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary" id="email-submit-btn">Review test</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
