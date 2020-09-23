<?php

// tüm dersleri çeken servis

require "../../settings/config.php";
require "../../models/response.php";

$response = new Response();

$sorgu = $db->prepare("select * from lessons");
$sorguDurumu = $sorgu->execute();

// sorgu başarılı bir şekilde çalışırsa
if($sorguDurumu){
    $dersler = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($dersler);
} else{
    $response->setMessage("Sorgu çalıştırılırken hata ile karşılaşıldı");
    $response->setState(false);
    echo json_encode($response);
}





?>