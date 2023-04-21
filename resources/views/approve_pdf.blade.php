<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BOQ SERIAL NO</title>
    <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: center;
  padding: 8px;

}

tr:nth-child(even) {
  background-color: #dddddd;
}
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
            <th>#</th>
            <th>Item Name</th>
            <th>Item Type</th>
            <th>Serial No</th>
            <th>Approve</th>
            <th>Disapprove</th>
            <th>Remark</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 0;
            @endphp
            @foreach ($serialdata as $res)
            @php
                $i++
            @endphp
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$res->item_title}}</td>
                    <td>{{$res->site_id}}</td>
                    <td>{{$res->serial_no}}</td>
                    <td>
                        @if ($res->officer_status == 1) Yes
                        @else NA @endif
                    </td>
                    <td>@if ($res->officer_status == 0) Yes
                        @else NA @endif </td>
                    <td>{{$res->officer_status}}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</body>
</html>


