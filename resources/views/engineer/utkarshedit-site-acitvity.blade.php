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
            white-space: inherit;
            overflow:auto;
            overflow-x: scroll;
            overflow-y: scroll;


        }
        .wrap1{
            overflow-x: scroll;
            overflow-y: hidden;
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
            padding: 2%

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
<div id="wrapper1">
<div id="div1">
 <thead>
	<tr>
		<th>Site Id</th>
		<th>Site Address</th>
		<th>Start Date</th>
		<th>End Date</th>
        <th>Actual Start Date</th>
        <th>Actual End Date</th>
        <th>IP Address</th>
        <th>Status</th>
	</tr>

  </thead>
 <tbody>
        <tr>
            <td>S-101</td>
            <td>assam</td>
            <td>02/04/2023</td>
            <td>03/05/2023</td>
            <td>02/04/2023</td>
            <td>03/05/2023</td>
            <td>192.168.3.29</td>
            <td>Active</td>


            <!-- <td>Active</td>
            <td style="font-size: 30px;">
                <a href="http://localhost/laravel/assam-revenue-product/public/boq-edit/1" style="color: hsl(207, 78%, 53%);"><i class="mdi mdi-tooltip-edit"></i></a> | <a href="http://localhost/laravel/assam-revenue-product/public/boq-delete/1" style="color: #DC3545;"><i class="mdi mdi-delete-forever"></i></a>
            </td>-->
        </tr>

  </tbody>
  </div>
  </div>
  <div id="wrap1">
      <table class="table table-striped table-class" id= "table-id">

        <thead>
          <tr>
              <th>Work Activity </th>
              <th style="width: 25% ,height:25%">Actual Start Date</th>
              <th>Actual End Date</th>
              <th>Testing Document</th>
              <th>Site Photo</th>
              <th>Status</th>
              <th>Remark</th>
          </tr>
          <tr>

            <td><select class="form-control" name="priority">
                <option value="">---Select Activity---</option>
                <option value="">Networking Cabling</option>
                <option value="">Electric Cabling</option>
                <option value="">Earthing</option>
                <option value="">Racked Stack / Setup</option>
                <option value="">Material Delivered</option>
                <option value="">Site Survey</option>
                <option value="">Site Testing</option>
            </select></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="file"></td>
            <td><input type="file"></td>
            <td><select class="form-control" name="priority">
                <option value="">---Select Status---</option>
                <option value="">Open</option>
                <option value="">Work Inprogress</option>
                <option value="">Testing</option>
                <option value="">Completed</option>

            </select></td>
            <td><input type="text"></td>


           <!-- <td>Active</td>
            <td style="font-size: 30px;">
                <a href="http://localhost/laravel/assam-revenue-product/public/boq-edit/1" style="color: hsl(207, 78%, 53%);"><i class="mdi mdi-tooltip-edit"></i></a> | <a href="http://localhost/laravel/assam-revenue-product/public/boq-delete/1" style="color: #DC3545;"><i class="mdi mdi-delete-forever"></i></a>
            </td>-->
        </tr>
        <tr>

            <td><select class="form-control" name="priority">
                <option value="">---Select Activity---</option>
                <option value="">Networking Cabling</option>
                <option value="">Electric Cabling</option>
                <option value="">Earthing</option>
                <option value="">Racked Stack / Setup</option>
                <option value="">Material Delivered</option>
                <option value="">Site Survey</option>
                <option value="">Site Testing</option>
            </select></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="file"></td>
            <td><input type="file"></td>
            <td><select class="form-control" name="priority">
                <option value="">---Select Status---</option>
                <option value="">Open</option>
                <option value="">Work Inprogress</option>
                <option value="">Testing</option>
                <option value="">Completed</option>

            </select></td>
            <td><input type="text"></td>


           <!-- <td>Active</td>
            <td style="font-size: 30px;">
                <a href="http://localhost/laravel/assam-revenue-product/public/boq-edit/1" style="color: hsl(207, 78%, 53%);"><i class="mdi mdi-tooltip-edit"></i></a> | <a href="http://localhost/laravel/assam-revenue-product/public/boq-delete/1" style="color: #DC3545;"><i class="mdi mdi-delete-forever"></i></a>
            </td>-->
        </tr>
        <tr>

            <td><select class="form-control" name="priority">
                <option value="">---Select Activity---</option>
                <option value="">Networking Cabling</option>
                <option value="">Electric Cabling</option>
                <option value="">Earthing</option>
                <option value="">Racked Stack / Setup</option>
                <option value="">Material Delivered</option>
                <option value="">Site Survey</option>
                <option value="">Site Testing</option>
            </select></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="file"></td>
            <td><input type="file"></td>
            <td><select class="form-control" name="priority">
                <option value="">---Select Status---</option>
                <option value="">Open</option>
                <option value="">Work Inprogress</option>
                <option value="">Testing</option>
                <option value="">Completed</option>

            </select></td>
            <td><input type="text"></td>


           <!-- <td>Active</td>
            <td style="font-size: 30px;">
                <a href="http://localhost/laravel/assam-revenue-product/public/boq-edit/1" style="color: hsl(207, 78%, 53%);"><i class="mdi mdi-tooltip-edit"></i></a> | <a href="http://localhost/laravel/assam-revenue-product/public/boq-delete/1" style="color: #DC3545;"><i class="mdi mdi-delete-forever"></i></a>
            </td>-->
        </tr>
        <tr>

            <td><select class="form-control" name="priority">
                <option value="">---Select Activity---</option>
                <option value="">Networking Cabling</option>
                <option value="">Electric Cabling</option>
                <option value="">Earthing</option>
                <option value="">Racked Stack / Setup</option>
                <option value="">Material Delivered</option>
                <option value="">Site Survey</option>
                <option value="">Site Testing</option>
            </select></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="file"></td>
            <td><input type="file"></td>
            <td><select class="form-control" name="priority">
                <option value="">---Select Status---</option>
                <option value="">Open</option>
                <option value="">Work Inprogress</option>
                <option value="">Testing</option>
                <option value="">Completed</option>

            </select></td>
            <td><input type="text"></td>


           <!-- <td>Active</td>
            <td style="font-size: 30px;">
                <a href="http://localhost/laravel/assam-revenue-product/public/boq-edit/1" style="color: hsl(207, 78%, 53%);"><i class="mdi mdi-tooltip-edit"></i></a> | <a href="http://localhost/laravel/assam-revenue-product/public/boq-delete/1" style="color: #DC3545;"><i class="mdi mdi-delete-forever"></i></a>
            </td>-->
        </tr>
        <tr>

            <td><select class="form-control" name="priority">
                <option value="">---Select Activity---</option>
                <option value="">Networking Cabling</option>
                <option value="">Electric Cabling</option>
                <option value="">Earthing</option>
                <option value="">Racked Stack / Setup</option>
                <option value="">Material Delivered</option>
                <option value="">Site Survey</option>
                <option value="">Site Testing</option>
            </select></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="file"></td>
            <td><input type="file"></td>
            <td><select class="form-control" name="priority">
                <option value="">---Select Status---</option>
                <option value="">Open</option>
                <option value="">Work Inprogress</option>
                <option value="">Testing</option>
                <option value="">Completed</option>

            </select></td>
            <td><input type="text"></td>


           <!-- <td>Active</td>
            <td style="font-size: 30px;">
                <a href="http://localhost/laravel/assam-revenue-product/public/boq-edit/1" style="color: hsl(207, 78%, 53%);"><i class="mdi mdi-tooltip-edit"></i></a> | <a href="http://localhost/laravel/assam-revenue-product/public/boq-delete/1" style="color: #DC3545;"><i class="mdi mdi-delete-forever"></i></a>
            </td>-->
        </tr>
        <tr>

            <td><select class="form-control" name="priority">
                <option value="">---Select Activity---</option>
                <option value="">Networking Cabling</option>
                <option value="">Electric Cabling</option>
                <option value="">Earthing</option>
                <option value="">Racked Stack / Setup</option>
                <option value="">Material Delivered</option>
                <option value="">Site Survey</option>
                <option value="">Site Testing</option>
            </select></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="file"></td>
            <td><input type="file"></td>
            <td><select class="form-control" name="priority">
                <option value="">---Select Status---</option>
                <option value="">Open</option>
                <option value="">Work Inprogress</option>
                <option value="">Testing</option>
                <option value="">Completed</option>

            </select></td>
            <td><input type="text"></td>


           <!-- <td>Active</td>
            <td style="font-size: 30px;">
                <a href="http://localhost/laravel/assam-revenue-product/public/boq-edit/1" style="color: hsl(207, 78%, 53%);"><i class="mdi mdi-tooltip-edit"></i></a> | <a href="http://localhost/laravel/assam-revenue-product/public/boq-delete/1" style="color: #DC3545;"><i class="mdi mdi-delete-forever"></i></a>
            </td>-->
        </tr>
        <tr>

            <td><select class="form-control" name="priority">
                <option value="">---Select Activity---</option>
                <option value="">Networking Cabling</option>
                <option value="">Electric Cabling</option>
                <option value="">Earthing</option>
                <option value="">Racked Stack / Setup</option>
                <option value="">Material Delivered</option>
                <option value="">Site Survey</option>
                <option value="">Site Testing</option>
            </select></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="file"></td>
            <td><input type="file"></td>
            <td><select class="form-control" name="priority">
                <option value="">---Select Status---</option>
                <option value="">Open</option>
                <option value="">Work Inprogress</option>
                <option value="">Testing</option>
                <option value="">Completed</option>

            </select></td>
            <td><input type="text"></td>


           <!-- <td>Active</td>
            <td style="font-size: 30px;">
                <a href="http://localhost/laravel/assam-revenue-product/public/boq-edit/1" style="color: hsl(207, 78%, 53%);"><i class="mdi mdi-tooltip-edit"></i></a> | <a href="http://localhost/laravel/assam-revenue-product/public/boq-delete/1" style="color: #DC3545;"><i class="mdi mdi-delete-forever"></i></a>
            </td>-->
        </tr>
        <tr>


            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="file"></td>
            <td><input type="file"></td>
            <td><select class="form-control" name="priority">
                <option value="">---Select Status---</option>
                <option value="">Open</option>
                <option value="">Work Inprogress</option>
                <option value="">Testing</option>
                <option value="">Completed</option>

            </select></td>
            <td><input type="text"></td>



           <!-- <td>Active</td>
            <td style="font-size: 30px;">
                <a href="http://localhost/laravel/assam-revenue-product/public/boq-edit/1" style="color: hsl(207, 78%, 53%);"><i class="mdi mdi-tooltip-edit"></i></a> | <a href="http://localhost/laravel/assam-revenue-product/public/boq-delete/1" style="color: #DC3545;"><i class="mdi mdi-delete-forever"></i></a>
            </td>-->
        </tr>


        </thead>
        <tbody>
            <tr>
                <td>S-101</td>
                <td>assam</td>
                <td>02/04/2023</td>
                <td>03/05/2023</td>
                <td>02/04/2023</td>
                <td>03/05/2023</td>
                <td>192.168.3.29</td>
                <td>Active</td>


               <!-- <td>Active</td>
                <td style="font-size: 30px;">
                    <a href="http://localhost/laravel/assam-revenue-product/public/boq-edit/1" style="color: hsl(207, 78%, 53%);"><i class="mdi mdi-tooltip-edit"></i></a> | <a href="http://localhost/laravel/assam-revenue-product/public/boq-delete/1" style="color: #DC3545;"><i class="mdi mdi-delete-forever"></i></a>
                </td>-->
            </tr>
    </div>

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
                <center>
                <button type="submit" name="submit" value="vendor-site" class="btn btn-primary mr-2">Submit</button>
            </center>
            </div>


</div> <!-- 		End of Container -->






</body>
</html>
<script>
              getPagination('#table-id');
					//getPagination('.table-class');
					//getPagination('table');

		  /*					PAGINATION
		  - on change max rows select options fade out all rows gt option value mx = 5
		  - append pagination list as per numbers of rows / max rows option (20row/5= 4pages )
		  - each pagination li on click -> fade out all tr gt max rows * li num and (5*pagenum 2 = 10 rows)
		  - fade out all tr lt max rows * li num - max rows ((5*pagenum 2 = 10) - 5)
		  - fade in all tr between (maxRows*PageNum) and (maxRows*pageNum)- MaxRows
		  */


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

//  Developed By Yasser Mas
// yasser.mas2@gmail.com

</script>














@endsection
