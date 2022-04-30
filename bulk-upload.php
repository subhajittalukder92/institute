<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bulk Upload</title>
</head>
<body>
    <form id="uploadForm" method="post" enctype="multipart/form-data">
    <label class="" style="font-size: 16px;" for="pic">Upload Excel <span style="color: red;">*</span></label>
    <input type="file" name="docs" id="docs" class="form-control">
    <button type="submit" name="submit" id="submit">Submit</button>
    </form>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript">
      $(document).ready(function(e){
        
        $('#uploadForm').on('submit', function(e){
            e.preventDefault();
            formData = new FormData();
            formData.append("docs", $('#docs').prop("files")[0]);
          
            $.ajax({
                url: "upload-data.php",
                data: formData,
                type: "POST",
                cache: false,
                processData: false,
                contentType: false,
                async: false,
                enctype: "multipart/form-data",
                beforeSend: function() {
                   // $('body').addClass("loading");
                },
                complete: function() {
                  //  $('body').removeClass("loading");
                },
                success: function(response) {

                
                }
            });

        });
        
    
      });
  </script>