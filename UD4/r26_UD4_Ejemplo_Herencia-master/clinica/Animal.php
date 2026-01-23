
<?php
class Animal {
    protected string $nombre; //estará disponible también para las clases hijas
     protected ?Persona $dueno = null; // relación con Persona

    public function __construct(string $nombre) {
        $this->nombre = $nombre;
    }

    public function setDueno(Persona $dueno): void {
        $this->dueno = $dueno;
    }

    public function getDueno(): ?Persona {
        return $this->dueno;
    }

    public function hablar(): string {
        return "El animal hace un sonido.";
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function verInformacion(): string {
        $info = $this->nombre;
        if ($this->dueno !== null) {
            $info .= " (Dueño: " . $this->dueno->verInformacion() . ")";
        }
        else{
            $info .= " (Sin dueño)";
        }
        return $info;
    }
}
?>

