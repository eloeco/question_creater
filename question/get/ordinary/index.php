<?php

// web servisten sıralı olarak soru getirmek için

require "../../../settings/config.php";
require "../../../models/response.php";

$response = new Response();
// parametreleri kontrol edelim
if(isset($_GET["lesson_id"]) && !empty($_GET["lesson_id"])
&& isset($_GET["question_limit"]) && !empty($_GET["question_limit"])) {
    
    $lessonId = $_GET["lesson_id"];
    $questionLimit = $_GET["question_limit"];
    $questionStatus = 1; // sadece aktif olan soruları çekeceğiz
    $sorgu = $db->prepare("select * from questions where lesson_id=? and question_status=? LIMIT $questionLimit");
    $sorgula = $sorgu->execute([
        $lessonId,$questionStatus
    ]);
    // sorgu çalışırsa
    if($sorgula){
        $sorular = $sorgu->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($sorular);
    } else{ // sorgu çalışırken hata olursa
        $response->setMessage("Sorgu çalışırken hata oldu");
        $response->setState(false);
        echo json_encode($response);
    }


} else{ // parametreler boş gelirse
    $response->setMessage("Parametreler boş gelemez");
    $response->setState(false);
    echo json_encode($response);
}


?>