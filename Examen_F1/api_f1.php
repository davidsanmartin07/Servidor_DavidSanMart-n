<?php
$dorsales = [16, 44];
$datosPilotos = [];

foreach ($dorsales as $numero) {
    // Apuntamos a una session_key específica que contiene datos confirmados en la API
    $url = "https://api.openf1.org/v1/drivers?driver_number=$numero&session_key=9158";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
    
    $respuesta = curl_exec($ch);
    $codigo_estado = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if ($respuesta !== false && $codigo_estado == 200) {
        $datos = json_decode($respuesta, true);
        if (is_array($datos) && !empty($datos)) {
            $datosPilotos[] = $datos[0];
        }
    }
}

echo "<h3>Datos reales obtenidos de la API (Pilotos 16 y 44):</h3>";
echo "<pre>";
print_r($datosPilotos);
echo "</pre>";
?>
