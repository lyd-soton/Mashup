<?php
global $position;
$position = "shanghai";
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<style type="text/css">
  html { height: 100% }
  body { height: 100%; margin: 0px; padding: 0px }
  #map_canvas { font-family:"Times New Roman",Times,serif; font-size:30px }
</style>
<script type="text/javascript"
    src="https://maps.google.com/maps/api/js?sensor=false">
</script>
<script type="text/javascript" src="userlocation.js"></script>
</head>
<body onload="initialize('Hawaii')">
  <p id="test">123</p>
  <div id="map_canvas" style="position:absolute; right:0px; width:400px; height:500px"></div>

</body>
</html>

<!--; 
<html>
<head>
<title>Search Page</title>
<script type="text/javascript">
function search()
{
var name = document.getElementById("name");
var key = document.getElementById("key");
window.location.href="search.php?screen_name="+name+"&key_words="+key;
}
</script>
</head>

<body>
<h2>Search Page</h2>
<hr />
<br />

Key Words:   <input type="text" id="key" name="key_words" />
<br /><br /><br />
Screen Name: <input type="text" id="name" name="screen_name" />
<br /><br />

<input type="button" onclick="search()" value="Search"/>

</body>
</html>
-->
