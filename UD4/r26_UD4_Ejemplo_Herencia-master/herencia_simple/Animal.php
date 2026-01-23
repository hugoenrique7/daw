
<?php
class Animal {
    protected string $nombre; //estará disponible también para las clases hijas

    public function __construct(string $nombre) {
        $this->nombre = $nombre;
    }

    public function hablar(): string {
        return "El animal hace un sonido.";
    }

    public function getNombre(): string {
        return $this->nombre;
    }
}
?>

