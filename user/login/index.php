<?php

require "../../settings/config.php";
require "../../models/response.php";

// kullanıcıya giriş yaptıralım

$response = new Response();
// gelen parametreleri kontrol edelim
if(isset($_POST["user_name"]) && isset($_POST["user_password"])
&& !empty($_POST["user_name"]) && !empty($_POST["user_password"])) {

    $userName = $_POST["user_name"];
    $userPassword = $_POST["user_password"];
    $sorgu = $db->prepare("select * from users where user_name=? and user_password=?");
    $sorgu->execute([
        $userName,$userPassword
    ]);
    // sorgu başarılı olduysa
    if($sorgu){
        $isUserExist = $sorgu->fetch(PDO::FETCH_ASSOC);
        if($isUserExist!=null){
            $response->setMessage("Kullanıcı girişi başarılı");
            $response->setState(true);
            echo json_encode($response);
        } else{
            $response->setMessage("Böyle bir kullanıcı bulunamadı \n Giriş bilgilerinizi kontrol edin");
            $response->setState(false);
            echo json_encode($response);
        }
    } else{
        $response->setMessage("Sorgu çalışırken hata ile karşılaşıldı");
        $response->setState(false);
        echo json_encode($response);
    }



}






?>