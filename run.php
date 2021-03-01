<?php

declare(strict_types=1);

// code here

$res = 'https://www.czc.cz/acer-predator-triton-500-pt515-52-70hb-cerna/289883/produkt';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $res);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$html = curl_exec($ch);

$dom = new DOMDocument();
@ $dom->loadHTML($html);

$xpath = new DOMXPath($dom);

$nodeList = $xpath->query("//span[@class='price-vatin']");
$node = $nodeList->item(1);

$nodeList2 = $xpath->query("//span[@class='pd-next-in-category__item-value']");
$node2 = $nodeList2->item(0);


$save = fopen("vstup.txt", 'a');

fwrite($save, $node->nodeValue . "\r\n");
fwrite($save, $node2->nodeValue);

fclose($save);


$vystup[] = ["cena" => $node->nodeValue, "kod vyrobce" => $node2->nodeValue];

$soubor = json_encode($vystup);

$saveJson = fopen("vystup.json", 'a');
fwrite($saveJson, $soubor);
fclose($saveJson);


// $dispatcher = new \HPT\Dispatcher( ... );
// $dispatcher->run();
