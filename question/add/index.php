<?php

require "../../settings/config.php";
require "../../models/response.php";

// soru ekleme yapalım

$response = new Response();

if(isset($_POST["lesson_id"]) && !empty($_POST["lesson_id"]) 
&& isset($_POST["question_question"]) && !empty($_POST["question_question"])){

    $lessonId = $_POST["lesson_id"];
    $questionQuestion = $_POST["question_question"];
    $questionAnswers = $_POST["question_answers"];
    $questionValidateAnswer = $_POST["question_validate_answer"];
    $questionStatus = 1;

    $sorgu = $db->prepare("insert into questions set
    lesson_id = ?,
    question_question = ?,
    question_answers = ?,
    question_validate_answer = ?,
    question_status = ?
    ");
    $sorgula = $sorgu->execute([
        $lessonId,$questionQuestion,$questionAnswers,$questionValidateAnswer,$questionStatus
    ]);
    // sorgu başarılı bir şekilde çalışırsa
    if($sorgula){
        $response->setMessage("Soru başarılı bir şekilde eklendi");
        $response->setState(true);
        echo json_encode($response);
    } else{ // sorgu çalışırken hata alınırsa
        $response->setMessage("Soru eklenirken hata ile karşılaşıldı");
        $response->setState(false);
        echo json_encode($response);
    }


} else{
    $response->setMessage("Parametreler boş gelemez");
    $response->setState(false);
    echo json_encode($response);
}


?>