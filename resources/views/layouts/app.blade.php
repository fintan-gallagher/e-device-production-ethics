<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Store</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('records.index') }}">Show all records</a></li>
                <li><a href="{{ route('records.create') }}">Add a record</a></li>
            </ul>
        </nav>
    </header>

    <main>
        @yield ('content')
    </main>
</body>
</html>
