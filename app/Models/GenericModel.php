<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\Exceptions\DataException;

class GenericModel extends Model
{
  public function __construct()
  {
    parent::__construct();
    $this->db = \Config\Database::connect();
  }

  public function insertData($table, $data)
  {
    return $this->db->table($table)->insert($data);
  }

  public function updateData($table, $data, $id)
  {
    return $this->db->table($table)->update($id, $data);
  }

  public function importDataCSV($table, $data)
  {
    try {
      if (!$this->db->table($table)->insertBatch($data)) {
        throw new DataException;
      }

      return $this->db->affectedRows();
    } catch (DataException $e) {
      return false;
    }
  }
}