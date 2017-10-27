<?php
// A simple web site in Cloud9 that runs through Apache
// Press the 'Run' button on the top to start the web server,
// then click the URL that is emitted to the Output tab of the console
?>
<!DOCTYPE html>
<body>
<head>
  <title>Contact Form</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" />
  <style>
      html{
    		height: 100%;
    		min-height: 100%;
    	}
    	body{
    		background: url('bg.jpg') no-repeat fixed;
    		min-height: 100%;
    		background-size: cover;
    		-webkit-background-size: cover;
    	  	-moz-background-size: cover;
    	  	-o-background-size: cover;
    	}	
    	form{
    	  margin-top: 25px;
    	}
      #submit-btn
      {
          width: 100%;    
      }
  </style>
</head>
<section>
    <div class="container">
        <div class="col-md-6 col-md-offset-6">
            <form id="contact" class="form-horizontal well">
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                       <h3>Contact Me!</h3>
                    </div>
                  </div>
                 <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                      <input type="name" class="form-control" name="name" id="name" placeholder="Your name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" name="email" id="email" placeholder="Your email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Message</label>
                    <div class="col-sm-10">
                      <textarea rows="10" cols="100" name="message" id="message" class="form-control" style="resize:none" placeholder="Your message"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                       <div id="msg"></div>
                       <button class="btn btn-lg btn-info pull-right" id="submit-btn">SEND MESSAGE</button>
                    </div>
                  </div>
            </form>  
        </div>
    </div>
</section>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>
    /* global $ */
    $(document).ready(function(){
      $('#submit-btn').click(function(event){
        event.preventDefault();
         $.ajax({
            dataType: 'JSON',
            url: 'sendmail.php',
            type: 'POST',
            data: $('#contact').serialize(),
            beforeSend: function(xhr){
              $('#submit-btn').html('SENDING...');
            },
            success: function(response){
              if(response){
                console.log(response);
                if(response['signal'] == 'ok'){
                 $('#msg').html('<div class="alert alert-success">'+ response['msg']  +'</div>');
                  $('input, textarea').val(function() {
                     return this.defaultValue;
                  });
                }
                else{
                  $('#msg').html('<div class="alert alert-danger">'+ response['msg'] +'</div>');
                }
              }
            },
            error: function(){
              $('#msg').html('<div class="alert alert-danger">Errors occur. Please try again later.</div>');
            },
            complete: function(){
              $('#submit-btn').html('SEND MESSAGE');
            }
          });
      });
    });
</script>
</html>
