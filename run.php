<?php

declare(strict_types=1);

// code here

        
$res = 'https://www.czc.cz/microsoft-surface-go-2-4gb-64gb/287541/produkt';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $res);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$html = curl_exec($ch);

$dom = new DOMDocument();
@ $dom->loadHTML($html);

$xpath = new DOMXPath($dom);

$prices = $xpath->query("//span[@class='price-vatin']");
$price = $prices->item(1);

$codes = $xpath->query("//span[@class='pd-next-in-category__item-value']");
$code = $codes->item(0);

$names = $xpath->query("//h1");
$name = $names->item(0);
        
$ratings = $xpath->query("//span[@class='rating__label']");
$rating = $ratings->item(0);

$save = fopen("vstup.txt", 'a');

fwrite($save, $price->nodeValue . "\r\n");
fwrite($save, $code->nodeValue);

fclose($save);


$vystup[] = ["cena" => $price->nodeValue, "kod vyrobce" => $code->nodeValue, "nazev" => $name->nodeValue, "hodnoceni" => $rating->nodeValue];

$soubor = json_encode($vystup);

$saveJson = fopen("vystup.json", 'a');
fwrite($saveJson, $soubor);
fclose($saveJson);

// $dispatcher = new \HPT\Dispatcher( ... );
// $dispatcher->run();
