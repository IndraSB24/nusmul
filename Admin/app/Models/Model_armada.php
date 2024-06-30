<?php

namespace App\Models;
use CodeIgniter\Model;

class Model_armada extends Model
{
    protected $table      = 'armada';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;
    protected $useAutoIncrement = true;

    protected $allowedFields = [ 'kode', 'type', 'brand', 'unit_name', 'plat_number', 'kapasitas_kursi', 'kapasitas_beban', 'id_service', 'created_by' ];

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
        $sql = "ALTER TABLE armada AUTO_INCREMENT=1";
        $this->db->query($sql);
    }
    
    public function getAll() {
        $this->select('customer.*, lp.nama as nama_provinsi, lk.nama as nama_kota');
        $this->join('list_provinsi lp', 'lp.kode = customer.kode_provinsi', 'left');
        $this->join('list_kota lk', 'lk.kode = customer.kode_kota', 'left');
        
        return $this->findAll();
    }
    
    public function getAllRaw() {
        $sql = "
            SELECT 
                a.*,
                s.nama_service as nama_service
            FROM armada a
            LEFT JOIN nusmul_service s ON a.id_service = s.id
            WHERE a.deleted_at IS NULL
            ORDER BY a.created_at DESC;
        ";
        
        $query = $this->db->query($sql);
        return $query->getResult();
    }
    
    public function getMainDatatable($filters = [])
    {
        $builder = $this->db->table('armada a');
        $builder->select('a.*, s.nama_service as nama_service');
        $builder->join('nusmul_service s', 'a.id_service = s.id', 'LEFT');
        $builder->where('a.deleted_at', null);
    
        if (!empty($filters->filter_service)) {
            $builder->where('a.id_service', $filters->filter_service);
        }
        
        $builder->orderBy('a.created_at', 'DESC');
        
        return $builder->get()->getResult();
    }


}