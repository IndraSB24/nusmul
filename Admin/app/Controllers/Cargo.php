<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\Model_cargo_pemasukan;
use App\Models\Model_cargo_pengeluaran;
use App\Models\Model_customer;
use App\Models\Model_provinsi;
use App\Models\Model_kota;

class Cargo extends Controller
{
    protected $Model_cargo_pemasukan, $Model_cargo_pengeluaran;
 
    function __construct(){
        $this->Model_cargo_pemasukan = new Model_cargo_pemasukan();
        $this->Model_cargo_pengeluaran = new Model_cargo_pengeluaran();
        $this->Model_customer = new Model_customer();
        $this->Model_provinsi = new Model_provinsi();
        $this->Model_kota = new Model_kota();
        // helper(['session_helper', 'formatting_helper']);
    }

    public function index(){
        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Cargo Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Cargo', 'pagetitle' => 'Dashboard'])
		];
        return view('cargo/page_dashboard', $data);
    }

    // show pemasukan
    public function show_pemasukan(){
        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Cargo Pemasukan']),
			'page_title' => view('partials/page-title', [
			    'title' => 'Cargo', 
			    'li_1' => 'Pemasukan', 
			    'li_2' => ''
		    ]),
            'data_customer' => $this->model_customer->getAllRaw(),
			'data_provinsi' => $this->model_provinsi->findAll(),
			'data_kota' => $this->model_kota->getAllRaw()
		];
        return view('cargo/page_pemasukan', $data);
    }

    // show pengeluaran
    public function show_pengeluaran(){
        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Cargo Pengeluaran']),
			'page_title' => view('partials/page-title', ['title' => 'Cargo', 'pagetitle' => 'Pengeluaran'])
		];
        return view('cargo/page_pengeluaran', $data);
    }

    // ajax get list cashdrawer
    public function ajax_get_pemasukan(){
        $returnedData = $this->Model_cargo_pemasukan->get_datatable_main();

        $data = [];
        foreach ($returnedData['return_data'] as $itung => $baris) {
            $aksi = "
                <a class='btn btn-sm btn-info' id='btn_edit'
                    data-id='$baris->id'
                >
                    <i class='far fa-edit'></i>
                </a>
                <a class='btn btn-sm btn-danger' id='btn_delete' 
                    data-id='$baris->id'
                > 
                    <i class='fas fa-trash-alt'></i>
                </a>
            ";

            $data[] = [
                '<span class="text-center">' . ($itung + 1) . '</span>',
                '<span class="text-center">' . $baris->kode . '</span>',
                '<span class="text-center">' . $baris->for_date . '</span>',
                '<span class="text-center">' . $baris->description . '</span>',
                '<span class="text-center">' . $baris->quantity . '</span>',
                '<span class="text-center">' . $baris->total_amount . '</span>',
                '<span class="text-center">' . $aksi . '</span>'
            ];
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $returnedData['count_filtered'],
            "recordsFiltered" => $returnedData['count_all'],
            "data" => $data,
        ];

        // Output to JSON format
        return $this->response->setJSON($output);
    }

    // ajax get list cashdrawer detail
    public function ajax_get_list_cashdrawer_detail($id_entitas, $for_date){
        $returnedData = $this->Model_cash_drawer_detail->get_datatable_list_cashdrawer_detail($id_entitas, $for_date);

        $data = [];
        foreach ($returnedData['return_data'] as $itung => $baris) {
            $nominal_credit = $baris->jenis=='credit' ? $baris->nominal : '-';
            $nominal_debit = $baris->jenis=='debit' ? $baris->nominal : '-';

            $nama_user = $baris->nama_karyawan ?: ($baris->username_user ?: '-');

            $data[] = [
                '<span class="text-center">' . ($itung + 1) . '</span>',
                '<span class="text-center">' . $baris->for_date . '</span>',
                '<span class="text-center">' . $baris->deskripsi . '</span>',
                '<span class="text-center">' . $nominal_debit . '</span>',
                '<span class="text-center">' . $nominal_credit . '</span>',
                '<span class="text-center">' . $nama_user . '</span>'
            ];
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $returnedData['count_filtered'],
            "recordsFiltered" => $returnedData['count_all'],
            "data" => $data,
        ];

        // Output to JSON format
        return $this->response->setJSON($output);
    }

    // add cashdrawer detail =================================================================================
    public function add_cashdrawer_detail(){
        $cashDrawerDetail = $this->request->getPost('cashdrawer_detail');
        $for_date = $this->request->getPost('for_date');
        
        if (!empty($cashDrawerDetail) && is_array($cashDrawerDetail)) {
            foreach ($cashDrawerDetail as $value) {
                $payload = [
                    'for_date' =>  $for_date,
                    'deskripsi' => $value['deskripsi'],
                    'id_entitas' => 1
                ];

                if($value['debit'] != 'NaN'){
                    $payload['jenis'] = 'debit';
                    $payload['nominal'] = $value['debit'];
                }

                if($value['credit'] != 'NaN'){
                    $payload['jenis'] = 'credit';
                    $payload['nominal'] = $value['credit'];
                }

                $add_detail = $this->Model_cash_drawer_detail->save($payload);

                if($add_detail){
                    $isDone = true;
                }else{
                    $isDone = false;
                }
            }
        }

        if ($isDone) {
            $response = [
                'success' => true
            ];
        } else {
            $response = [
                'success' => false
            ];
        }
        return $this->response->setJSON($response);
    }

}
