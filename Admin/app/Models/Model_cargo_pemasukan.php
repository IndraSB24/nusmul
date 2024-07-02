<?php

namespace App\Models;
use CodeIgniter\Model;

class Model_cargo_pemasukan extends Model
{
    protected $table      = 'cargo_pemasukan';
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
            'cargo_pemasukan.for_date'
        ];
        $column_orderable = [
            'cargo_pemasukan.id', 'cargo_pemasukan.for_date'
        ];

        $this->select('
            cargo_pemasukan.*,
            c.name as customer_name,
            a.kode as armada_code
        ')
        ->join('customer c', 'c.id=cargo_pemasukan.id_customer', 'LEFT')
        ->join('armada a', 'a.id=cargo_pemasukan.id_armada', 'LEFT')
        ->where('cargo_pemasukan.deleted_at', NULL);

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

    // count all detail
    public function countAllDetail($id_entitas, $for_date)
    {
        $this->select('
            *
        ')
        ->where('deleted_at', NULL)
        ->where('id_entitas', $id_entitas)
        ->where('for_date', $for_date);

        return $this->countAllResults();
    }

    // get cash drawer detail
    public function get_datatable_list_cashdrawer_detail($id_entitas, $for_date)
    {
        $request = service('request');

        // set searchable and orderable
        $column_searchable = [
            'cash_drawer_detail.for_date'
        ];
        $column_orderable = [
            'cash_drawer_detail.id', 'cash_drawer_detail.for_date'
        ];

        $this->select('
            cash_drawer_detail.*,
            k.nama as nama_karyawan,
            u.username as username_user
        ')
        ->join('user u', 'u.id=cash_drawer_detail.created_by', 'LEFT')
        ->join('karyawan k', 'k.id_user=u.id', 'LEFT')
        ->where('cash_drawer_detail.deleted_at', NULL)
        ->where('cash_drawer_detail.id_entitas', $id_entitas)
        ->where('cash_drawer_detail.for_date', $for_date);

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
        $result['count_all'] = $this->countAllDetail($id_entitas, $for_date);

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

    // laporan penjualan
    public function get_datatable_laporan_pengeluaran()
    {
        $request = service('request');

        // set searchable and orderable
        $column_searchable = [
            'cash_drawer_detail.for_date'
        ];
        $column_orderable = [
            'cash_drawer_detail.id', 'cash_drawer_detail.for_date'
        ];

        // filter
        if ($request->getPost('filterDateFrom')) {
            $this->where('cash_drawer_detail.for_date >=', $request->getPost('filterDateFrom').' 00:00:00');
        }

        if ($request->getPost('filterDateUntil')) {
            $this->where('cash_drawer_detail.for_date <=', $request->getPost('filterDateUntil').' 23:59:59');
        }

        $this->select('
            cash_drawer_detail.*,
            e.nama as nama_entitas,
            SUM(IF(cash_drawer_detail.jenis = "debit", nominal, 0)) as total_debit,
            SUM(IF(cash_drawer_detail.jenis = "credit", nominal, 0)) as total_credit,
            COUNT(cash_drawer_detail.id) as kegiatan_total

        ')
        ->join('entitas e', 'e.id=cash_drawer_detail.id_entitas', 'LEFT')
        ->where('cash_drawer_detail.deleted_at', NULL)
        ->groupBy('cash_drawer_detail.for_date')
        ->groupBy('cash_drawer_detail.id_entitas');

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

        // count filtered
        $countFiltered = clone $this;
        $countFiltered->limit($request->getPost('length'), $request->getPost('start'));
        $countFilteredResults = $countFiltered->countAllResults(false);

        // result set
        $result['return_data'] = $this->get()->getResult();
        $result['count_filtered'] = $countFilteredResults;
        $result['count_all'] = $this->countNoFiltered();

        return $result;
    }

    // get by id
    public function get_total_cashdrawer(){
        $request = service('request');
        $today = date('Y-m-d');

        if (!$request->getPost('filterDateFrom') || !$request->getPost('filterDateUntil')) {
            $this->where('for_date =', $today);
        }

        // filter
        if ($request->getPost('filterDateFrom')) {
            $this->where('for_date >=', $request->getPost('filterDateFrom'));
        }

        if ($request->getPost('filterDateUntil')) {
            $this->where('for_date <=', $request->getPost('filterDateUntil'));
        }

        $this->select('
            SUM(CASE WHEN jenis = "credit" THEN nominal ELSE 0 END) as total_credit,
            SUM(CASE WHEN jenis = "debit" THEN nominal ELSE 0 END) as total_debit
        ')
        ->where('deleted_at', NULL);
        
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
