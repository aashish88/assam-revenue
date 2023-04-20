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
                <th>Batch Id</th>
                <th>Site ID</th>
                <th>Serial No</th>
            </tr>

        </thead>
        <tbody>
            @foreach ($batchbydata as $res)

                <tr>
                    <td>{{$res->id}}</td>
                    <td>{{$res->batch_id}}</td>
                    <td>{{$res->site_id}}</td>
                    <td>{{$res->serial_no}}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</body>
</html>
