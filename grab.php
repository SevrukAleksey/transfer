<?php

set_time_limit(0);

//---------------------------------------------------------------
//$text = file_get_contents('https://webref.ru');
//$doc = new DOMDocument();
//$doc->loadHTML($text);
//$links = $doc->getElementsByTagName('a');
//foreach ($links as $link) {
//    echo $link->getAttribute('href') . '<br/>';
//}
//
//$ch = curl_init('https://webref.ru');
//curl_setopt($ch, CURLOPT_USERAGENT, 'IE20');
//curl_setopt($ch, CURLOPT_HEADER, 0);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, '1');
//$text = curl_exec($ch);
//$doc = new DOMDocument();
//$doc->loadHTML($text);
//$links = $doc->getElementsByTagName('a');
//foreach ($links as $link) {
//    echo $link->getAttribute('href') . '<br/>';
//}


function get_page($url, $post = '', $ref = '', $cookie = '', $ua = "Opera 9.64 (compatible; MSIE 6.0; Windows NT 5.1; ru)", $proxy = '') {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    curl_setopt($ch, CURLOPT_REFERER, $ref);
    curl_setopt($ch, CURLOPT_PROXY, $proxy);

    if ($post !== '') {
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }

    $headers [] = "Accept: text/html, application/xml;q=0.9, application/xhtml+xml, image/png, image/jpeg, image/gif, image/x-xbitmap, */*;q=0.1";
    $headers [] = "Accept-Language: ru,en;q=0.9,ru-RU;q=0.8";
    $headers [] = "Connection: close";
    $headers [] = "Cache-Control: no-store, no-cache, must-revalidate";

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 1); // тут лучше поставить 0, если куки не нужны 
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    @curl_setopt($ch, CURLOPT_COOKIE, $cookie);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
    $result = curl_exec($ch);
    curl_close($ch);
    if ($result)
	return $result;
    else
	return false;
}

$text = get_page('https://webref.ru');
$doc = new DOMDocument();
$doc->loadHTML($text);
$links = $doc->getElementsByTagName('a');
foreach ($links as $link) {
    echo $link->getAttribute('href') . '<br/>';
}