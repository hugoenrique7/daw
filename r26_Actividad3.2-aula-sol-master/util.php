<?php

require_once __DIR__ . '/vendor/autoload.php';

function getPublishers()
{
    try {
        $collection = (new MongoDB\Client)->biblioteca->editorial;
        $data=$collection->find([],);
        return  $data;
   
    } catch (Exception $th) {
       error_log($th);
    }
    
        
   
}

function showPublishers($data)
{
    if ($data) {
        
        echo "<table class='table'><tr><th>Id</th> <th> Nombre </th> </tr> <tbody>";

        foreach ($data as $fila) {
            echo "<tr> <td> {$fila['_id']}</td>
            <td> {$fila['name']}</td></tr>";
        }
        echo "</tbody></table>";
    } else {
        showMsg("No se encontraron registros", "primary");
    }
}

function showMsg(string $msg, string $claseCSS)
{
    echo "<div class=\"alert alert-$claseCSS\" role=\"alert\">
  $msg
</div>
";
}

function insertPublisher(string $nombre)
{
    //$client = new MongoDB\Client();
    $collection = (new MongoDB\Client)->biblioteca->editorial;
    $insertOneResult = $collection->insertOne(
        [
            'name' => $nombre,

        ]
    );

   
    var_dump($insertOneResult->getInsertedId());
}


