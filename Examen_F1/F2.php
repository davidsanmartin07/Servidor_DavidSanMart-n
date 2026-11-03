<?php
require_once 'Monoplaza.php';
require_once 'F1.php';

class F2 extends Monoplaza {
    private bool $puntosSuperlicencia;

    public function __construct(string $nombre, string $nac, int $num, string $esc, int $puntos, bool $puntosSuperlicencia) {
        parent::__construct($nombre, $nac, $num, $esc, $puntos);
        $this->puntosSuperlicencia = $puntosSuperlicencia;
    }

    public function tieneSuperlicencia(): bool { return $this->puntosSuperlicencia; }

    public function posicionValida(int $posicion): bool {
        return $posicion >= 1 && $posicion <= 24;
    }

    public function otorgarPuntos(int $posicion, bool $vueltaRapida): void {
        if (!$this->posicionValida($posicion)) return;

        $puntos = [1=>10, 2=>8, 3=>7, 4=>6, 5=>5, 6=>4, 7=>3, 8=>2, 9=>1];

        if (isset($puntos[$posicion])) {
            $this->puntosTotales += $puntos[$posicion];
        }

        // Vuelta rápida: +1 si acaba entre los diez primeros (incluida la 10ª posición)
        if ($vueltaRapida && $posicion <= 10) {
            $this->puntosTotales += 1;
        }
    }

    public function subirCategoria(string $patrocinador): F1 {
        return new F1($this->getNombre(), $this->getNacionalidad(), $this->getNumero(), $this->getEscuderia(), $this->getPuntos(), $patrocinador);
    }
}
