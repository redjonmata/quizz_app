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

        return view('single_test')->with('test', $test);
    }

    public function reviewTests()
    {
        $tests = Test::all();

        return view('tests_review')->with('tests', $tests);
    }

    public function showTest($testId)
    {
        $test = Test::where('id', $testId)->first();

        if (!$test) {
            return back();
        }

        return view('single_test')->with('test', $test);
    }

    public function deleteTest($testId)
    {
        Test::destroy($testId);

        return redirect(url('/review-tests'));
    }

    public function addQuestions(Request $request, $testId)
    {
        $test = Test::where('id', $testId)->first();

        for($x = 1; $x<=$test->questions_number; $x++) {
            $question = new Question;

            $question->test_id = $testId;
            $question->text = $request->input('question_'. $x);
            $question->type = "type";
            $question->answers_number = 1;

            $update = $question->save();
        }

        if($update) {
            for ($x = 1; $x <= $test->questions_number; $x++) {
                for($y = 1; $y<=4; $y++) {
                    $answer = new Answer;

                    $answer->question_id = $question->id;
                    $answer->text = $request->input('question_'.$x.'_answer_'.$y);
                    $answer->is_correct = "false";

                    $answer->save();
                }
            }
        }


        return redirect(url('/'));
    }
}
