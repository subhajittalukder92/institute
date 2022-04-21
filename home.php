<?php
session_start();
include('include/no-cache.php');
include('include/dbconfig.php'); 
include('include/check-login.php'); 
function totalRegistration()
{
	include('include/dbconfig.php'); 
	$sql="SELECT COUNT(*) AS totatreg FROM student_info";
	$res=mysqli_query($conn,  $sql);
	if(mysqli_num_rows($res) > 0)
	{
		$row=mysqli_fetch_assoc($res);
		echo $row['totatreg'];
	}
}
function totalPursuing()
{
	include('include/dbconfig.php'); 
	$sql="SELECT COUNT(*) AS totatpursuing FROM pursuing_course WHERE `current_status`='Pursuing'";
	$res=mysqli_query($conn,  $sql);
	if(mysqli_num_rows($res) > 0)
	{
		$row=mysqli_fetch_assoc($res);
		echo $row['totatpursuing'];
	}
}
?>
<?php include('include/menu.php');?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Dashboard</h1>
                    </div>
					<div class="col-lg-6 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php totalRegistration();?></div>
                                    <div>Total Registration</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                
                            </div>
                        </a>
                    </div>
					</div>
							<div class="col-lg-6 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?PHP totalPursuing();?></div>
                                    <div>Total Pursuing Candidate</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                
                            </div>
                        </a>
                    </div>
					</div>

                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
 	</div>
	</div>
</div>
</div>
<?php include('include/footer.php'); ?>
</body>
</html>