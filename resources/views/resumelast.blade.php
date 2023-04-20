<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Batch No: 1</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="table-responsive pt-3" style="margin: 0 auto;display: block;width: 500px;">
        <h2 style="text-align: center;">Assam Revanue Mangement System</h2>
        <h3>List of Batch B-001 Items For Approval by store Officer Sunil Dated: {{ $datanew['date'] }} </h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Item Name</th>
                    <th>Item Type</th>
                    <th>Item</th>
                    <th>Quantity</th>

                </tr>
            </thead>
            <tbody class="tbody">
                @php
                    $i = 0;
                @endphp
                @foreach ($datanew['batchbydata'] as $res)
                @php
                    $i++;
                @endphp
                    <tr>
                        {{-- <input type="hidden" value="{{ $res->site_id }}" class="site_values"> --}}
                        <td>{{ $i }}</td>
                        <td>{{ substr($res->item_title, 0, 10) }}</td>
                        <td>{{ substr($res->item_title, 0, 70) }}</td>
                        <td>{{ $res->item }}</td>
                        <td>{{ $res->qty }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
