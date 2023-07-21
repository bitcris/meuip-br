
<!DOCTYPE html>
<html>
  <head>
  <html lang="pt-br">
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="tt">Meu IP [ <?php echo "$ip - $pais ]"?></title>
    <meta name="description" content="Meu IP  <?php echo "$ip"?>">
    <meta name="cidade" content=" <?php echo "$cidade"?>">
    <meta name="keywords" content="meu ip, endereço ip, <?php echo "$cidade"?>, <?php echo "$ip"?>">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  </head>
  <body>

    <script type="application/ld+json">
    var meuIp = "<?php echo $ip; ?>";
    {
      "@context": "https://schema.org",
      "@type": "Organization", meuIp,
      "name": "Meu IP",
      "description": meuIp
    }
  </script>

  <div class="banner">
    <span>
      <img src="banner.png" alt="">
    </span>
  </div>
  

  


   <div class="rodape">
    <pre>
    @cafeware | 2023
    </pre>
   </div>

  </body>
</html>
