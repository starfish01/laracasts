<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Create a new project</h1>

    <form method="POST" action="/projects">
    {{ csrf_field() }}

        <div>
            <input type="text" placeholder="Project title" name="title">
        </div>
        <div>
            <textarea placeholder="description" name="description"></textarea>
        </div>
        <div>
            <button type="submit">Create Project</button>
        </div>
    </form>

</body>
</html>
