<?php
function truncateStr($str, $maxChars=50, $holder="...."){

    // ตรวจสอบความยาวของประโยค
    // if (strlen($str) > $maxChars ){
    //     return trim(substr($str, 0, $maxChars,'UTF-8')) . $holder;
    // }   else {
    //     return $str;
    // }

    if (strlen($str) > $maxChars ){
        return strip_tags(trim(mb_substr($str, 0, $maxChars,'UTF-8'))) . $holder;
    }   else {
        return strip_tags($str);
    }

    //by puwanath baibua kapongidea.com
}
?>
