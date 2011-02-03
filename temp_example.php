<?php
  if ( !function_exists('json_encode') ){
    function json_encode($content){
      require_once 'JSON.php';
      $json = new Services_JSON;
      return $json->encodeUnsafe($content);
    }
  }

  session_start();

  if (!isset($_SESSION['temperature'])) {
    for ($i = 0; $i < 20; $i++) {
      $tm = time() - (20 - i);
      $result['rows'][] = array( 'time' => $tm * 1000, 'yesterday' => rand(20,30), 'today' => rand(15, 25));
    }
    $_SESSION['temperature'] = $result;
  } else {
    $result = $_SESSION['temperature'];
    array_shift($result['rows']);
    $result['rows'][] = array( 'time' => time() * 1000, 'yesterday' => rand(20,30), 'today' => rand(15, 25));
    $_SESSION['temperature'] = $result;
  }

  echo json_encode($result);
?>

