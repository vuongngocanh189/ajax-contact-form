<?php ?>
<!DOCTYPE html>
<head>
  <title>AJAX Contact Form</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>
    	body {
    		background: url('bg.jpg') no-repeat fixed;
    		background-size: cover;
    		-webkit-background-size: cover;
    	  	-moz-background-size: cover;
    	  	-o-background-size: cover;
    	}
      .card {
        margin: 1rem 0;
        padding: 1rem;
        background-color: #f7f7f9;
      }
      form,
      article {
        font-size: 1rem;
        font-weight: 300;
      }
      .form-control:focus {
        border-color: #17a2b8;
        box-shadow: none;
      }
      #submit-btn {
        width: 100%;
      }
      .overlay{
        background-color: #555;
        background: rgba(0,0,0, 0.5);
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
      }
  </style>
</head>
<body>
<section>
  <div class="overlay"></div>
  <div class="container">
    <div class="col-lg-6 offset-lg-6">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title font-weight-bold">Contact Me!</h5>
          <div class="dropdown-divider"></div>

          <form id="contact" class="form-horizontal mt-4">
            <div class="form-group row">
              <label for="name" class="col-sm-3 col-form-label font-weight-bold">Name</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="name" id="name" placeholder="Your name">
              </div>
            </div>

            <div class="form-group row">
              <label for="email" class="col-sm-3 col-form-label font-weight-bold">Email</label>
              <div class="col-sm-9">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your email">
              </div>
            </div>

            <div class="form-group row">
              <label for="email" class="col-sm-3 col-form-label font-weight-bold">Interest</label>
              <div class="col-sm-9">
                <div class="form-check">
                  <input class="form-check-input" name="interest[]" type="checkbox" value="Web">
                  <label class="form-check-label" for="web">Web</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" name="interest[]" type="checkbox" value="App">
                  <label class="form-check-label" for="app">App</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" name="interest[]" type="checkbox" value="Game">
                  <label class="form-check-label" for="game">Game</label>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="email" class="col-sm-3 col-form-label font-weight-bold">Message</label>
              <div class="col-sm-9">
                <textarea rows="10" cols="100" name="message" id="message" class="form-control" style="resize:none" placeholder="Your message"></textarea>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-9 offset-sm-3">
                 <div id="msg"></div>
                 <button class="btn btn-lg btn-info pull-right" id="submit-btn">SEND MESSAGE</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <article>
            This is a sample website from <a href="https://anhkarppinen.com" target="_blank">Ani's Webdev Blog</a>. Click here for the <a href="https://anhkarppinen.com/ajax-contact-form-without-refreshing/" target="_blank">tutorial and source code</a> of this page.
          </article>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
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
            if(response['isSuccess']){
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
