<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\Model_bus_pemasukan;
use App\Models\Model_bus_pengeluaran;
use App\Models\Model_customer;
use App\Models\Model_provinsi;
use App\Models\Model_kota;

class Bus extends Controller
{
    protected $Model_bus_pemasukan, $Model_bus_pengeluaran;
 
    function __construct(){
        $this->Model_bus_pemasukan = new Model_bus_pemasukan();
        $this->Model_bus_pengeluaran = new Model_bus_pengeluaran();
        $this->Model_customer = new Model_customer();
        $this->Model_provinsi = new Model_provinsi();
        $this->Model_kota = new Model_kota();
        helper(['session_helper', 'formatting_helper']);
    }

    public function index(){
        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Bus Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Bus', 'pagetitle' => 'Dashboard'])
		];
        return view('bus/page_dashboard', $data);
    }

    // show pemasukan
    public function show_pemasukan(){
        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Bus Pemasukan']),
			'page_title' => view('partials/page-title', [
			    'title' => 'Bus', 
			    'li_1' => 'Pemasukan', 
			    'li_2' => ''
		    ]),
            'data_customer' => $this->Model_customer->getAllRaw(),
			'data_provinsi' => $this->Model_provinsi->findAll(),
			'data_kota' => $this->Model_kota->getAllRaw()
		];
        return view('bus/page_pemasukan', $data);
    }

    // show pengeluaran
    public function show_pengeluaran(){
        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Bus Pengeluaran']),
			'page_title' => view('partials/page-title', [
			    'title' => 'Bus', 
			    'li_1' => 'Pengeluaran', 
			    'li_2' => ''
		    ]),
            'data_customer' => $this->Model_customer->getAllRaw(),
			'data_provinsi' => $this->Model_provinsi->findAll(),
			'data_kota' => $this->Model_kota->getAllRaw()
		];
        return view('bus/page_pengeluaran', $data);
    }

    // ajax get list cashdrawer
    public function ajax_get_pemasukan(){
        $returnedData = $this->Model_bus_pemasukan->get_datatable_main();

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
                    data-kode='$baris->kode'
                > 
                    <i class='fas fa-trash-alt'></i>
                </a>
            ";

            $data[] = [
                '<span class="text-center">' . ($itung + 1) . '</span>',
                '<span class="text-center">' . $baris->kode . '</span>',
                '<span class="text-center">' . indoDate($baris->for_date) . '</span>',
                '<span class="text-center">' . $baris->description . '</span>',
                '<span class="text-center">' . thousand_separator($baris->quantity) . '</span>',
                '<span class="text-center">Rp. ' . thousand_separator($baris->total_amount) . '</span>',
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

    // add pemasukan 
    public function add_pemasukan(){
        $data = array_intersect_key(
            $this->request->getPost(),
            array_flip([
                'description', 'quantity', 'unit', 'amount_per_unit',
            ])
        );
        $data['for_date'] = dbDate($this->request->getPost('for_date'));
        $data['created_by'] = activeId();

        $insert = $this->Model_bus_pemasukan->insertWithReturnId($data);

        if($insert){
            // inject invoice code
            $item_code_update = [
                'kode' => generate_general_code('T-IN', $insert, 9)
            ];
            $updateResult = $this->Model_bus_pemasukan->update($insert, $item_code_update);
        }
        
        if ($insert) {
            $response = ['success' => true];
        } else {
            $response = ['success' => false];
        }
        return $this->response->setJSON($response);
    }

    // edit pemasukan 
    public function edit_pemasukan(){
        $data = array_intersect_key(
            $this->request->getPost(),
            array_flip([
                'description', 'quantity', 'unit', 'amount_per_unit',
            ])
        );
        $data['for_date'] = dbDate($this->request->getPost('for_date'));
        $data['id'] = $this->request->getPost('id_edit');

        $update = $this->Model_bus_pemasukan->save($data);
        
        if ($update) {
            $response = ['success' => true];
        } else {
            $response = ['success' => false];
        }
        return $this->response->setJSON($response);
    }

    // ajax get data edit
    public function ajax_get_pemasukan_data(){
        $id = $this->request->getPost('id');

        $fetch_edit_data = $this->Model_bus_pemasukan->get_by_id($id);

        return $this->response->setJSON($fetch_edit_data[0]);
    }
    
    // delete
    public function delete_pemasukan()
    {
        $deleteData = $this->Model_bus_pemasukan->delete($this->request->getPost('id'));

        if ($deleteData) {
            $response = ['success' => true];
        } else {
            $response = ['success' => false];
        }
        return $this->response->setJSON($response);
    }

    // ajax get list cashdrawer
    public function ajax_get_pengeluaran(){
        $returnedData = $this->Model_bus_pengeluaran->get_datatable_main();

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
                    data-kode='$baris->kode'
                > 
                    <i class='fas fa-trash-alt'></i>
                </a>
            ";

            $data[] = [
                '<span class="text-center">' . ($itung + 1) . '</span>',
                '<span class="text-center">' . $baris->kode . '</span>',
                '<span class="text-center">' . indoDate($baris->for_date) . '</span>',
                '<span class="text-center">' . $baris->description . '</span>',
                '<span class="text-center">' . thousand_separator($baris->quantity) . '</span>',
                '<span class="text-center">Rp. ' . thousand_separator($baris->total_amount) . '</span>',
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

    // add pengeluaran 
    public function add_pengeluaran(){
        $data = array_intersect_key(
            $this->request->getPost(),
            array_flip([
                'description', 'quantity', 'unit', 'amount_per_unit',
            ])
        );
        $data['for_date'] = dbDate($this->request->getPost('for_date'));
        $data['created_by'] = activeId();

        $insert = $this->Model_bus_pengeluaran->insertWithReturnId($data);

        if($insert){
            // inject invoice code
            $item_code_update = [
                'kode' => generate_general_code('T-OUT', $insert, 9)
            ];
            $updateResult = $this->Model_bus_pengeluaran->update($insert, $item_code_update);
        }
        
        if ($insert) {
            $response = ['success' => true];
        } else {
            $response = ['success' => false];
        }
        return $this->response->setJSON($response);
    }

    // edit pengeluaran 
    public function edit_pengeluaran(){
        $data = array_intersect_key(
            $this->request->getPost(),
            array_flip([
                'description', 'quantity', 'unit', 'amount_per_unit',
            ])
        );
        $data['for_date'] = dbDate($this->request->getPost('for_date'));
        $data['id'] = $this->request->getPost('id_edit');

        $update = $this->Model_bus_pengeluaran->save($data);
        
        if ($update) {
            $response = ['success' => true];
        } else {
            $response = ['success' => false];
        }
        return $this->response->setJSON($response);
    }

    // ajax get data edit
    public function ajax_get_pengeluaran_data(){
        $id = $this->request->getPost('id');

        $fetch_edit_data = $this->Model_bus_pengeluaran->get_by_id($id);

        return $this->response->setJSON($fetch_edit_data[0]);
    }
    
    // delete
    public function delete_pengeluaran()
    {
        $deleteData = $this->Model_bus_pengeluaran->delete($this->request->getPost('id'));

        if ($deleteData) {
            $response = ['success' => true];
        } else {
            $response = ['success' => false];
        }
        return $this->response->setJSON($response);
    }

}
