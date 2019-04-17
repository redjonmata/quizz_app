<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\Test;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function showTests()
    {
        return view('create_test');
    }

    public function createTests(Request $request)
    {
        $test = new Test;

        $test->name = $request->input('name');
        $test->description = $request->input('description');
        $test->questions_number = $request->input('questions_number');
        $test->timer = $request->input('timer');

        if($request->input('published') == 'on') {
            $test->published = "yes";
        } else {
            $test->published = "no";
        }

        if($request->input('public') == 'on') {
            $test->public = "yes";
        } else {
            $test->public = "no";
        }

        $test->save();

        return redirect(url('/tests/'.$test->id.'/questions'));
    }

    public function reviewTests()
    {
        $tests = Test::all();

        return view('tests_review')->with('tests', $tests);
    }

    public function showTest($testId)
    {
        $test = Test::where('id', $testId)->first();

        $questions = Question::where('test_id', '=', $testId)->get();

        if (!$test) {
            return back();
        }

        return view('single_test')->with(compact('test', 'questions'));
    }

    public function deleteTest($testId)
    {
        Test::destroy($testId);

        return redirect(url('/review-tests'));
    }

    public function addQuestions(Request $request, $testId)
    {
        $test = Test::where('id', $testId)->first();

        $question = new Question;

        $question->test_id = $testId;
        $question->text = $request->input('question');
        $question->type = $request->input('type');
        $question->answers_number = $request->input('number');

        $update = $question->save();

        if ($update) {
            for ($x = 1; $x <= 6; $x++) {
                if($request->input('answer_' . $x) != '') {
                    $answer = new Answer;

                    $answer->question_id = $question->id;
                    $answer->text = $request->input('answer_' . $x);

                    if ($request->input('correct_' . $x) == 'on') {
                        $answer->is_correct = "yes";
                    } else {
                        $answer->is_correct = "no";
                    }

                    $answer->save();
                }
             }
        }

        return redirect(url('/tests/'. $test->id.'/questions'));
    }
}
