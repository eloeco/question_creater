<?php

// soru silen fonksiyon yazalım - sorunun statusünü 0 olarak değiştirelim daha doğrusu

require "../../settings/config.php";
require "../../models/response.php";

$response = new Response();

// parametreleri kontrol edelim
if(isset($_POST["question_id"]) && !empty($_POST["question_id"])){
    $questionId = $_POST["question_id"];
    $question_status = 0; // soruyu deaktif etmek için kullanacağız
    $sorgu = $db->prepare("update questions set question_status=? where question_id=?");
    $sorgula = $sorgu->execute([
        0,$questionId
    ]);
    // sorgu başarılı bir şekilde çalışırsa
    if($sorgu){
        $response->setMessage("Soru başarılı bir şekilde silindi");
        $response->setState(true);
        echo json_encode($response);
    } else{ // sorgu çalışırken hata alınırsa
        $response->setMessage("Sorgu çalışırken hata ile karşılaşıldı");
        $response->setState(false);
        echo json_encode($response);
    }
} else{
    $response->setMessage("Parametreler boş geldi");
    $response->setState(false);
    echo json_encode($response);
}


?>