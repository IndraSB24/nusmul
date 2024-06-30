<?php

namespace App\Models;
use CodeIgniter\Model;

class Model_travel_booking extends Model
{
    protected $table      = 'travel_booking';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;
    protected $useAutoIncrement = true;

    protected $allowedFields = [ 'kode', 'id_paket_service', 'id_service', 'id_customer', 'id_armada', 'harga', 'diskon', 'diskon_deskripsi', 'total_harga', 'created_by' ];

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
        $sql = "ALTER TABLE ".$this->table." AUTO_INCREMENT=1";
        $this->db->query($sql);
    }
    
    public function getAllRaw() {
        $sql = "
            SELECT 
                tb.*,
                s.nama_service as nama_service,
                ps.nama as nama_paket_service,
                c.name as nama_customer,
                a.kode as kode_armada
            FROM ".$this->table." tb
            LEFT JOIN paket_service ps ON tb.id_paket_service = ps.id
            LEFT JOIN nusmul_service s ON tb.id_service = s.id
            LEFT JOIN customer c ON tb.id_customer = c.id
            LEFT JOIN armada a ON tb.id_armada = a.id
            WHERE tb.deleted_at IS NULL
            ORDER BY tb.created_at DESC;
        ";
        
        $query = $this->db->query($sql);
        return $query->getResult();
    }
    
    public function getMainDatatable($filters = [])
    {
        $builder = $this->db->table('travel_booking tb');
        $builder->select('
            tb.*,
            s.nama_service as nama_service,
            ps.nama as nama_paket_service,
            c.name as nama_customer,
            a.kode as kode_armada
        ');
        $builder->join('paket_service ps', 'tb.id_paket_service = ps.id', 'LEFT');
        $builder->join('nusmul_service s', 'tb.id_service = s.id', 'LEFT');
        $builder->join('customer c', 'tb.id_customer = c.id', 'LEFT');
        $builder->join('armada a', 'tb.id_armada = a.id', 'LEFT');
        $builder->where('tb.deleted_at', null);
    
        if (!empty($filters->filter_service)) {
            $builder->where('tb.id_service', $filters->filter_service);
        }
        
        $builder->orderBy('tb.created_at', 'DESC');
        return $builder->get()->getResult();
    }


}