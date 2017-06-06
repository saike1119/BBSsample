<?php

//ダッシュボードのBluemix postgresの「資格情報」を開き，それぞれの値をコピーする
//postgres://ユーザ名:パスワード@ホスト名:5432/データベース名
$conn_str = " host=echo-01.db.elephantsql.com"; //"の後の半角スペースは消さないこと
$conn_str .= " dbname=hgwamisb"; //"の後の半角スペースは消さないこと
$conn_str .= " user=hgwamisb"; //"の後の半角スペースは消さないこと
$conn_str .= " password=t3KcdS_aub12-V9nFveGPh9wuEthRLD8"; //"の後の半角スペースは消さないこと

$conn = pg_connect("$conn_str options='--client_encoding=UTF8'");
if($conn){
    $sql = "CREATE TABLE messages (id serial primary key, message text not null, registered TIMESTAMP DEFAULT CURRENT_TIMESTAMP);";
    $result = pg_query($conn, $sql); //$sqlの内容＝CREATE TABLE文を実行
    echo $result;
}
else{ echo "データベースに $conn_str で接続できませんでした\n";
}
?>