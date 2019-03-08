<?php
  
  $path = base_path('vendor/autoload.php');
  require $path;

  $options = array(
    'cluster' => 'ap3',
    'useTLS' => true
  );

  $pusher = new Pusher\Pusher(
    'ec792b864a013c22fe72',
    'd4cb5366ff63b58f13fc',
    '719667',
    $options
  );

  //공연정보, 이벤트정보, 좌석정보
  //$data['message'] = "test";
  //$data['message'] = isset($_REQUEST["num"])?$_REQUEST["num"]:"test";

  $num = isset($_REQUEST["num"])?$_REQUEST["num"]:"notNum";
  $id = isset($_REQUEST["id"])?$_REQUEST["id"]:"NotId";


  $data = array(
    'num' => $num,
    'id' => $id
  );

  $pusher->trigger('seat-channel', $data['num'], $data['id']);
  
?>