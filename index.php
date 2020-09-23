<?php


require "settings/config.php";


if($db){
    echo "Bağlantı başarılı";
    echo "<br>bu web servis Elif Ecem Aydınlı tarafından 20 günlük staj programı için PHP kullanılarak yazıldı";
} else{
    echo "Bağlantı başarısız";
}


?>