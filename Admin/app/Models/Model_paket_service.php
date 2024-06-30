<?php

namespace App\Models;
use CodeIgniter\Model;

class Model_paket_service extends Model
{
    protected $table      = 'paket_service';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;
    protected $useAutoIncrement = true;

    protected $allowedFields = [ 'nama', 'deskripsi', 'id_service', 'harga', 'created_by' ];

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
        $sql = "ALTER TABLE paket_service AUTO_INCREMENT=1";
        $this->db->query($sql);
    }
    
    public function getAllRaw() {
        $sql = "
            SELECT 
                ps.*,
                s.nama_service as nama_service
            FROM paket_service ps
            LEFT JOIN nusmul_service s ON ps.id_service = s.id
            WHERE ps.deleted_at IS NULL
            ORDER BY ps.created_at DESC;
        ";
        
        $query = $this->db->query($sql);
        return $query->getResult();
    }
    
    public function getMainDatatable($filters = [])
    {
        $builder = $this->db->table('paket_service ps');
        $builder->select('ps.*, s.nama_service as nama_service');
        $builder->join('nusmul_service s', 'ps.id_service = s.id', 'LEFT');
        $builder->where('ps.deleted_at', null);
    
        if (!empty($filters->filter_service)) {
            $builder->where('ps.id_service', $filters->filter_service);
        }
        
        $builder->orderBy('ps.created_at', 'DESC');
        
        return $builder->get()->getResult();
    }


}