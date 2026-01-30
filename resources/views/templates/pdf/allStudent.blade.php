<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
    @page {
        margin: 120px 50px 80px 50px; /* top right bottom left */
    }

    .pagenum:before { content: counter(page); }

    body { font-family: DejaVu Sans, sans-serif; }

    header {
        position: fixed;
        top: -100px;  /* negative top pushes inside page margin */
        left: 0;
        right: 0;
        height: 100px;
        text-align: center;
    }

    footer {
        position: fixed;
        bottom: -50px;
        left: 0;
        right: 0;
        height: 50px;
        text-align: center;
        font-size: 12px;
    }

    table { width: 100%; border-collapse: collapse;}
    th, td { padding: 6px; border:  none; }

    .content { 
        margin-top: 40px;
        margin-bottom: 50px;
    }
</style>

</head>
<body>

<header>
    <table width="100%">
        <tr>
            <td width="15%">
                <img src="{{ public_path('images/bestlink.png') }}" height="60">
            </td>
            <td width="70%" align="center">
                <strong>Bestlink College of the Philippines - Bulacan Inc.</strong>
                <span style="display: block; font-size:12px;">Lot 1 Ipo Road, Minuyan Proper, 
                    City of San Jose Del Monte, Bulacan
                </span>
                <span style="display: block; font-size:11px;">(044) 797-2949</span>
            </td>
            <td width="15%" align="right">
                <img src="{{ public_path('images/ched.png') }}" height="60">
            </td>
        </tr>
    </table>
</header>

<footer>
    Page <span class="pagenum"></span>
</footer>

<div class="content">
    <h3 style="text-align:center;">Student List {{ $data ? "($data)" : "" }}</h3>

    <table width="100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Student ID</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $i => $student)
            <tr>
                <td style="text-align: center">{{  $i + 1 }}</td>
                <td style="text-align: center">{{ $student->student_number }}</td>
                <td>{{ $student->first_name }} {{ $student->last_name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>

</html>