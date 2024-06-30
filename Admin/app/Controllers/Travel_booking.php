<?php

namespace App\Controllers;
use App\Models\Model_travel_booking;
use App\Models\Model_nusmul_service;
use App\Models\Model_paket_service;
use App\Models\Model_customer;
use App\Models\Model_armada;

class travel_booking extends BaseController
{
    
    protected $model_travel_booking, $model_nusmul_service, $model_paket_service, $model_customer;
 
    function __construct(){
        $this->model_travel_booking = new Model_travel_booking();
        $this->model_nusmul_service = new Model_nusmul_service();
        $this->model_paket_service = new Model_paket_service();
        $this->model_customer = new Model_customer();
        $this->model_armada = new Model_armada();
        helper('session');
        helper('formatting');
    }
    
	// home ================================================================================================================================================================
	public function index()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Paket Service']),
			'page_title' => view('partials/page-title', [
			    'title' => 'Paket Service', 
			    'li_1' => '', 
			    'li_2' => ''
		    ]),
			'data_travel_booking' => $this->model_travel_booking->getAllRaw(),
			'data_nusmul_service' => $this->model_nusmul_service->findAll(),
			'data_paket_service' => $this->model_paket_service->findAll(),
			'data_customer' => $this->model_customer->findAll(),
			'data_armada' => $this->model_armada->findAll()
		];
		
		return view('travel/booking', $data);
	}
	
	// Show ================================================================================================================================================================	
	public function show(request $param){
        switch($param->kode){
            case 'document_timeline':
                $title = $param;
                $data = [
        			'title_meta' => view('partials/title-meta', ['title' => $param->title.' Timeline']),
        			'page_title' => view('partials/page-title', ['title' => 'Timeline', 'pagetitle' => $param->title]),
        			'passed_data' => $this->doc_engineering_model->find()
        		];
        		return view('timeline-document', $data);
            break;
            case 'actual_ifr_file':
                $data = [
                    'actual_ifr_file'   => $this->request->getPost('file'),
                    'actual_ifr'        => date_now(),
                ];
                $this->doc_engineering_model->update($id_update, $data);
            break;
            case 'actual_ifa_file':
                $data = [
                    'actual_ifa_file'   => $this->request->getPost('file'),
                    'actual_ifa'        => date_now(),
                ];
                $this->doc_engineering_model->update($id_update, $data);
            break;
            case 'actual_ifc_file':
                $data = [
                    'actual_ifc_file'   => $this->request->getPost('file'),
                    'actual_ifc'        => date_now(),
                ];
                $this->doc_engineering_model->update($id_update, $data);
            break;
        }
    }
	
    // add ================================================================================================================================================================
    public function add($kode = null)
    {
        switch ($kode) {
            case 'travel_booking':
                $data = [
                    'nama'          => $this->request->getPost('nama'), 
                    'deskripsi'     => $this->request->getPost('deskripsi'),
                    'harga'         => $this->request->getPost('harga'),
                    'id_service'    => activeServiceId(),
                    'created_by'    => activeId()
                ];
                
                $this->model_travel_booking->reset_increment();
                $insertData = $this->model_travel_booking->save($data);
                
                if ($insertData) {
                    $response = [
                        'success' => true,
                        'message' => 'Customer baru berhasil disimpan.'
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'Gagal menyimpan customer.'
                    ];
                }
                return $this->response->setJSON($response);
            break;
        }
    }
    
    // edit ================================================================================================================================================================
    public function edit($kode = null)
    {
        switch ($kode) {
            case 'travel_booking':
                $data = [
                    'id' => $this->request->getPost('id_edit'),
                    'nama' => $this->request->getPost('nama_edit'),
                    'deskripsi' => $this->request->getPost('deskripsi_edit'),
                    'harga' => $this->request->getPost('harga_edit'),
                ];
                
                $this->model_travel_booking->reset_increment();
                $insertData = $this->model_travel_booking->save($data);

                
                if ($insertData) {
                    $response = ['success' => true];
                } else {
                    $response = ['success' => false];
                }
                return $this->response->setJSON($response);
            break;
        }
    }
    
    // delete ==============================================================================================================================================================
    public function delete($kode = null)
    {
        switch ($kode) {
            case 'travel_booking':
                $deleteData = $this->model_travel_booking->delete($this->request->getPost('id'));

                if ($deleteData) {
                    $response = ['success' => true];
                } else {
                    $response = ['success' => false];
                }
                return $this->response->setJSON($response);
            break;
        }
    }
    
    // ajax get ==========================================================================================================================================================
    public function ajax_get($kode="")
    {
        switch ($kode) {
            case 'main_table_data':
                $filters = $this->request->getJSON();
                $returnedData = $this->model_travel_booking->getMainDatatable($filters);
            
                function generateTableRow($data, $number) {
                    return "
                        <tr>
                            <td class='text-center'>$number</td>
                            <td class='text-center'>$data->nama</td>
                            <td class='text-center'>$data->deskripsi</td>
                            
                            <td class='accounting-format'>
                                <span> Rp. </span>
                                ".thousand_separator($data->harga)."
                            </td>
                            <td class='text-center'>
                                <button class='btn btn-sm btn-info' id='btn_edit'
                                    data-id='$data->id'
                                    data-nama='$data->nama'
                                    data-deskripsi='$data->deskripsi'
                                    data-harga='$data->harga'
                                >
                                    <i class='bx bx-edit'></i> 
                                </button>
                                <button class='btn btn-sm btn-danger' id='btn_delete' 
                                    data-id='$data->id'
                                    data-nama='$data->nama'
                                    data-path='".base_url('travel_booking/delete/travel_booking')."'
                                > 
                                    <i class='bx bx-trash'></i>
                                </button>
                            </td>
                        </tr>
                    ";
                }
            
                $tableRows = '';
                $counter = 1;
                foreach ($returnedData as $data) {
                    $tableRows .= generateTableRow($data, $counter);
                    $counter++;
                }
            
                return $this->response->setJSON(['html' => $tableRows]);
            break;


            default:
                return $this->response->setJSON(array());
        }
    }

}
