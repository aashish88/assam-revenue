@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<style>
    .pagination {
        margin: 00 00 00 872px;
    }
    
    .headercsv {
        font-weight: bold;
    }
    
    .item-list-batch {
        margin: 10px 00px 00px 12px;
    }
    .card-title{
        /*background: rgb(119, 185, 216);*/
    align-content: center;
    margin: 15px 1px 1px 143px;
    }

    .ajaxitemheader{
        text-align: justify;
        font-size: 18px;
    }
    
    .table th, .table tr .ask_td {
        white-space: inherit;
    }
</style>
        <div class="content-wrapper">
                @if (session('success'))
                        <div id="hideDivAlert">
                            <div class="alert alert-success mt-4 d-flex align-items-center hideDivAlert">
                                <div class="row"><i class="menu-icon mdi mdi-login-variant"></i> &nbsp;
                                    <p>
                                        {{ session('success') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
        
        
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                            
                                <h4 class="headertext">Mapping Vendor Site:</h4><br>
                                <a href="#" class="export">Export Table data into Excel</a><br>
                               
                                   
                                <div class="row" id="dvData" style="overflow: scroll">
                                    <table class="table table-striped">
                                        <tr class="headercsv">
                                                <td>#</td>
                                                <td>Site ID</td>
                                                <td>District Headquarter</td>
                                                <td>Address</td>
                                                <td>District Site</td>
                                                <td>Infra Status</td>
                                                <td>Status</td>
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
                                                <td class="ask_td">{{ $res->site_id }}</td>
                                                <td class="ask_td">{{ $res->dst_head_quert }}</td>
                                                <td class="ask_td">{{ $res->add_w_pincode }}</td>
                                                <td class="ask_td">{{ $res->dst_site }}</td>
                                                <td>
                                                    @if ($res->status == 2)
                                                    Inprogress
                                                    @elseif ($res->status == 4)
                                                    Completed
                                                    @else
                                                    Unassign
                                                    @endif
                                                </td>
                                                
                                                <td>
                                                @if ($res->newStatus == 8)
                                                Completed
                                                @else
                                                Work In Progress
                                                @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div><br>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
        </div>
        
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
@endsection