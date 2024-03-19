<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach ($projects as $project)
        {{$project->title}}
        @foreach ($project->skills as $skill)
            {{$skill->name}}
        @endforeach
        <br>
    @endforeach
</body>
</html>