<?php

require "../../settings/config.php";
require "../../models/response.php";

// ders silen servis yazalım

$response = new Response();

if(isset($_GET["lesson_id"]) && !empty($_GET["lesson_id"])){
    
    $lessonId = $_GET["lesson_id"];
    $sorgu = $db->prepare("DELETE FROM lessons WHERE lesson_id=?");
    $sorgula= $sorgu->execute([
        $lessonId
    ]);
    // sorgu başarılı bir şekilde çalışırsa
    if($sorgula){
        $response->setMessage("Ders başarılı bir şekilde silindi");
        $response->setState(true);
        echo json_encode($response);
    } 
    // sorgu çalışırken hata alınırsa
    else{
        $response->setMessage("Sorgu çalışırken hata ile karşılaşıldı");
        $response->setState(false);
        echo json_encode($response);
    }
}


// parametreler boş gelirse
else{
    $response->setMessage("Parametreler boş gelemez");
    $response->setState(false);
    echo json_encode($response);
}



?>