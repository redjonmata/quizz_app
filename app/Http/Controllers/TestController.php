<?php

namespace App\Http\Controllers;

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

        return redirect(url('/tests/'.$request->input('questions_number').'/questions'));
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
}
