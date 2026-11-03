<?php
abstract class Monoplaza {
    protected string $nombrePiloto;
    protected string $nacionalidad;
    protected int $numeroMonoplaza;
    protected string $escuderia;
    protected int $puntosTotales;

    public function __construct(string $nombre, string $nacionalidad, int $numero, string $escuderia, int $puntos = 0) {
        $this->nombrePiloto = $nombre;
        $this->nacionalidad = $nacionalidad;
        $this->numeroMonoplaza = $numero;
        $this->escuderia = $escuderia;
        $this->puntosTotales = $puntos;
    }

    public function getNombre(): string { return $this->nombrePiloto; }
    public function getNacionalidad(): string { return $this->nacionalidad; }
    public function getNumero(): int { return $this->numeroMonoplaza; }
    public function getEscuderia(): string { return $this->escuderia; }
    public function getPuntos(): int { return $this->puntosTotales; }

    abstract public function posicionValida(int $posicion): bool;
    abstract public function otorgarPuntos(int $posicion, bool $vueltaRapida): void;
}
