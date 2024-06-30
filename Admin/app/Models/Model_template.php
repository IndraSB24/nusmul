<?php

namespace App\Models;
use CodeIgniter\Model;

class Model_template extends Model
{
    protected $table      = 'template';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;
    protected $useAutoIncrement = true;

    protected $allowedFields = [ 'id_type', 'isi', 'detail', 'picture' ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function reset_increment()
    {
        $sql = "ALTER TABLE template AUTO_INCREMENT=1";
        $this->db->query($sql);
    }
    
    // select all
    public function getAll(){
        //return $this->db->findAll();
    }
}