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
        $test->questions_number = 0;
        $test->timer = $request->input('timer');

        if($request->input('published') == '1') {
            $test->published = "yes";
        } else {
            $test->published = "no";
        }

        if($request->input('public') == '1') {
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

        $answers = array_filter(
            $request->get('answer'),
            function ($value) {
                return (bool) $value['text'];
            }
        );

        $info = array_reduce(
            $answers,
            function ($current, $value) {
                return [
                    'answers' => $current['answers'] + ($value['text'] ? 1 : 0),
                    'correct' => $current['correct'] + (isset($value['correct']) ? 1 : 0),
                ];
            }, [
                'answers' => 0,
                'correct' => 0,
            ]
        );

        if ($info['answers'] == 1) {
            $question->type = "explanation";
        } elseif ($info['answers'] > 1 && $info['correct'] == 1) {
            $question->type = "single";
        } else {
            $question->type = "multiple";
        }

        $question->answers_number = count($answers);

        $update = $question->save();

        if ($update) {
            $test->questions_number++;
            $test->save();
            foreach ($answers as $requestAnswer) {
                $answer = new Answer;
                $answer->question_id = $question->id;
                $answer->text = $requestAnswer['text'];
                $answer->is_correct = (isset($requestAnswer['correct'])) ? "yes" : "no";

                $answer->save();
            }
        }

        return redirect(url('/tests/'. $test->id.'/questions'));
    }

    public function makeTestPublic($testId)
    {
        Test::where('id', $testId)
            ->update(['public' => 'yes']);

        return redirect(url('/review-tests'));
    }

    public function publishTest($testId)
    {
        Test::where('id', $testId)
            ->update(['published' => 'yes']);

        return redirect(url('/review-tests'));
    }
}
