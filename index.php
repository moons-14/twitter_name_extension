<?php
//created by moons
//twitter oauthを読み込む
    require_once("twitteroauth/autoload.php");
    use Abraham\TwitterOAuth\TwitterOAuth;
$webhook_url = '';//通知用discord webhookURL
$t_a="";//twitter APIキー
$t_s="";//twitter APIキーシークレット
$t_t="";//twitter アクセストークン
$t_t_s="";//twitter アクセストークンシークレット
function send_to_slack($message,$webhook_url) ;
    $options = array(
      'http' => array(
        'method' => 'POST',
        'header' => 'Content-Type: application/json',
        'content' => json_encode($message),
      )
    );
    $response = file_get_contents($webhook_url, false, stream_context_create($options)); //要求を$webhook_urlのURLに投げて結果を受け取る
    return $response === 'ok'; //$responseの値がokならtrueを返す
  }
    $TwitterOAuth = new TwitterOAuth($t_a,$t_s,$t_t,$t_t_s);
//ファイルを読み込む
    $lines = file("kaku.txt");
    $mm = $lines[array_rand($lines)];
    $userinfo = $TwitterOAuth->post("account/update_profile", array("name" => "むーんず".$mm));
    $TwitterOAuth->post("statuses/update", array("status" => "NAME UPDATE ->".$mm."\n".date("Y/m/d H:i:s")));
      //メッセージの内容を定義
  $message = array(
    'username' => 'ユーザー名が変更されました'
    'content' => "NAME UPDATE ->".$mm."\n".date("Y/m/d H:i:s")
  );
   
  send_to_slack($message,$webhook_url); //処理を実行
