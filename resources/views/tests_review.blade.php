<!DOCTYPE html>
<html>
<head>
    <title>Review tests </title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="/design/theme/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div class="container" id="home-container">
    <div class="row justify-content-center align-items-center pt-4">
        <div class="col-12 col-md-10 col-lg-10 ">
            <h4 class="form-heading text-center">Click the test you want to review it.</h4>
            <div class="example table-responsive">
                <table class="table">
                    <thead class="thead-success">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Questions Number</th>
                        <th>Public</th>
                        <th>Published</th>
                        <th colspan="2">&nbsp&nbspAction</th>
                    </tr>
                    </thead>
                    @foreach($tests as $test)
                        <tbody>
                        <tr>
                            <td class="alignment">{{ $test->id }}</td>
                            <td class="alignment"><a href="{{ url("/tests/$test->id/questions") }}">{{ $test->name }}</a></td>
                            <td class="alignment">{{ $test->questions_number }}</td>
                            <td class="alignment">{{ $test->public }}</td>
                            <td class="alignment">{{ $test->published }}</td>
                            <td class="alignment"><button class="btn btn-danger" id="delete-"> Delete </button></td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="col-12 col-md-10 col-lg-10 text-right">
            <a href="/create-test" class="btn btn-primary" id="add_new"> Add Test </a>
        </div>
    </div>
</div>
</body>
</html>