<?php

require "../../settings/config.php";
require "../../models/response.php";

// ders düzenleyen servis yazalım

$response = new Response();

if(isset($_POST["lesson_id"]) && !empty($_POST["lesson_id"])){
    $lessonId = $_POST["lesson_id"];
    $lessonName = $_POST["lesson_name"];
    $lessonCode = $_POST["lesson_code"];

    $sorgu = $db->prepare("UPDATE lessons SET lesson_name=? , lesson_code=? WHERE lesson_id=?");
    $sorgula= $sorgu->execute([
        $lessonName,$lessonCode,$lessonId
    ]);
    // sorgu başarılı bir şekilde çalışırsa
    if($sorgula){
        $response->setMessage("Dersin adı " . $lessonName . " olarak\nbaşarılı bir şekilde güncellendi");
        $response->setState(true);
        echo json_encode($response);
    } 
    // sorgu çalışırken hata alınırsa
    else{

    }
}


// parametreler boş gelirse
else{
    $response->setMessage("Parametreler boş gelemez");
    $response->setState(false);
    echo json_encode($response);
}



?>