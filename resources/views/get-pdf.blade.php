<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
        a.export,
        a.export:visited {
            display: inline-block;
            text-decoration: none;
            color: #000;
            background-color: #ddd;
            border: 1px solid #ccc;
            padding: 8px;
        }
    </style>
</head>

<body>
    <div id="dvData">
        <table>
            <tr>
                <th>ID</th>
                <th>Site ID</th>
                <th>dst_head_quert</th>
                <th>add_w_pincode</th>
                <th>Dst Site</th>
                
            </tr>

            @php
                $i = 0;
            @endphp
            @foreach ($data as $res)
            @php
                $i++;
            @endphp
            <tr>
                <td>{{$i}}</td>
                <td>{{ $res->site_id }}</td>
                <td>{{ $res->dst_head_quert }}</td>
                <td>{{ $res->add_w_pincode }}</td>
                <td>{{ $res->dst_site }}</td>
            </tr>
            @endforeach



        </table>
    </div>
    <a href="#" class="export">Export Table data into Excel</a>
    <script>
        $(document).ready(function() {

            function exportTableToCSV($table, filename) {

                var $rows = $table.find('tr:has(td)'),

                    // Temporary delimiter characters unlikely to be typed by keyboard
                    // This is to avoid accidentally splitting the actual contents
                    tmpColDelim = String.fromCharCode(11), // vertical tab character
                    tmpRowDelim = String.fromCharCode(0), // null character

                    // actual delimiter characters for CSV format
                    colDelim = '","',
                    rowDelim = '"\r\n"',

                    // Grab text from table into CSV formatted string
                    csv = '"' + $rows.map(function(i, row) {
                        var $row = $(row),
                            $cols = $row.find('td');

                        return $cols.map(function(j, col) {
                            var $col = $(col),
                                text = $col.text();

                            return text.replace(/"/g, '""'); // escape double quotes

                        }).get().join(tmpColDelim);

                    }).get().join(tmpRowDelim)
                    .split(tmpRowDelim).join(rowDelim)
                    .split(tmpColDelim).join(colDelim) + '"';

                // Deliberate 'false', see comment below
                if (false && window.navigator.msSaveBlob) {

                    var blob = new Blob([decodeURIComponent(csv)], {
                        type: 'text/csv;charset=utf8'
                    });

                    // Crashes in IE 10, IE 11 and Microsoft Edge
                    // See MS Edge Issue #10396033
                    // Hence, the deliberate 'false'
                    // This is here just for completeness
                    // Remove the 'false' at your own risk
                    window.navigator.msSaveBlob(blob, filename);

                } else if (window.Blob && window.URL) {
                    // HTML5 Blob
                    var blob = new Blob([csv], {
                        type: 'text/csv;charset=utf-8'
                    });
                    var csvUrl = URL.createObjectURL(blob);

                    $(this)
                        .attr({
                            'download': filename,
                            'href': csvUrl
                        });
                } else {
                    // Data URI
                    var csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

                    $(this)
                        .attr({
                            'download': filename,
                            'href': csvData,
                            'target': '_blank'
                        });
                }
            }

            // This must be a hyperlink
            $(".export").on('click', function(event) {
                // CSV
                var args = [$('#dvData>table'), 'tabla.csv'];
                exportTableToCSV.apply(this, args);
                // If CSV, don't do event.preventDefault() or return false
                // We actually need this to be a typical hyperlink
            });
        });
    </script>
</body>

</html>
