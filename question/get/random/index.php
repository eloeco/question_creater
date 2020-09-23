<?php

// rastgele soru getirelim

require "../../../settings/config.php";
require "../../../models/response.php";

$response = new Response();
// parametreleri kontrol edelim
if(isset($_GET["lesson_id"]) && !empty($_GET["lesson_id"])
&& isset($_GET["question_limit"]) && !empty($_GET["question_limit"])) {

/*SELECT column FROM table  
ORDER BY RAND()  
LIMIT 1   */

        $lessonId = $_GET["lesson_id"];
        $questionLimit = $_GET["question_limit"];
        $sorgu = $db->prepare("select * from questions where lesson_id=? order by RAND() LIMIT $questionLimit");
        $sorgula = $sorgu->execute([
            $lessonId
        ]);
        if($sorgula){
            $sorular = $sorgu->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($sorular);
        } else{
            $response->setMessage("Soru getirilirken hata oluştu");
            $response->setState(false);
            echo json_encode($response);
        }

} else{ // parametreler boş gelirse mesaj verelim
    $response->setMessage("Parametreler boş gelemez");
    $response->setState(false);
    echo json_encode($response);
}


?>