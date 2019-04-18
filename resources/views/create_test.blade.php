@extends('layouts.app')
@section('title', 'Create Tests')

@section('content')
<div class="container" id="home-container">
    <div class="row justify-content-center align-items-center pt-4">
        <div class="col-12 col-md-10 col-lg-8 ">
            <form method="post" action="/create-test" name="Form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <h4 class="form-heading text-center">Create new test for your quiz!</h4>

                <div class="field field-create">
                    <label class="label-input" for="name"> Enter a name for your test </label><br/>
                    <input type="text" class="form-control" id="name" name="name" placeholder=" Name" required>
                </div>

                <div class="field field-create">
                    <label class="label-input" for="description"> Enter a description for your test </label><br/>
                    <textarea type="text" class="form-control" id="description" name="description" placeholder="Description" required></textarea>
                </div>

                <div class="field field-create">
                    <label class="label-input" for="questions_number"> Enter how many questions you want in your test </label><br/>
                    <input type="number" class="form-control" id="questions_number" name="questions_number" placeholder=" Number" required>
                </div>

                <div class="field field-create">
                    <p class="label-input"> Test will be published or not?  </p><br/>

                    <label for="published">Published <input type="radio" value="1" id="published" name="published"/></label>

                    <label for="not_published">Not published <input value="2" type="radio" id="not_published" name="published"/></label>
                </div>

                <div class="field field-create">
                    <p class="label-input"> Test will be public or not?  </p><br/>

                    <label for="public">Public <input type="radio" value="1" id="public" name="public"/></label>

                    <label for="not_public">Not public <input type="radio" value="2" id="not_public" name="public"/></label>
                </div>

                <div class="field field-create">
                    <label class="label-input" for="timer"> How much is your test going to last? </label><br/>
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
