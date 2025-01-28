<?php

namespace App\Models;

use CodeIgniter\Model;

class GenericModel extends Model
{

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
    return $this->db->table($table)->insertBatch($data);
  }
}