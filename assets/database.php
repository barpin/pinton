<?php

require_once('credentials.php');
GLOBAL $link;
$link = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
mysqli_set_charset($link, "utf8");
if(!$link){
    echo "Connection error" . "<br>";
    echo mysqli_connect_error() ;
    exit();
}


function qq ($query, $exitCode=false){
    GLOBAL $link;
    if(!($tres = mysqli_query($link, $query))){
        if ($exitCode){
            header("HTTP/1.1 ${exitCode}");
            exit;
        } else {
            exit(mysqli_error($link)." , in query ".$query);
        }
    }
    return $tres;
}

function entries ($query, $fetchrow = false, $assoc=false, $exitCode=false){
    $entries=qq($query, $exitCode);
    $entryarr=[];
    while($row= $fetchrow ? $entries->fetch_row() : $entries->fetch_assoc()){
        if ($assoc){
            $entryarr[$row[$assoc]]=$row;
        } else {
            $entryarr[]=$row;
        }
    }
    return $entryarr;
}

function sanitize ( $text){
    GLOBAL $link;
    return str_replace("\r\n", "\n", mysqli_real_escape_string($link, htmlspecialchars($text)));
}

