<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Popular currencies</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: black;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        table {
            border-spacing: 7px 11px;
        }

    </style>
</head>
<body>
<h1 style="text-align: center">Popular currencies</h1>

<table align="center">
    <thead>
    <tr>
        <th>&nbsp;</th>
        <th>Name</th>
        <th>Short name</th>
        <th>Actual course</th>
        <th>Actual course date</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($currencies as $currency)
        <tr>
            <td>
                <img src="https://s2.coinmarketcap.com/static/img/coins/16x16/{{ $currency->getId() }}.png" alt="cryptocoin" />
            </td>
            <td>{{ $currency->getName() }}</td>
            <td>{{ $currency->getShortName() }}</td>
            <td>{{ $currency->getActualCourse() }}</td>
            <td>{{ $currency->getActualCourseDate()->format('Y:m:d H:i:s') }}</td>
            <td>{{ $currency->isActive() ? 'active' : 'not active' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
