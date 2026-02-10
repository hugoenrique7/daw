<?php
namespace App\Repository;

use App\Model\Biblioteca\Usuario;
use PDO;

class UsuarioRepository extends AbstractRepository
{
    protected string $table = 'usuarios';

    public function findByEmail(string $email): ?Usuario
    {
        $stmt = $this->pdo->prepare("SELECT * FROM  {$this->table} WHERE email = ?");
        $stmt->execute([$email]);
        $datos = $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        if ($datos) {
            $usuario = new Usuario($datos['nombre'], $datos['email']);
            $usuario->setId($datos['id']);
            return $usuario;
        }
        else {
            return null;
        }   
    }

  
    public function create($usuario): ?object
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO  {$this->table}(nombre, email) VALUES (?, ?)"
        );
        $stmt->execute([
            $usuario->getNombre(),
            $usuario->getEmail()
        ]);

        //Habría que añadir a Usuario el atributo id nullable y su getter y setter para que esto funcione
        $id = $this->pdo->lastInsertId();
        if($id === false) {
            return null;
        }
        $usuario->setId($id);
        return $usuario;
    
    }
}