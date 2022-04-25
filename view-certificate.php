<?php
session_start();
include "include/dbconfig.php";
include "functions.php";
?>

<?php include "include/menu.php"; ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">

            <!--    <div class="x_panel">
                   <div class="x_content"> -->
            <h3 class="page-header">View Certificate</h3>

         
                <div class="form-group">
                    <form id="searchForm">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <label>Franchise</label>
                       <select name="franchise" id="franchise" class="form-control" required>
                           <option value="">Select Franchise</option>
                            <?php 
                                $franchises = showFranchises();
                                if(count($franchises) > 0)
                                {
                                    foreach ($franchises as $key => $franchise) {
                                        echo '<option value="'.$franchise['id'].'">'.$franchise['franchise_name'].'</option>';
                                    }
                                }
                            ?>
                       </select>
                      
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <label>From Date</label>
                        <input type="date" name="fromDate" id="fromDate" class="form-control" required>
                      
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <label>To Date</label>
                        <input type="date" name="toDate" id="toDate" class="form-control" required>
                      
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <label>&nbsp;</label>
                        <button type="submit" id="search" class="btn btn-info form-control">Search</button>
                    </div>
                    </form>

                    <div class="clearfix"></div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2 col-md-2 col-sm-offset-5 col-md-offset-5">

                    </div>
                </div>
                <div class="clearfix"></div>

                <div>&nbsp;</div>
            <form id="certificateForm" method="post" enctype="multipart/form-data" autocomplete="off" >
                <div class="table-responsive" id="insertDiv" style="display:">
                    <table class="table table-stripped table-condensed" id="certificateTable">
                           <thead>
                               <th>Name</th>
                               <th>Reg No</th>
                               <th>Course</th>
                               <th width="1%">Certificate </th>
                               <th width="1%">Marksheet </th>
                               <th>Printed at </th>
                           </thead>
                           <tbody></tbody>
                    </table>
                </div>
               
            </form>

            <!-- /panel -->
        </div>

        <!--</div>
                </div>-->

    </div>
</div>
</div>


<?php include('include/footer.php'); ?>
</body>

</html>


<!-- /#page-wrapper -->




<!-- Page-Level Demo Scripts - Notifications - Use for reference -->
<script type="text/javascript">
    $(document).ready(function() {

        $('#checkAll').on('change', function() {
            $(".checkBoxClass").prop('checked', $(this).prop('checked'));
        });

        $(document).ajaxSend(function() {
            $("#overlay").fadeIn(300);
        });
        $(document).ajaxComplete(function() {
            $("#overlay").fadeOut(300);
        });

        $('#searchForm').on('submit', function(e) {
            // e.preventDefault();
            
            $('#certificateTable tbody').html("");
            $.ajax({
                url: "fetch-printed-data.php",
                type: "POST",
                data: {
                    "franchise": $('#franchise').val(),
                    "fromDate" : $('#fromDate').val(),
                    "toDate"   : $('#toDate').val(),
                },
                dataType: 'json',
                success: function(response) {
                    let tr     = '';
                    let dt     = $.datepicker.formatDate('yy-mm-dd', new Date());
                    
                  if (response.success) 
                  {
                    //$("#overlay").fadeOut(300);
                      if(response.records.length  > 0)
                       {
                            for(i=0; i< response.records.length ; i++)
                            { 
                                tr += '<tr id="'+response.records[i].id+'">'+ 
                                          '<td>'+response.records[i].St_Name+'</td>'+
                                          '<td>'+response.records[i].regno+'</td>'+
                                          '<td>'+response.records[i].course_info.course_name+'</td>'+
                                          '<td><a target="_blank" href="certificate-print.php?id='+response.records[i].regno+'"><button type="button" class="btn btn-default"><i class="fa fa-print"></i> Certificate Print</button></a></td>'+
                                          '<td><a target="_blank" href="marksheet-print.php?id='+response.records[i].regno+'"><button type="button" class="btn btn-default"><i class="fa fa-print"></i> Marksheet Print</button></a></td>'+
                                          '<td>'+response.records[i].printed_date+'</td>'+
                                      '</tr>';
                            } 
                       }
                       $('#certificateTable tbody').html(tr);
                   }else{
                       alert(response.message);
                   }
                   
                    
                }
                
            });
            return false;
        });
    });


   
</script>

</body>

</html>