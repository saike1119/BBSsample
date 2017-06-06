<?php
  //ダッシュボードのBluemix elephant postgresの資格情報を開き，それぞれの値をコピーする
  //postgres://ユーザ名:パスワード@ホスト名:5432/データベース名
  $conn_str = " host=echo-01.db.elephantsql.com"; //"の後の半角スペースは消さないこと
  $conn_str .= " dbname=hgwamisb"; //"の後の半角スペースは消さないこと
  $conn_str .= " user=hgwamisb"; //"の後の半角スペースは消さないこと
  $conn_str .= " password=t3KcdS_aub12-V9nFveGPh9wuEthRLD8"; //"の後の半角スペースは消さないこと

  $conn = pg_connect("$conn_str options='--client_encoding=UTF8'");

?>

<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Herokuに設置したPHPスクリプトの利用</title>
    <style>
      h1 {font-size: 16pt; background:#AAFFAA; padding:5px; }
      p {margin: 10px; }
    </style>
 </head>
  <body>
    <h1>SampleBBS by a PHP App on Bluemix</h1>
    <form name="test" action="https://testappbunkyouniv.mybluemix.net" method="POST">
      <input type="hidden" name="method" value="post">
      <input type="text" name="message" size="50">
      <input type="submit" value="送信">
    </form>
<?php //POSTされた時の処理
  if(isset($_REQUEST["method"]) && $_REQUEST["method"] === "post"){
    if($conn){
      $message = $_REQUEST["message"];
      $message = pg_escape_string($conn, $message);
      $sql = "INSERT INTO messages (message) VALUES ('".$message."');";
      pg_query($conn,$sql);
    }
  }

?>
    <hr>
    <p>
      <ol id="list">
<?php //アクセスされると実行される処理
if($conn){
  $sql = "SELECT * FROM messages;";
  $res = pg_query($conn,$sql);
  $html = "";
  while($arr = pg_fetch_assoc($res)){	//DBの取得件数分だけリストを出力
    $html .= "<li>".$arr['message']."</li>\n";
  }
  echo "$html";
}

?>
      </ol>
    </p>
  </body>
 
</html>
