<!doctype html>
<html lang="tr">
<head>
    <title>Todo Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        table, th, td, tr {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body class="">
<h2 style="text-align: center">TODO DASHBOARD</h2>
<div class="col-md-12" style="display: flex;">
    <div class="col-md-10" style=" margin-left: 20px;">
        <div class="">
            <table class="table table-bordered">
                <thead>
                </thead>
                <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <th>{{ $task['week'] }}</th>
                        @foreach ($task['developers'] as $key => $developer)
                            <td>
                                <div>
                                    <h4 class="card-header p-0 m-0"
                                        style="background-color: #a0aec0; text-align: center"> {{ $key }}</h4>
                                    <div>
                                        <span>Total Task Count = {{ $developer['detail']['totalTasks'] }} </span><br>
                                        <span>Total Assigned Hour = {{ $developer['detail']['totalHours'] }} </span>
                                    </div>
                                </div><br>
                                <div>
                                    <span>Performance</span>
                                    <progress id="file" value="{{ $developer['detail']['totalHours'] }}" max="45"></progress>
                                </div>

                                <br>
                                <h5 class="card-header p-0 m-0" style="background-color: #e2e8f0; text-align: center;">
                                    Task List</h5>
                                @foreach ($developer['planning'] as $list)
                                    <div class="card col-md-12 my-2 p-1">
                                        <h5 class="card-header p-0 m-0">{{ $list['name'] }}</h5>
                                        <div class="card-body p-0">
                                            <div>
                                                <span>Difficulty = {{ $list['difficulty'] }}</span>
                                                <span>Duration = {{ $list['duration'] }}</span>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
