<?php

namespace App\Models;
use CodeIgniter\Model;

class Model_customer extends Model
{
    protected $table      = 'customer';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;
    protected $useAutoIncrement = true;

    protected $allowedFields = [ 'kode', 'name', 'gender', 'hp', 'kode_provinsi', 'kode_kota', 'alamat', 'created_by', 'id_service' ];

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
        $sql = "ALTER TABLE customer AUTO_INCREMENT=1";
        $this->db->query($sql);
    }
    
    public function getAll() {
        $this->select('customer.*, lp.nama as nama_provinsi. lk.nama as nama_kota');
        $this->join('list_provinsi lp', 'lp.kode = customer.kode_provinsi', 'left');
        $this->join('list_kota lk', 'lk.kode = customer.kode_kota', 'left');
        
        return $this->findAll();
    }
    
    public function getAllRaw() {
        $sql = "
            SELECT 
                c.*,
                lp.nama as nama_provinsi,
                lk.nama as nama_kota
            FROM customer c
            JOIN list_provinsi lp ON c.kode_provinsi = lp.kode
            JOIN list_kota lk ON c.kode_kota = lk.kode
            WHERE c.deleted_at IS NULL
            ORDER BY c.created_at DESC;
        ";
        
        $query = $this->db->query($sql);
        return $query->getResult();
    }
    
    public function getMainDatatable($filters = [])
    {
        $builder = $this->db->table('customer c');
        $builder->select('c.*, lp.nama as nama_provinsi, lk.nama as nama_kota');
        $builder->join('list_provinsi lp', 'c.kode_provinsi = lp.kode');
        $builder->join('list_kota lk', 'c.kode_kota = lk.kode');
        $builder->where('c.deleted_at', null);
    
        if (!empty($filters->filter_nama)) {
            $builder->where('c.name', $filters->filter_nama);
        }
        if (!empty($filters->filter_provinsi)) {
            $builder->where('c.kode_provinsi', $filters->filter_provinsi);
        }
        if (!empty($filters->filter_kota)) {
            $builder->where('c.kode_kota', $filters->filter_kota);
        }
        
        $builder->orderBy('c.created_at', 'DESC');
        
        return $builder->get()->getResult();
    }


}