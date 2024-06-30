<?php

namespace App\Models;
use CodeIgniter\Model;

class Model_kategori_transaksi_finance extends Model
{
    protected $table      = 'kategori_transaksi_finance';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;
    protected $useAutoIncrement = true;

    protected $allowedFields = [ 'tipe', 'nama', 'deskripsi', 'created_by' ];

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
        $sql = "ALTER TABLE kategori_transaksi_finance AUTO_INCREMENT=1";
        $this->db->query($sql);
    }
    
    public function getAll() {
        $this->select('customer.*, lp.nama as nama_provinsi. lk.nama as nama_kota');
        $this->join('list_provinsi lp', 'lp.kode = customer.kode_provinsi', 'left');
        $this->join('list_kota lk', 'lk.kode = customer.kode_kota', 'left');
        
        return $this->findAll();
    }
    
    public function getAllRaw($kode) {
        $sql = "
            SELECT 
                *
            FROM kategori_transaksi_finance
            WHERE deleted_at IS NULL AND tipe='".$kode."'
            ORDER BY nama DESC;
        ";
        
        $query = $this->db->query($sql);
        
        
        return $query->getResult();
    }
    
    public function getMainDatatable($kode)
    {
        $builder = $this->db->table('kategori_transaksi_finance');
        $builder->select('*');
        $builder->where('deleted_at', null);
        $builder->where('tipe', $kode);
        $builder->orderBy('nama', 'DESC');
        
        return $builder->get()->getResult();
    }


}