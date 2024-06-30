<?php

namespace App\Models;
use CodeIgniter\Model;

class Model_list_posisi extends Model
{
    protected $table      = 'list_posisi';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;
    protected $useAutoIncrement = true;

    protected $allowedFields = [ 'nama', 'deskripsi', 'created_by' ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'name'      => 'required|min_length[3]',
        'price'     => 'required|numeric',
    ];

    protected $validationMessages = [
        'name'        => [
            'required' => 'Bagian Name Harus diisi',
            'min_length' => 'Minimal 3 Karakter'
        ],
        'price'        => [
            'required' => 'Bagian Price Harus diisi',
            'numeric' => 'Hanya bisa diisi dengan angka'
        ]
    ];
    protected $skipValidation  = true;

    public function reset_increment()
    {
        $sql = "ALTER TABLE list_posisi AUTO_INCREMENT=1";
        $this->db->query($sql);
    }
    
    public function getAllRaw() {
        $sql = "
            SELECT 
                *
            FROM list_posisi
            WHERE deleted_at IS NULL
            ORDER BY nama DESC;
        ";
        
        $query = $this->db->query($sql);
        return $query->getResult();
    }
    
    public function getMainDatatable($filters = [])
    {
        $builder = $this->db->table('list_posisi lp');
        $builder->select('lp.*');
        $builder->where('lp.deleted_at', null);
        $builder->orderBy('lp.nama', 'DESC');
        
        return $builder->get()->getResult();
    }


}