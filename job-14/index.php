<?php
require_once __DIR__ . '/Clothing.php';

$tee = new Clothing();
$tee->setQuantity(10);

$tee->addStocks(5);
$tee->removeStocks(3);

var_dump($tee->getQuantity());
