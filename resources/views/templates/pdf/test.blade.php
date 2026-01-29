<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
     <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; border: none; }
        th, td { padding: 6px; border: none; }

        .header { margin-bottom: 10px; }
        .title {margin-bottim: 10px;}

    </style>
</head>
<body>

<div class="header">

<table width="100%">
    <tr>
        <td width="20%" >
            <img src="{{ public_path('images/bestlink.png') }}" height="60">
        </td>
        <td width="60%" align="center">
            <strong style="font-size:16px;">
                BESTLINK COLLEGE OF THE PHILIPPINES
            </strong>
        </td>
        <td width="20%" align="right">
            <img src="{{ public_path('images/ched.png') }}" height="60">
        </td>
    </tr>
</table>

</div>



<div class="title">
    <h3 style="text-align:center;">Student List</h3>
</div>

<div class="content">
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
                <td style="text-align: center">{{ $i + 1 }}</td>
                <td style="text-align: center">{{ $student->student_number }}</td>
                <td style="text-align: left">{{ $student->first_name }} {{ $student->last_name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>





    
</body>
</html>