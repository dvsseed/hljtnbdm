<?php
header("Content-Type:text/html; charset=utf-8");
function js2PhpTime($jsdate){
  if(preg_match('@(\d+)-(\d+)-(\d+)\s+(\d+):(\d+)@', $jsdate, $matches)==1){
    //$ret = mktime($matches[4], $matches[5], 0, $matches[1], $matches[2], $matches[3]);
    $ret = mktime($matches[4], $matches[5], 0, $matches[2], $matches[3], $matches[1]);
    //echo $matches[4] ."-". $matches[5] ."-". 0  ."-". $matches[1] ."-". $matches[2] ."-". $matches[3];
  }else if(preg_match('@(\d+)-(\d+)-(\d+)@', $jsdate, $matches)==1){
    //$ret = mktime(0, 0, 0, $matches[1], $matches[2], $matches[3]);
    $ret = mktime(0, 0, 0, $matches[2], $matches[3], $matches[1]);
    //echo 0 ."-". 0 ."-". 0 ."-". $matches[1] ."-". $matches[2] ."-". $matches[3];
  }
  return $ret;
}

function php2JsTime($phpDate){
    //echo $phpDate;
    //return "/Date(" . $phpDate*1000 . ")/";
    //return date("m/d/Y H:i", $phpDate);
    return date("Y-m-d H:i", $phpDate);
}

function php2MySqlTime($phpDate){
    return date("Y-m-d H:i:s", $phpDate);
}

function mySql2PhpTime($sqlDate){
    $arr = date_parse($sqlDate);
    return mktime($arr["hour"],$arr["minute"],$arr["second"],$arr["month"],$arr["day"],$arr["year"]);
}
?>