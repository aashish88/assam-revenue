<!DOCTYPE html>
<html lang="en">
<body>
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
            @foreach ($batchbydata as $res)
                <tr>
                    <input type="hidden" value="{{ $res->site_id }}" class="site_values">
                    <td>{{ $res->id }}</td>
                    <td>{{ substr($res->item_title, 0, 10) }}</td>
                    <td>{{ substr($res->item_title, 0, 70) }}</td>
                    <td>{{ $res->item }}</td>
                    <td>
                       5
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
