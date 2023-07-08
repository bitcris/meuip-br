<?php
header("Access-Control-Allow-Origin: *");
      $dados = $_SERVER;
      //echo '<pre>';
      $ip = isset($_SERVER["HTTP_X_REAL_IP"]) ? $_SERVER["HTTP_X_REAL_IP"] : "Indisponível";
      $rota = isset($_SERVER["HTTP_X_FORWARDED_FOR"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : "Indisponível";
      $proxy = isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : "Indisponível";
      $plataforma = isset($_SERVER["HTTP_SEC_CH_UA_PLATFORM"]) ? $_SERVER["HTTP_SEC_CH_UA_PLATFORM"] : "Não identificado";
      $cli = isset($_SERVER["HTTP_SEC_CH_UA"]) ? $_SERVER["HTTP_SEC_CH_UA"] : "Não identificado";

      $elementos = explode(', "', $cli);
      $cliente = array();
      foreach ($elementos as $elemento) {
          if (strpos($elemento, 'v=') !== false) {
              $partes = explode('v=', $elemento);
              $valor = trim(str_replace(['"', ';'], '', $partes[0]));
              $cliente[] = $valor;
          }
      }

      $req = file_get_contents('https://freeipapi.com/api/json/' . $ip);
      $data = json_decode($req, true);

      $cidade = $data["cityName"];
      $pais = $data["countryName"];
      $latitude = $data["latitude"];
      $longitude = $data["longitude"];
      
?>

<!DOCTYPE html>
<html>
  <head>
  <html lang="pt-br">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="tt">Meu IP [ <?php echo "$ip - $pais ]"?></title>
    <meta name="description" content="Meu IP  <?php echo "$ip - $pais "?>">
    <meta name="cidade" content=" <?php echo "$cidade"?>">
    <meta name="keywords" content="meu ip, endereço ip, <?php echo "$cidade"?>, <?php echo "$ip"?>">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  </head>
  <body>

  <div class="geral">
    <div class="painel">
      <?php
      echo '<pre>';
      echo "IP DE ORIGEM: $ip";
      if($ip != $proxy){
        echo "<br>ÚLTIMO NÓ: $proxy";
      }
      echo '</pre>'
    ?>

    <div id="local">
      <?php
      echo '<pre>';
      echo "CIDADE: $cidade";
      echo "<br>PAÍS: $pais";
      echo '</pre>'
      ?>
    </div>  

    <div class="dados">
      <?php
      echo '<pre>';
      echo "SISTEMA OPERACIONAL: $plataforma";
      echo "<br>CLIENTE: $cliente[2]";
      echo '</pre>';
      ?>
    </div>
  </div> <br><br>

  <div id="map"></div>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <script>

    var latitude = "<?php echo $latitude; ?>";
    var longitude = "<?php echo $longitude; ?>";
    var map = L.map('map').setView([latitude, longitude], 5);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
      maxZoom: 18,
    }).addTo(map);
    L.marker([latitude, longitude]).addTo(map);
  </script>
  <br>
  </body>
</html>
