<?php

namespace App\Models;
use CodeIgniter\Model;

class Model_bus_pengeluaran extends Model
{
    protected $table      = 'bus_pengeluaran';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'kode', 'id_customer', 'id_armada', 'description', 'for_date', 'quantity', 'unit', 'amount_per_unit',
        'total_amount', 'created_by'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function countNoFiltered()
    {
        $this->select('
            *
        ')
        ->where('deleted_at', NULL);

        return $this->countAllResults();
    }

    // get
    public function get_datatable_main()
    {
        $request = service('request');

        // set searchable and orderable
        $column_searchable = [
            'bus_pengeluaran.for_date'
        ];
        $column_orderable = [
            'bus_pengeluaran.id', 'bus_pengeluaran.for_date'
        ];

        $this->select('
            bus_pengeluaran.*,
            c.name as customer_name,
            a.kode as armada_code
        ')
        ->join('customer c', 'c.id=bus_pengeluaran.id_customer', 'LEFT')
        ->join('armada a', 'a.id=bus_pengeluaran.id_armada', 'LEFT')
        ->where('bus_pengeluaran.deleted_at', NULL);

        if ($request->getPost('search')['value']) {
            $searchValue = $request->getPost('search')['value'];
            $i = 0;
            foreach ($column_searchable as $item) {
                if ($i === 0) {
                    $this->groupStart(); 
                    $this->like($item, $searchValue);
                } else {
                    $this->orLike($item, $searchValue);
                }
                if (count($column_searchable) - 1 == $i) {
                    $this->groupEnd(); 
                }
                $i++;
            }
        }

        if ($request->getPost('order')) {
            $orderColumn = $column_orderable[$request->getPost('order')[0]['column']];
            $orderDirection = $request->getPost('order')[0]['dir'];
            $this->orderBy($orderColumn, $orderDirection);
        } else {
            $this->orderBy('id', 'ASC');
        }

        if ($request->getPost('length') != -1) {
            $this->limit($request->getPost('length'), $request->getPost('start'));
        }

        // result set
        $result['return_data'] = $this->get()->getResult();
        $result['count_filtered'] = $this->countAllResults();
        $result['count_all'] = $this->countAllResults();

        return $result;
    }

    // get by id
    public function get_by_id($id){
        $this->select('
            *
        ')
        ->where('id', $id);
        
        return $this->get()->getResult();
    }

    // insert with db transaction
    public function insertWithReturnId($data) {
        $this->db->transBegin();

        $this->db->table($this->table)->insert($data);

        $transactionId = $this->db->insertID();

        $this->db->transCommit();

        return $transactionId;
    }

}
