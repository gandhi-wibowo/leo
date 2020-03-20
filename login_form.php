<!DOCTYPE html>
<html lang="id">
  <head>
    <title>E - Konseling</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link  href="css/bootstrap-responsive.min.css"  rel ="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="span4 offset4 content">
          <h2>LOGIN SISTEM</h2><hr>
          <span id="loginMsg"></span>
          <form class="form" role="form" action="" method="post" name="loginForm" id="loginForm">
            <div class="form-group">
              <label for="username">Username</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                  <input type="text" class="form-control" name="username" placeholder="Enter username" id="username" required autofocus/>
              </div><br>
            <div class="form-group">
              <label for="password">Password</label>
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-star"></span></span>
                  <input type="password" class="form-control" name="password" placeholder="Enter password" id="password" required />
              </div><br>
            <div class="form-actions">
              <input type="submit" class="btn btn-warning submit" value="Login" name="" id="loginBtn">
              <button class="btn  btn-danger" type="reset">Reset</button>
            </div>
          </form>
          <h5>&copy; Copyright <?php echo date('Y'); ?> Sistem Informasi E - Konseling</a></h5>
        </div>
      </div>
    </div>
    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script><!-- Bootstrap -->

  </body>
</html>
<script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
    //Periksa apakah user id dan password telah diisi
    $("#loginBtn").click(function(){
      $("#loginForm").submit(function(e){return false;});
      var name = $("#username").val();
      var nameLength = name.length;
      var pw   = $("#password").val();
      var pwLength = pw.length;
      
      //apabila data user id dan pw tidak kosong -> kirim data via ajax. 
      if((nameLength && pwLength) >1){

        $.ajax({
          type:"POST",
          url :"login_validasi.php",
          data:{checkUser:'',usr:name,pwrd:pw},
          //dataType: "json",
          success:function(html){
            $("#loginMsg").html(html);
            //setTimeout(function() {$('.alert').hide();}, 5000);   
          },
          error: function() {$('#loginMsg').html('<p>Ajax Bermasalah !!!</p>');},         
        });
      
      //return false;
          
      } 
      //alert(name);
    });   
  }); 
</script>