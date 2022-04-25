<?php include "header-link.php"; ?>
<?php include "header.php"; ?>

<section class="welcome">
  <div class="container">
	  <div class="col-lg-12">
      <div class="big-cta">
        <div class="cta-text">
          <h1>Certificate Verification</h1>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="callaction">
  <div class="form-edu">
    <div class="container">
      <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-md-4">
          <div class="home-veri">
            <div class="marginbot30">
              <form action="certificate-print.php" method="get" id="contactform">
                <div class="result">
                  <label>Enter Your Enrollment No:</label>
                  <input class="wp-form-control wpcf7-text" name="id" required type="text" placeholder="Student Enrollment No*">
                  <p class="click"></p>
                  <button class="btn btn-theme margintop10 pull-left" style="float:left" type="submit">Submit</button>
                </div>
              </form>
            </div>        
        	</div>
        </div>
        <div class="col-lg-4"></div>
      </div>
    </div>
  </div>
</section>

<?php include "footer.php"; ?>	
<?php include "footer-link.php"; ?>