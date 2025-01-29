<?php

namespace App\Models;

use CodeIgniter\Model;
use DateTime;
use Exception;

class PacientesModel extends Model
{
  protected $table = 'cad_pacientes';
  protected $columns = [
    'id',
    'nome',
    'data_nascimento',
    'sexo',
    'endereco',
    'telefone'
  ];

  public function get($search = null, $export = false)
  {
    $db = \Config\Database::connect();
    $driver = getenv('database_default_DBDriver');
    $query = $db->table($this->table);

    $result['total']['geral'] = $query->countAllResults(false);

    if ($search) {
      $dataFormat = $this->dateFormat($search);
      $phoneFormat = $this->phoneFormat($search);
      $filterSex = $this->filterSex($search);

      if ($driver === 'Postgre') {
        $query->groupStart()
          ->like('CAST(id AS text)', $search, 'both')
          ->orLike('CAST(telefone AS text)', $phoneFormat, 'both')
          ->orLike('nome', $search, 'both')
          ->orLike('to_char(data_nascimento, "YYYY-MM-DD")', $dataFormat, 'both')
          ->orLike('sexo', $filterSex, 'both')
          ->orLike('endereco', $search, 'both')
          ->groupEnd();
      } elseif ($driver === 'MySQLi') {
        $query->groupStart()
          ->like('id', $search, 'both')
          ->orLike('telefone', $phoneFormat, 'both')
          ->orLike('nome', $search, 'both')
          ->orLike('data_nascimento', $dataFormat, 'both')
          ->orLike('sexo', $filterSex, 'both')
          ->orLike('endereco', $search, 'both')
          ->groupEnd();
      }
    }

    $result['total']['filtrado'] = $query->countAllResults(false);

    $start = isset($_GET['start']) ? (int) $_GET['start'] : 1;
    $length = isset($_GET['length']) ? (int) $_GET['length'] : 10;

    $columnsOrder = [
      1 => 'id',
      2 => 'nome',
      3 => 'data_nascimento',
      4 => 'sexo',
      5 => 'endereco',
      6 => 'telefone'
    ];

    $order = $_GET['order'][0]['column'] ??= 1;
    $dir = $_GET['order'][0]['dir'] ??= 'asc';
    $columnName = $columnsOrder[$order];

    if ($columnName == 'data_nascimento') {
      $query->orderBy($columnName, $dir);
    } else {
      $query->orderBy($columnName, $dir);
    }

    if ($export == false) {
      $result['registros'] = $query->select($this->columns)
        ->limit($length, $start)
        ->get()
        ->getResultArray();
    } else {
      $result['registros'] = $query->select($this->columns)
        ->get()
        ->getResultArray();
    }

    return $result;
  }

  public function dateFormat($date)
  {
    $dateUS = trim(str_replace('/', '-', $date));
    try {
      $dateTime = new DateTime($dateUS);
      return $dateTime->format('Y-m-d');
    } catch (Exception $e) {
      return $date;
    }
  }

  public function phoneFormat($phone)
  {
    $find = ['(', ')', '.', '-', ' '];
    return str_replace($find, [''], $phone);
  }



  public function filterSex($search)
  {
    if (strstr('masculino', strtolower($search))) {
      return 'M';
    } elseif (strstr('feminino', strtolower($search))) {
      return 'F';
    } elseif (strstr('outro', strtolower($search))) {
      return 'O';
    }

    return $search;
  }
}
