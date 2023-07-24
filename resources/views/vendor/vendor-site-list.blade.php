@extends('layouts.app')
@section('content')



<!DOCTYPE html>
<html >
<head>
    <style>
        body{

        background-color: #eee;
        }
        .container {
            overflow:scroll;

        }

        table th , table td{
        text-align: center;
        }

        table tr:nth-child(even){
        background-color: #BEF2F5
        }

        .pagination li:hover{
            cursor: pointer;
            padding: 10px;
        }
        table tbody tr {
            display: none;

        }
        .pagination>li>span:hover{
            z-index: 2;
            color:blue;
            background-color:white;
            border-color:black;
        }
        .pagination>li:first-child>span{
            margin-left:0;
            border-top-left-radius:4px;
            background-color:lightblue;
            border-bottom-left-redius:4px;
        }
        .pagination>li>span{
            position: relative;
            float:left;
            background-color:lightblue;
            padding:6px 12px;
            line-height:1.5;
            text-decoration:none;
            border:1px solid white;
        }



    </style>


</head>
<body>


		<div class="container">
		<h2>Site Activity Work Status</h2>

        <div class="col-sm-11"></div>


                        <div class="col-sm-11">
                            {{--Send Data Admin To Officer and Review--}}
                            <div class="modal-footer modifyDatabatchIdGet">
                                <p id="getInputll" name="batch_id" class="btn btn-info btn-rounded mr-2" style="">Request for Site Item</p>
                            </div>
                        </div>


				<div class="form-group"> 	<!--		Show Numbers Of Rows 		-->
			 		<select class  ="form-control" name="state" id="maxRows">
						 <option value="5000">Show ALL Rows</option>
						 <option value="5">5</option>
						 <option value="10">10</option>
						 <option value="15">15</option>
						 <option value="20">20</option>
						 <option value="50">50</option>
						 <option value="70">70</option>
						 <option value="100">100</option>
						</select>

			  	</div>






<table class="table table-striped table-class" id= "table-id">

  <thead>
	<tr>
    <th>#</th>
		<th>Site Id</th>
		<th>Site Name</th>
		<th>Site Address </th>
		<th>Site Officer</th>
        <th>Work Start Date</th>
        <th>Work End Date</th>
        <th>Priority</th>
        <th>Allocated Engineer Name</th>
        <th>Status</th>

	</tr>

  </thead>

  <tbody>
                                      <!-- @foreach ($data as $res)

                                      <td>{{ $res->id}}</td>
                                      <td>{{ $res->site_id }}</td>
                                      <td>{{ $res->dst_head_quert }}</td>
                                      <td>{{ $res->site_add_w_pincode }}</td>
                                      <td>{{ $res->site_id }}</td>
                                      <td>{{ $res->date }}</td>
                                      <td>{{ $res->end_date }}</td>

                                      <td>{{ $res->priority }}</td>
                                      @endforeach
                                      @foreach ($user as $res)
                                      <td>{{ $res->site_id }}</td>
                                      @endforeach
                                      @foreach ($data as $res)
                                      <td>{{ $res->status }}</td>


                                      @endforeach
                                     -->

                                     @foreach ($data as $key => $res)
        <tr>
            <td>{{ $res->id }}</td>
            <td>{{ $res->site_id }}</td>
            <td>{{ $res->dst_head_quert }}</td>
            <td>{{ $res->site_add_w_pincode }}</td>
            <td></td>
            <td>{{ $res->date }}</td>
            <td>{{ $res->end_date }}</td>
            <td>{{ $res->priority }}</td>
            @if(isset($user[$key]))
                <td>{{ $user[$key]->name }}</td>
                <td>{{ $user[$key]->status }}</td>
            @endif

        </tr>
    @endforeach

       </tbody>


	</table>

<!--		Start Pagination -->
			<div class='pagination-container' >
				<nav>
				  <ul class="pagination">

            <li data-page="prev" >
								     <span> < <span class="sr-only">(current)</span></span>
								    </li>
				   <!--	Here the JS Function Will Add the Rows -->
            <li data-page="next" id="prev">
                                        <span> > <span class="sr-only">(current)</span></span>
                                        </li>
                    </ul>
                </nav>
            </div>

</div> <!-- 		End of Container -->





</body>
</html>
<script>

function getPagination(table) {
  var lastPage = 1;

  $('#maxRows')
    .on('change', function(evt) {
      //$('.paginationprev').html('');						// reset pagination

     lastPage = 1;
      $('.pagination')
        .find('li')
        .slice(1, -1)
        .remove();
      var trnum = 0; // reset tr counter
      var maxRows = parseInt($(this).val()); // get Max Rows from select option

      if (maxRows == 5000) {
        $('.pagination').hide();
      } else {
        $('.pagination').show();
      }

      var totalRows = $(table + ' tbody tr').length; // numbers of rows
      $(table + ' tr:gt(0)').each(function() {
        // each TR in  table and not the header
        trnum++; // Start Counter
        if (trnum > maxRows) {
          // if tr number gt maxRows

          $(this).hide(); // fade it out
        }
        if (trnum <= maxRows) {
          $(this).show();
        } // else fade in Important in case if it ..
      }); //  was fade out to fade it in
      if (totalRows > maxRows) {
        // if tr total rows gt max rows option
        var pagenum = Math.ceil(totalRows / maxRows); // ceil total(rows/maxrows) to get ..
        //	numbers of pages
        for (var i = 1; i <= pagenum; ) {
          // for each page append pagination li
          $('.pagination #prev')
            .before(
              '<li data-page="' +
                i +
                '">\
								  <span>' +
                i++ +
                '<span class="sr-only">(current)</span></span>\
								</li>'
            )
            .show();
        } // end for i
      } // end if row count > max rows
      $('.pagination [data-page="1"]').addClass('active'); // add active class to the first li
      $('.pagination li').on('click', function(evt) {
        // on click each page
        evt.stopImmediatePropagation();
        evt.preventDefault();
        var pageNum = $(this).attr('data-page'); // get it's number

        var maxRows = parseInt($('#maxRows').val()); // get Max Rows from select option

        if (pageNum == 'prev') {
          if (lastPage == 1) {
            return;
          }
          pageNum = --lastPage;
        }
        if (pageNum == 'next') {
          if (lastPage == $('.pagination li').length - 2) {
            return;
          }
          pageNum = ++lastPage;
        }

        lastPage = pageNum;
        var trIndex = 0; // reset tr counter
        $('.pagination li').removeClass('active'); // remove active class from all li
        $('.pagination [data-page="' + lastPage + '"]').addClass('active'); // add active class to the clicked
        // $(this).addClass('active');					// add active class to the clicked
	  	limitPagging();
        $(table + ' tr:gt(0)').each(function() {
          // each tr in table not the header
          trIndex++; // tr index counter
          // if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
          if (
            trIndex > maxRows * pageNum ||
            trIndex <= maxRows * pageNum - maxRows
          ) {
            $(this).hide();
          } else {
            $(this).show();
          } //else fade in
        }); // end of for each tr in table
      }); // end of on click pagination list
	  limitPagging();
    })
    .val(5)
    .change();

  // end of on select change

  // END OF PAGINATION
}

function limitPagging(){
	// alert($('.pagination li').length)

	if($('.pagination li').length > 7 ){
			if( $('.pagination li.active').attr('data-page') <= 3 ){
			$('.pagination li:gt(5)').hide();
			$('.pagination li:lt(5)').show();
			$('.pagination [data-page="next"]').show();
		}if ($('.pagination li.active').attr('data-page') > 3){
			$('.pagination li:gt(0)').hide();
			$('.pagination [data-page="next"]').show();
			for( let i = ( parseInt($('.pagination li.active').attr('data-page'))  -2 )  ; i <= ( parseInt($('.pagination li.active').attr('data-page'))  + 2 ) ; i++ ){
				$('.pagination [data-page="'+i+'"]').show();

			}

		}
	}
}

$(function() {
  // Just to append id number for each row
  $('table tr:eq(0)').prepend('<th> ID </th>');
  var id = 0;
  $('table tr:gt(0)').each(function() {
    id++;
    $(this).prepend('<td>' + id + '</td>');
  });
});

</script>


@endsection
