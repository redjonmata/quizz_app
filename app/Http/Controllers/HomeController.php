<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;
use App\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $taken = DB::table('user_tests')->where('user_id', Auth::id())->get();
        $tests = Test::with('questions')
                    ->where('public', 'yes')
                    ->where('questions_number', '!=', '0')
                    ->where('published', 'yes')
                    ->get();

        $takenIds = $taken->pluck('result','test_id')->toArray();

        return view('home')->with(compact('tests', 'takenIds'));
    }

    public function takeTest($testId)
    {
        $userTest = DB::table('user_tests')
                        ->where('user_id', auth()->user()->id)
                        ->where('test_id', $testId)
                        ->first();

        if (!empty($userTest)) {
            return redirect(url('/'))->with('error', 'You have already completed this test!');
        }

        $test = Test::where('id', $testId)->first();
        $questions = $test->questions;

        return view('test')->with(compact('test', 'questions'));
    }

    public function submitTest(Request $request, $testId)
    {
        $questions = Question::with('answers')->where('test_id', $testId)->get()->toArray();
        $answers = $request->get('answers');
        $result = 0;

        foreach ($questions as $key => $question) {
            $correct = array_filter(
                $question['answers'],
                function ($ans) {
                    return $ans['is_correct'] == 'yes';
                }
            );
            if ($question['type'] == 'single') {
                $correct2 = array_values($correct);
                if ($answers[$key][0] == $correct2[0]['text']) {
                    $result++;
                }
            } elseif ($question['type'] == 'multiple') {
                if (count($answers[$key]) === count($correct)) {
                    if (array_diff(array_column($correct, 'text'), $answers[$key]) == []) {
                        $result++;
                    }
                }
            } else {
                if ($answers[$key][0] == $correct[0]['text']) {
                    $result++;
                }
            }
        }
        DB::table('user_tests')->insert([
            'user_id' => Auth::id(),
            'result' => $result,
            'test_id' => $testId
        ]);

        return redirect(url('/'));
    }
}
