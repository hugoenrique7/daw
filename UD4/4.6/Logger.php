<?php

trait Logger {
    private string $nivelLog = 'INFO';
    private string $nombre;  
    public function log(string $mensaje, ?string $nivel = null, string $nombre="info" ): void {
        $nivel = $nivel ?? $this->nivelLog;
      //escribe en un fichero app.log en el directorio actual
        error_log("[$nivel] " . date('Y-m-d H:i:s') . " - " . $mensaje . "\n", 3, __DIR__ . '/${$nombre}.log');
    }
}
