<?php
$xml = simplexml_load_file('../meniny.xml');

foreach ($xml->zaznam as $z){
    if(isset($z->CZsviatky)){
        echo "<h3>Date and celebrations CZ: ".$z->den." ".$z->CZsviatky."</h3>";
    }
}
