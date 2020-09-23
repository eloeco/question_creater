<?php

// derse göre soru getiren servis

require "../../../settings/config.php";
require "../../../models/response.php";

$response = new Response();

// parametreleri kontrol edelim
if(isset($_GET["lesson_id"]) && !empty($_GET["lesson_id"])){

    $lessonId = $_GET["lesson_id"];
    $sorgu = $db->prepare("select * from questions where lesson_id=?");
    $exc = $sorgu->execute([
        $lessonId
    ]);
    // sorgu başarılı ise
    if($exc){
        $questions = $sorgu->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($questions);
    }

}
else{
    $response->setMessage("Parametreler boş olamaz");
    $response->setState(false);
    echo json_encode($response);
}




?>