<?php header("Cache-Control: no-cache"); ?>
<?php $ver = "1.0.0"; ?>
<!DOCTYPE html>
<html>

<head>
  <title>Wake On Lan</title>
  <meta charset="UTF-8">
</head>

<body>
<pre>
<?php
function issetgetall(){
  for ($i = 0; $i < func_num_args(); $i++){
    if (!isset($_GET[func_get_arg($i)])){
      return false;
    }
  }
  return true;
}

function execshell($a){
  $output = [];
  $return = 0;
  exec($a, $output, $return);
  for ($i = 0; $i < count($output); $i++){
    echo $output[$i] . "<br>";
  }
  echo "Return value: $return" . "<br><br>";
}

if (issetgetall('mac', 'ip', 'port')){
  $mac = implode(':', str_split(preg_replace("/[^0-9a-zA-Z]/","", $_GET['mac']), 2));
  $ip = $_GET['ip'];
  $port = $_GET['port'];
  // wol '00:1A:92:AD:5C:19' -i 24.150.233.29 -p 9
  execshell("./wol '$mac' -i '$ip' -p '$port' 2>&1");
}
// localhost?mac=00:1A:92:AD:5C:19&ip=24.150.233.29&port=9
?>
</pre>
</body>

</html>
