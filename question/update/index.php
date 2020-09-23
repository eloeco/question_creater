<?php

require "../../settings/config.php";
require "../../models/response.php";

// soru düzenleyen servis yazalım

$response = new Response();    

// parametrelerin gelip gelmediğini kontrol edelim
if(isset($_POST["question_id"]) && !empty($_POST["question_id"])) {

    $questionId = $_POST["question_id"];
    $questionQuestion = $_POST["question_question"];
    $questionAnswers = $_POST["question_answers"];
    $questionValidateAnswer = $_POST["question_validate_answer"];
    $questionStatus = 1;

    $sorgu = $db->prepare("UPDATE questions SET question_question=?, question_answers=?, question_validate_answer=?, 
    question_status=? WHERE question_id=?");
    $sorgula = $sorgu->execute([
        $questionQuestion,$questionAnswers,$questionValidateAnswer,$questionStatus,$questionId
    ]);
    // sorgu başarılı bir şekilde çalışırsa
    if($sorgula){
        $response->setMessage("Ders başarılı bir şekilde güncellendi");
        $response->setState(true);
        echo json_encode($response);
    } else{
        $response->setMessage("Sorgu çalışırken hata ile karşılaşıldı");
        $response->setState(false);
        echo json_encode($response);
    }

} else{
    $response->setMessage("Parametreler boş gelemez");
    $response->setState(false);
    echo json_encode($response);
}

?>