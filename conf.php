<?php
$serverinimi ="d125319.mysql.zonevs.eu";
$kasutajanimi ="d125319_kaka";
$parool ="killikene260899";
$andmebaas ="d125319_kaka ";
$yhendus = new mysqli($serverinimi, $kasutajanimi, $parool, $andmebaas);
$yhendus->set_charset("UTF8");