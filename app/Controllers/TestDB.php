<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Database\Exceptions\DatabaseException;

class TestDB extends Controller
{
    public function index()
    {
        echo "Método index está sendo chamado.</br>";

        try {
            $db = \Config\Database::connect();
            echo "Conexão com o banco de dados estabelecida com sucesso.</br>";
            
            // Executar uma query de teste
            $query = $db->query('SELECT 1');
            echo "Query executada com sucesso.";
        } catch (DatabaseException $e) {
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
        }
    }
}

?>