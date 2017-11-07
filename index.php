<?php

$ch = curl_init("http://www.nicholassolutions.com/tutorials/php/headers.html");
$fileName = "headers.html";
$fp = fopen($fileName, "w");

curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);
curl_close($ch);
fclose($fp);
$content = file_get_contents($fileName);
$keywords = ['header', 'http', 'php'];
$content = strip_tags($content);
$content = strtolower($content);


foreach ($keywords as $word) {
    $nr = substr_count($content, $word);
    echo "<p><strong>$word</strong> appears <strong>$nr</strong> times in the document</p>";
}

