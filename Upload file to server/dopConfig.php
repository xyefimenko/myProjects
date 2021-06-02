<?php
function runCheck(){
    $path = "http://147.175.98.168".$_SERVER['REQUEST_URI'];
    $address_site = "http://147.175.98.168/dendo228_z1/";
    $explode = explode("=", $path);
    $directoryName = end($explode);
    $currentDirectory = "../files/".$directoryName."/";
    //echo $currentDirectory."=-============";
    if($path != $address_site){
        $files = scandir($currentDirectory);
        //var_dump($files);
        $c = 1;
        //krsort($files);
        // var_dump($files);
        foreach ($files as $file){
            if (!is_dir($currentDirectory."/".$file)){
                echo "<tr><th scope='row'>$c</th><td>$file</td>".//<a href='?dir=".$file."'></a>
                    "<td>".filesize($currentDirectory."/".$file)."</td>"."<td>".date("d.m.Y h:i:s", filectime($currentDirectory."/".$file))."</td></tr>";
                $c = $c + 1;
            }
            else {
                if ($file == "." || $file == ".."){
                    continue;
                }
                echo "<tr><th scope='row'>$c</th><td><a href='?dir=".$file."'>$file</a></td>". //http://147.175.98.168/files/".$file."
                    "<td></td>"."<td></td></tr>";
                $c = $c + 1;
            }
        }
            echo "</tbody></table>"."<a href='http://147.175.98.168/dendo228_z1/'>Back</a>";
    } else {
        return false;
    }
    echo "</div>"."<footer>
        @Created by Denys Yefimenko
         </footer>";
    return true;
}
