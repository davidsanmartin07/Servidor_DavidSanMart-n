<?php
require_once 'Monoplaza.php';
require_once 'F3.php';

class F4 extends Monoplaza {
    private string $paisCategoria;

    public function __construct(string $nombre, string $nac, int $num, string $esc, int $puntos, string $paisCategoria) {
        parent::__construct($nombre, $nac, $num, $esc, $puntos);
        $this->paisCategoria = $paisCategoria;
    }

    public function getPaisCategoria(): string { return $this->paisCategoria; }

    public function posicionValida(int $posicion): bool {
        return $posicion >= 1 && $posicion <= 30;
    }

    public function otorgarPuntos(int $posicion, bool $vueltaRapida): void {
        if (!$this->posicionValida($posicion)) return;

        $puntos = [1=>25, 2=>18, 3=>15, 4=>12, 5=>10, 6=>8, 7=>6, 8=>4, 9=>2, 10=>1];

        if (isset($puntos[$posicion])) {
            $this->puntosTotales += $puntos[$posicion];
        }
        // F4 no da puntos por vuelta rápida
    }

    public function subirCategoria(string $nombreAcademia): F3 {
        return new F3($this->getNombre(), $this->getNacionalidad(), $this->getNumero(), $this->getEscuderia(), $this->getPuntos(), $nombreAcademia);
    }
}
