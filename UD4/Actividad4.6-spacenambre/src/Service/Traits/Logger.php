<?php
namespace App\Service\Traits;
{
    
}

trait Logger {
    private string $nivelLog = 'INFO';
    private string $fileName = 'app.log';

    public function log(string $mensaje, ?string $nivel = null, ?string $fileName=null): void {
        $nivel = $nivel?? $this->nivelLog;
        $fileName = $fileName?? $this->fileName;
      //escribe en un fichero app.log en el directorio actual
        error_log("[$nivel] " . date('Y-m-d H:i:s') . " - " . $mensaje . "\n", 3, __DIR__ . '/'. $fileName);
    }
}
