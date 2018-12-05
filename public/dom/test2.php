<?php

$dom = new \DOMDocument();
@$dom->loadHTMLFile('test.html');

//Evaluate Anchor tag in HTML
$xpath = new \DOMXPath($dom);
$hrefs = $xpath->evaluate("/html/body//a");

for ($i = 0; $i < $hrefs->length; $i++) {
    $href = $hrefs->item($i);
    $url = $href->getAttribute('href');

    //remove and set target attribute
    $href->removeAttribute('target');
    $href->setAttribute("target", "_blank");

    $newURL = $url.".au";

    //remove and set href attribute
    $href->removeAttribute('href');
    $href->setAttribute("href", $newURL);
}

// save html
$html=$dom->saveHTML();

echo $html;