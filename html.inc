<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Twitter OAuth in PHP</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="linkstyle.css"/>
    <style type="text/css">
	ul{	
		overflow:hidden;
		margin:0; padding:0;} 
	ul li{
		height: 40px;
		padding:20px 20px;
		display:block;
		font-size:30px;
		text-align:center;
		border-bottom:5px solid #ddd;
		font-family: Helvetica Neue, times, serif;
	}
    </style>
<script type="text/javascript"
    src="https://maps.google.com/maps/api/js?sensor=false">
</script>
<script type="text/javascript" src="locallocation.js"></script>
  </head>
  <body onload="initialize()">
    <div style"position:absolute;">
	<h2>Welcome to a Twitter Friends.</h2>

      <p><a href='./clearsessions.php'>Log out</a></p>

      <hr />
    </div>
    <div style="position:relative; left:0px; width:59%;">
      
      <?php if (isset($menu)) { ?>
        <?php echo $menu; ?>
      <?php } ?>
    
    <?php if (isset($status_text)) { ?>
      <?php echo '<h3>'.$status_text.'</h3>'; ?>
    <?php } ?>
	<?php print_r($content); ?>
    </div>
    <div id="map_canvas" style="position:absolute; right:0px; width:40%;top:0px; height:100%"></div>
  </body>
</html>
