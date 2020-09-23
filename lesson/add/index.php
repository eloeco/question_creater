<?php

require "../../settings/config.php";
require "../../models/response.php";

// kullanıcıya ders ekletelim

$response = new Response();
// parametreleri kontrol edelim
if(isset($_POST["lesson_name"]) && !empty($_POST["lesson_name"])
&& isset($_POST["lesson_code"]) && !empty($_POST["lesson_code"])){
    $lessonName = $_POST["lesson_name"];
    $lessonCode = $_POST["lesson_code"];
    $sorgu = $db->prepare("insert into lessons set
    lesson_name = ?,
    lesson_code = ?
    ");
    $sorgula = $sorgu->execute([
        $lessonName,$lessonCode
    ]);
    // sorgu başarılı bir şekilde çalışır ise
    if($sorgula){
        $response->setMessage("Ders " .$lessonName. " başarılı bir şekilde eklendi");
        $response->setState(true);
        echo json_encode($response);
    } else{
        $response->setMessage("Sorgu çalışırken hata ile karşılaşıldı");
        $response->setState(false);
        echo json_encode($response);
    }


}
else{
    $response->setMessage("Parametreler boş gelemez");
    $response->setState(false);
    echo json_encode($response);
}

?>