<?php

namespace App\Models;
use CodeIgniter\Model;

class Model_karyawan extends Model
{
    protected $table      = 'karyawan';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;
    protected $useAutoIncrement = true;

    protected $allowedFields = [ 'nama', 'hp', 'alamat', 'id_posisi', 'id_service', 'created_by' ];

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
        $sql = "ALTER TABLE karyawan AUTO_INCREMENT=1";
        $this->db->query($sql);
    }
    
    public function getAllRaw() {
        $sql = "
            SELECT 
                k.*,
                s.nama_service as nama_service,
                lp.nama as nama_posisi
            FROM karyawan k
            LEFT JOIN nusmul_service s ON k.id_service = s.id
            LEFT JOIN list_posisi lp ON k.id_posisi = lp.id
            WHERE k.deleted_at IS NULL
            ORDER BY k.created_at DESC;
        ";
        
        $query = $this->db->query($sql);
        return $query->getResult();
    }
    
    public function getMainDatatable($filters = [])
    {
        $builder = $this->db->table('karyawan k');
        $builder->select('k.*, s.nama_service as nama_service, lp.nama as nama_posisi');
        $builder->join('nusmul_service s', 'k.id_service = s.id', 'LEFT');
        $builder->join('list_posisi lp', 'k.id_posisi = lp.id', 'LEFT');
        $builder->where('k.deleted_at', null);
    
        if (!empty($filters->filter_service)) {
            $builder->where('k.id_service', $filters->filter_service);
        }
        
        $builder->orderBy('k.created_at', 'DESC');
        
        return $builder->get()->getResult();
    }


}