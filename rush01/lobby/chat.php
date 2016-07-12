<?php
date_default_timezone_set("Europe/Paris");
function get_data() {
  if (file_exists("../private/chat")) {
    return unserialize(file_get_contents("../private/chat"));
  }
  else {
    return array();
  }
}
function store_data($data) {
  file_put_contents("./private/chat", serialize($data));
}
$data = get_data();
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Send</title>
  </head>
  <body>
    <?php
    foreach ($data as $elem)
      echo "[".date('H:i:s', $elem["time"])."] <b>".$elem["login"]."</b>: ".$elem["msg"]."<br />";
    ?>
  </body>
</html>
