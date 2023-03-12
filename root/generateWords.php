<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  </head>
  <body>
    <?php
    header('Content-Type: text/html; charset=utf-8');
    $command = escapeshellcmd('python .\burtu_virknu_salicejs.py 3 50'); # argumenti norāda analizējamo burtu virkņu garumu (2, 3 vai 4) un ģenerējamo vārdu skaitu
    $output = shell_exec($command);
    // echo $output;
    var_dump(json_decode($output));
    ?>
  </body>
</html>
