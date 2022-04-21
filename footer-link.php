</div>
<a href="http://www.jybce.org/homepage#" class="scrollup" style="display: block;"><i class="fa fa-angle-up active"></i></a> 
<!-- javascript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 

<script src="files/jquery.easing.1.3.js.download"></script> 
<script src="files/bootstrap.min.js.download"></script> 
<script src="files/jquery.fancybox.pack.js.download"></script> 
<script src="files/jquery.fancybox-media.js.download"></script>
<script src="files/jquery.flexslider.js.download"></script> 
<script src="files/animate.js.download"></script> 
<script type="text/javascript" src="files/modernizr.custom.79639.js.download"></script> 
<script type="text/javascript" src="files/owl.carousel.min.js.download"></script> 
<script src="files/jquery.bootstrap.newsbox.min.js.download" type="text/javascript"></script> 
<script src="files/jquery.contact-buttons.js.download"></script>
<script src="files/dropdownhover.min.js.download"></script> 
<!--<script src="http://www.jybce.org/assets/js/js-image-slider.js"></script>-->
<script type="text/javascript" src="files/jquery.nivo.slider.js.download"></script>
<script src="files/custom.js.download"></script> 
<script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
</script>

<script type="text/javascript">
    $(function () {
		$(".demo2").bootstrapNews({
            newsPerPage: 4,
            autoplay: true,
			pauseOnHover: true,
			navigation: false,
            direction: 'down',
            newsTickerInterval: 2500,
            onToDo: function () {
                //console.log(this);
            }
        });
    });
</script>

<script>
$(document).ready(function() {	

var id = '#dialog';
	
//Get the screen height and width
var maskHeight = $(document).height();
var maskWidth = $(window).width();
	
//Set heigth and width to mask to fill up the whole screen
$('#mask').css({'width':maskWidth,'height':maskHeight});

//transition effect
$('#mask').fadeIn(500);	
$('#mask').fadeTo("slow",0.9);	
	
//Get the window height and width
var winH = $(window).height();
var winW = $(window).width();
              
//Set the popup window to center
$(id).css('top',  winH/2-$(id).height()/2);
$(id).css('left', winW/2-$(id).width()/2);
	
//transition effect
$(id).fadeIn(2000); 	
	
//if close button is clicked
$('.window .close1').click(function (e) {
//Cancel the link behavior
e.preventDefault();

$('#mask').hide();
$('.window').hide();
});

//if mask is clicked
$('#mask').click(function () {
$(this).hide();
$('.window').hide();
});

$( "#btn_submit" ).click(function() {

	  var name = $("#your_name").val().trim();
	  if( name == ''){
		  alert ("Please Enter your Name");
		  $("#your_name").focus();
		  return false;
	  }
	  var email = $("#your_email").val().trim();
	  if( email == ''){
		  alert ("Please Enter your Email");
		  $("#your_email").focus();
		  return false;
	  }
	  else if(IsEmail(email)==false){
		  alert ("Please Enter your valid Email");
		  $("#your_email").focus();
		  return false;
	  }
	  
	  var phone = $("#your_phone").val().trim();
	  if( phone == ''){
		  alert ("Please Enter your Phone No");
		  $("#your_phone").focus();
		  return false;
	  }
	  
	  var message = $("#your_message").val().trim();
	  if( message == ''){
		  alert ("Please Enter your Message");
		  $("#your_message").focus();
		  return false;
	  }
	  
});

$( "#btn_sbt" ).click(function() {

	  var name = $("#name").val().trim();
	  if( name == ''){
		  alert ("Please Enter your Name");
		  $("#name").focus();
		  return false;
	  }
	  var email = $("#email").val().trim();
	  if( email == ''){
		  alert ("Please Enter your Email");
		  $("#email").focus();
		  return false;
	  }
	  else if(IsEmail(email)==false){
		  alert ("Please Enter your valid Email");
		  $("#email").focus();
		  return false;
	  }
	  
	  var phone = $("#phone").val().trim();
	  if( phone == ''){
		  alert ("Please Enter your Phone No");
		  $("#phone").focus();
		  return false;
	  }
	  
	  var message = $("#message").val().trim();
	  if( message == ''){
		  alert ("Please Enter your Message");
		  $("#message").focus();
		  return false;
	  }
	  
});
	$("#your_phone").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
	
	$("#phone").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
	
});

function IsEmail(email) {
	var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if(!regex.test(email)) {
	   return false;
	}
	else{
	   return true;
	}
}
</script>
</body>
</html>