<?php
require_once 'Monoplaza.php';

class F1 extends Monoplaza {
    private string $patrocinadorPrincipal;

    public function __construct(string $nombre, string $nac, int $num, string $esc, int $puntos, string $patrocinador) {
        parent::__construct($nombre, $nac, $num, $esc, $puntos);
        $this->patrocinadorPrincipal = $patrocinador;
    }

    public function getPatrocinadorPrincipal(): string { return $this->patrocinadorPrincipal; }

    public function posicionValida(int $posicion): bool {
        return $posicion >= 1 && $posicion <= 22; // Máximo 22 pilotos
    }

    public function otorgarPuntos(int $posicion, bool $vueltaRapida): void {
        if (!$this->posicionValida($posicion)) return;

        $puntos = [1=>25, 2=>18, 3=>15, 4=>12, 5=>10, 6=>8, 7=>6, 8=>4, 9=>2, 10=>1];

        if (isset($puntos[$posicion])) {
            $this->puntosTotales += $puntos[$posicion];
        }

        // Vuelta rápida: +1 solo si acaba entre los diez primeros
        if ($vueltaRapida && $posicion <= 10) {
            $this->puntosTotales += 1;
        }
    }
}
