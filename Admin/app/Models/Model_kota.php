<?php

namespace App\Models;
use CodeIgniter\Model;

class Model_kota extends Model
{
    protected $table      = 'list_kota';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;
    protected $useAutoIncrement = true;

    protected $allowedFields = [ 'kode_provinsi', 'kode', 'nama' ];

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
        $sql = "ALTER TABLE list_kota AUTO_INCREMENT=1";
        $this->db->query($sql);
    }
    
    // public function getAll() {
    //     $this->select('kota.*, p.nama');
    //     $this->join('list_provinsi lp', 'lp.id = kota.id_provinsi', 'left');
        
    //     return $this->findAll();
    // }
    
    public function getAllRaw() {
        $sql = "SELECT k.*, lp.nama as nama_provinsi
                FROM list_kota k
                LEFT JOIN list_provinsi lp ON lp.kode = k.kode_provinsi";
        
        $query = $this->db->query($sql);
        return $query->getResult();
    }
    
    public function getByProvinsi($kode_provinsi) {
        $sql = "SELECT k.*, lp.nama as nama_provinsi
                FROM list_kota k
                LEFT JOIN list_provinsi lp ON lp.kode = k.kode_provinsi
                WHERE k.kode_provinsi =".$kode_provinsi;
        $query = $this->db->query($sql);
        return $query->getResult();
    }

}