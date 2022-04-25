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
            <h3 class="page-header">Print Certificate</h3>

         
                <div class="form-group">
                
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <label>Franchise</label>
                       <select name="franchise" id="franchise" class="form-control">
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
                        <label>&nbsp;</label>
                        <button type="button" id="search" class="btn btn-info form-control">Search</button>
                    </div>
                 

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
                    
                    <input type="hidden" name="formid" id="formid" value="<?php echo htmlspecialchars($_SESSION['formid']); ?>">
                    <table class="table table-stripped table-condensed" id="certificateTable">
                           <thead>
                               <th>Name</th>
                               <th>Reg No</th>
                               <th>Course</th>
                               <th>Certificate </th>
                               <th>Marksheet </th>
                               <th><input type="checkbox" id="checkAll" checked> &nbsp;Status </th>
                            
                           </thead>
                           <tbody></tbody>
                    </table>
                </div>
                <button type="submit" name="submit" id="submit" class="btn btn-success form-control">Save Printed Marksheet & Certificates</button>
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

        $('#search').on('click', function(e) {
            // e.preventDefault();
            var form = $('#myForm');
            $('#certificateTable tbody').html("");
            $.ajax({
                url: "fetch-unprinted-data.php",
                type: "POST",
                data: {
                    "franchise": $('#franchise').val(),
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
                                          '<td><input type="hidden" value="'+response.records[i].admission_id+'" id="admissionId'+response.records[i].id+'"</td>'+response.records[i].St_Name+'</td>'+
                                          '<td>'+response.records[i].regno+'</td>'+
                                          '<td>'+response.records[i].course_info.course_name+'</td>'+
                                          '<td><a target="_blank" href="certificate-print.php?id='+response.records[i].regno+'"><button type="button" class="btn btn-default"><i class="fa fa-print"></i> Certificate Print</button></a></td>'+
                                          '<td><a target="_blank" href="marksheet-print.php?id='+response.records[i].regno+'"><button type="button" class="btn btn-default"><i class="fa fa-print"></i> Marksheet Print</button></a></td>'+
                                          '<td><input type="checkbox" checked class="checkBoxClass" id="check'+response.records[i].id+'"> &nbsp; Printed <input type="hidden" value="'+response.records[i].id+'" id="marksId'+response.records[i].id+'"</td>'+
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

        $('#certificateForm').on('submit', function(e){
                e.preventDefault();
              
                let trLength = $('#certificateTable tbody tr').length;
                if(trLength > 0){
                    let arr = [];
                    for(var i = 0; i < trLength ; i++){
                        let tr   = $("#certificateTable tbody tr")[i];
                        let trId = $(tr).attr('id');
                        count     = trId;
                        if($("#check"+count).prop('checked'))
                        {
                            arr.push({"id": $('#marksId'+count).val(), "status":"Printed"});
                        }
                   
                    }
                    let jsonObj = JSON.stringify(arr);
                    console.log(jsonObj);
                    if(arr.length > 0){
                        formData = new FormData();
                        formData.append("params", jsonObj);
                    
                        
                        $.ajax({
                            url: 'save-print.php',
                            data: formData,
                            dataType: "json",
                            type: "POST",
                            cache: false,
                            processData: false,
                            contentType: false,
                            async: false,
                            enctype: "multipart/form-data",
                            success: function(response) 
                            {
                                console.log(response);
                                if(response.success){
                                    alert(response.message) ;
                                    $('#certificateTable tbody').html("")     
                                }else{
                                    alert(response.message) ;
                                }
                            }
                        });
                    }else{
                        alert ("At least one row need to be selected.");
                    }
                
                }
            
        });

    });


   
</script>

</body>

</html>