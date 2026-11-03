<?php
require_once 'Monoplaza.php';
require_once 'F2.php';

class F3 extends Monoplaza {
    private string $nombreAcademia;

    public function __construct(string $nombre, string $nac, int $num, string $esc, int $puntos, string $nombreAcademia) {
        parent::__construct($nombre, $nac, $num, $esc, $puntos);
        $this->nombreAcademia = $nombreAcademia;
    }

    public function getNombreAcademia(): string { return $this->nombreAcademia; }

    public function posicionValida(int $posicion): bool {
        return $posicion >= 1 && $posicion <= 30;
    }

    public function otorgarPuntos(int $posicion, bool $vueltaRapida): void {
        if (!$this->posicionValida($posicion)) return;

        $puntos = [1=>10, 2=>8, 3=>7, 4=>6, 5=>5, 6=>4, 7=>3, 8=>2, 9=>1];

        if (isset($puntos[$posicion])) {
            $this->puntosTotales += $puntos[$posicion];
        }
        // F3 no da puntos por vuelta rápida
    }

    public function subirCategoria(bool $puntosSuperlicencia): F2 {
        return new F2($this->getNombre(), $this->getNacionalidad(), $this->getNumero(), $this->getEscuderia(), $this->getPuntos(), $puntosSuperlicencia);
    }
}
