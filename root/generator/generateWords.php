<?php
// header('Content-Type: text/html; charset=utf-8');
$word_generation_command = escapeshellcmd('python .\generator\burtu_virknu_salicejs.py 4 40'); # Argumenti norāda analizējamo burtu virkņu garumu (2, 3 vai 4) un ģenerējamo vārdu skaitu
// $word_generation_command = escapeshellcmd('python .\generator\burtu_virknu_salicejs.py 3 20')." 2>&1"; # Līdzīgi iepriekšējai rindai, bet kļūdas gadījumā izvada ziņu
$word_generation_output = shell_exec($word_generation_command);
$word_array = json_decode($word_generation_output)->{"vardi"};
// echo $word_generation_output;
?>
