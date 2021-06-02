<?php
$xml = simplexml_load_file('../meniny.xml');

foreach ($xml->zaznam as $z){
    if(isset($z->SKdni)){
        echo "<h3>Date and days SK: ".$z->den." ".$z->SKdni."</h3>";
    }
}
