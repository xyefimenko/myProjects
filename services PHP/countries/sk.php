<?php
$xml = simplexml_load_file('../meniny.xml');

foreach ($xml->zaznam as $z){
    if(isset($z->SKsviatky)){
        echo "<h3>Date and celebrations SK: ".$z->den." ".$z->SKsviatky."</h3>";
    }
}
