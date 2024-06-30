<?php

namespace App\Models;
use CodeIgniter\Model;

class Model_provinsi extends Model
{
    protected $table      = 'list_provinsi';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;
    protected $useAutoIncrement = true;

    protected $allowedFields = [ 'kode', 'nama' ];

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
        $sql = "ALTER TABLE list_provinsi AUTO_INCREMENT=1";
        $this->db->query($sql);
    }
    
    // public function getAll() {
    //     $this->select('customer.*, lp.nama');
    //     $this->join('list_provinsi lp', 'lp.id = customer.id_provinsi', 'left');
        
    //     return $this->findAll();
    // }
    
    // public function getAllWithJoin() {
    //     $sql = "SELECT customer.*, lp.nama
    //             FROM customer
    //             LEFT JOIN list_provinsi lp ON lp.id = customer.id_provinsi";
        
    //     $query = $this->db->query($sql);
    //     return $query->getResult();
    // }

}