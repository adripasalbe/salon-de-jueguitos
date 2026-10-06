<?php
// Salón recreativo · ranking de récords
// Este fichero NO hay que modificarlo en la práctica.

$host = getenv('DB_HOST') ?: 'db';
$name = getenv('DB_NAME') ?: 'arcade';
$user = getenv('DB_USER') ?: '';
$pass = getenv('DB_PASS') ?: '';

$error = null;
$filas = [];

if (!class_exists('mysqli')) {
    $error = 'PHP no tiene la extensión mysqli. Revisa tu Dockerfile.';
} else {
    try {
        $db = new mysqli($host, $user, $pass, $name);
        $res = $db->query(
            "SELECT jugador, juego, puntos FROM ranking
             WHERE jugador NOT LIKE 'MONEDA%'
             ORDER BY puntos DESC LIMIT 10"
        );
        $filas = $res->fetch_all(MYSQLI_ASSOC);
        $db->close();
    } catch (mysqli_sql_exception $e) {
        $error = 'No se pudo conectar con la base de datos: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Salón recreativo</title>
  <style>
    body { background:#0b0b1e; color:#39ff14; font-family:"Courier New",monospace; text-align:center; padding:2rem; }
    h1 { color:#ff2bd6; text-shadow:0 0 8px #ff2bd6; }
    table { margin:1rem auto; border-collapse:collapse; min-width:420px; }
    th, td { border:1px solid #39ff14; padding:.4rem .9rem; }
    th { color:#00e5ff; }
    .error { color:#ff5555; border:2px dashed #ff5555; padding:1rem; display:inline-block; }
    .moneda { color:#ffd700; font-size:1.2rem; margin-top:1.5rem; }
    .reloj { margin-top:2rem; color:#00e5ff; }
  </style>
</head>
<body>
  <h1>&#128377; SALÓN RECREATIVO &#128377;</h1>

  <?php if ($error): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
  <?php else: ?>
    <table>
      <tr><th>#</th><th>Jugador</th><th>Juego</th><th>Puntos</th></tr>
      <?php foreach ($filas as $i => $f): ?>
        <tr>
          <td><?= $i + 1 ?></td>
          <td><?= htmlspecialchars($f['jugador']) ?></td>
          <td><?= htmlspecialchars($f['juego']) ?></td>
          <td><?= number_format($f['puntos'], 0, ',', '.') ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
    <p class="moneda">&#129689; MONEDA 2: ARC-Q9M2</p>
  <?php endif; ?>

  <div class="reloj">
    <p>Hora del servidor (PHP): <strong><?= date('H:i:s') ?></strong></p>
    <p>Hora del navegador (JS): <strong id="hora-cliente">...</strong></p>
  </div>

  <script>
    document.getElementById('hora-cliente').textContent = new Date().toLocaleTimeString('es-ES');
  </script>
</body>
</html>
