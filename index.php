<?php

/*
    Code from: 
    https://www.codingwithjesse.com/blog/use-accept-language-header/ 
*/

$langs = array();

if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    // break up string into pieces (languages and q factors)
    preg_match_all('/([a-z]{1,8}(-[a-z]{1,8})?)\s*(;\s*q\s*=\s*(1|0\.[0-9]+))?/i', $_SERVER['HTTP_ACCEPT_LANGUAGE'], $lang_parse);

    if (count($lang_parse[1])) {
        // create a list like "en" => 0.8
        $langs = array_combine($lang_parse[1], $lang_parse[4]);

        // set default to 1 for any without q factor
        foreach ($langs as $lang => $val) {
            if ($val === '') $langs[$lang] = 1;
        }

        // sort list based on value	
        arsort($langs, SORT_NUMERIC);
    }
}

// uncomment to debug
// echo "<pre>";
// var_dump($_SERVER['HTTP_ACCEPT_LANGUAGE']);
// print_r($lang_parse);
// print_r($langs);
// echo "</pre>";

// look through sorted list and use first one that matches our languages
foreach ($langs as $lang => $val) {
    if (strpos($lang, 'it') === 0) {
        header("Location: https://sundreamglass.ch/index-it.html");
        exit;
    } 
    else if (strpos($lang, 'de') === 0) {
        header("Location: https://sundreamglass.ch/index-de.html");
        exit;
    }
}

// default
header("Location: https://sundreamglass.ch/index-it.html");