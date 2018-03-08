<html>
<head>
  <title>Installation in Progress</title>
    <link rel="shortcut icon" href="includes/assets/img/favicon.png">
  <style type="text/css">
  .progress { height: 40px !important; }
   progress.active .progress-bar, .progress-bar.active { padding: 10px; }
  </style>
</head>
<body style="background: url('includes/assets/img/bg.png') #FFFFFF scroll center -50px repeat !important">
<link rel="stylesheet" href="../assets/css/bootstrap.css" />

<div style="margin-top:250px;" class="container">
<!-- <div class="center-block form-group" id="progress" style="width:500px;border:1px solid #ccc;"></div> -->
<div class="progress">
  <div class="progress-bar progress-bar-striped active" id="progress">
    <span id="information"></span>
  </div>
</div>
<?php
$total = 285;
$arrayTimings = array("5000","10000","30000","400000","3000");

for($i=1; $i<=$total; $i++){
  $keys = array_rand($arrayTimings);
  $val = $arrayTimings[$keys];
  $percent = intval($i/$total * 100);
  $percentage = $percent."%";
  if($percent == 100){
    $processed = "99%";
  }else{
    $processed = $percentage;
  }
  header( 'Content-type: text/html; charset=utf-8' );
  echo '<script language="javascript">
  document.getElementById("progress").style.width ="'.$processed.'";
  document.getElementById("information").innerHTML="'.$processed.' processed.";
  </script>';
  echo str_repeat(' ',1024*64);
  flush();
  usleep($val);
}

echo '<script language="javascript">document.getElementById("information").innerHTML="Process completed"</script>';

?>
</div>

<h3 class="text-primary text-center"> <strong>Hello!</strong></h3>
<div class="col-md-4"></div>
<div class="col-md-4">
<p class="alert alert-success text-center">Congratulations PHPTRAVELS installed successfully and ready to get started.</p>
</div>
<div class="col-md-4"></div>
<div class="clearfix"></div>
<hr>

<div class="col-md-3"></div>
<div class="col-md-6">
<div style="background-color: rgba(81, 141, 193, 0.06); border: 1px solid rgba(51, 122, 183, 0.31);" class="well">
  <div class="block">
    <div class="panel-body">
      <form action="<?php echo @$_POST['domain']; ?>" target="_blank" method="post">
        <button class="btn btn-default btn-lg btn-block">
          <h4 class="text-center">Homepage</h4>
        </button>
      </form>
      <hr>
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
          <img class="img-rounded img-responsive" src="includes/assets/img/admin.png" alt="admin">
        </div>
        <div class="col-md-9 row">
          <div class="visible-lg">
            <div style="margin-top:10px"></div>
          </div>
          <strong>Admin URL :</strong> <?php echo @$_POST['domain']; ?>admin/<br>
          <strong>Email :</strong> <?php echo @$_POST['admin_email']; ?><br>
          <strong>Password :</strong> <?php echo @$_POST['admin_password']; ?>
        </div>
      </div>
    </div>
  </div>
<div class="clearfix"></div>
<hr>
<div class="clearfix"></div>
<p class="bold">XML Sitemap For better SEO<br>
<a target="_blank" class="target" href="<?php echo @$_POST['domain']; ?>sitemap.xml"><?php echo @$_POST['domain']; ?>sitemap.xml </a>
</p>
<p>------------------------------------------</p>
<p>to get started and setup the website please visit here <a target="_blank" class="target" href="//phptravels.com/documentation/"><strong>www.phptravels.com/documentation/</strong></a><br>
Looking forward to hearing from you.
</p>
<hr>
<p><span class="bold">Regards</span><br>
  PHPTRAVELS Team
</p>
</div>
</div>
<div class="col-md-3"></div>
</body>
</html>
