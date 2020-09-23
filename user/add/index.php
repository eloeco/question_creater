<?php

require "../../models/response.php";
require "../../settings/config.php";


// Kullanıcıyı kayıt edelim

 $response = new Response();

if(isset($_POST["user_name"]) && isset($_POST["user_password"]) && isset($_POST["user_email"])
&& !empty($_POST["user_name"]) && !empty($_POST["user_password"]) && !empty($_POST["user_email"])){

    $userName = $_POST["user_name"];
    $userPassword = $_POST["user_password"];
    $userEmail = $_POST["user_email"];
    $userStatus = 1;
    $userValidateCode = rand(0,1000).rand(0,1000);

    $sorgu = $db->prepare("insert into users set
    user_name = ?,
    user_password = ?,
    user_email = ?,
    user_status = ?,
    user_validate_code = ?
    ");
    $ekle = $sorgu->execute([
        $userName,$userPassword,$userEmail,$userStatus,$userValidateCode
    ]);
    if($ekle){
        $response->setMessage("Başarıyla kayıt oldun " . $userName . "\n uygulamadan giriş yapabilirsin");
        $response->setState(true);
        echo json_encode($response);
    } else{
        $response->setMessage("Kayıt olunurken hata ile karşılaşıldı");
        $response->setState(false);
        echo json_encode($response);
    }


} else{
    $response->setMessage("Parametreler boş gelemez");
    $response->setState(false);
    echo json_encode($response);
}


?>