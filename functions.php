<?php

function get_webpage($url) {
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function count_words($keywords = [], $content = ''){
    //Remove html tags from the document, to only keep content
    $content = strip_tags($content);
    //Since substr_count is case sensitive, transform all text to lower case to avoid skewing results
    $content = strtolower($content);
    //A loop that allows for an array of multiple keywords to be passed to function
    foreach ($keywords as $word) {
        //Counts the number of times a given substring appears in a bigger string
        $nr = substr_count($content, $word);
        //Display results
        echo "<p><strong>$word</strong> appears <strong>$nr</strong> times in the document</p>";
    }
}