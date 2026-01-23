<?php
class Persona {
    private string $nombre;
    private string $telefono;

    public function __construct(string $nombre, string $telefono) {
        $this->nombre = $nombre;
        $this->telefono = $telefono;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getTelefono(): string {
        return $this->telefono;
    }

    public function verInformacion(): string {
        return "{$this->nombre} ({$this->telefono})";
    }
}
