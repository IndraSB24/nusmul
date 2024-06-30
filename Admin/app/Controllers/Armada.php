<?php

namespace App\Controllers;
use App\Models\Model_armada;

class Armada extends BaseController
{
    
    protected $model_user;
 
    function __construct(){
        $this->model_armada = new Model_armada();
        helper('session');
        helper('formatting');
        helper('armada');
    }
    
	// home ================================================================================================================================================================
	public function index()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Data Armada']),
			'page_title' => view('partials/page-title', [
			    'title' => 'Data Armada', 
			    'li_1' => 'Travel', 
			    'li_2' => 'Data Admada'
		    ]),
			'data_armada' => $this->model_armada->getAllRaw(),
			'list_tipe_kendaraan' => list_tipe_kendaraan(),
			'list_brand_kendaraan' => list_brand_kendaraan()
		];
		
		return view('travel/data_master_list_armada/index', $data);
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
            case 'armada':
                $data = [
                    'kode'              => $this->request->getPost('kode'),
                    'type'              => $this->request->getPost('type'), 
                    'brand'             => $this->request->getPost('brand'),
                    'unit_name'         => $this->request->getPost('unit_name'),
                    'plat_number'       => $this->request->getPost('plat_number'),
                    'kapasitas_kursi'   => $this->request->getPost('kapasitas_kursi'),
                    'kapasitas_beban'   => $this->request->getPost('kapasitas_beban'),
                    'id_service'        => activeServiceId(),
                    'created_by'        => activeId()
                ];
                $this->model_armada->reset_increment();
                $insertData = $this->model_armada->save($data);
                
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
            case 'armada':
                $data = [
                    'id'                => $this->request->getPost('id_edit'),
                    'kode'              => $this->request->getPost('kode_edit'),
                    'unit_name'         => $this->request->getPost('unit_name_edit'),
                    'plat_number'       => $this->request->getPost('plat_number_edit'),
                    'kapasitas_kursi'   => $this->request->getPost('kapasitas_kursi_edit'),
                    'kapasitas_beban'   => $this->request->getPost('kapasitas_beban_edit'),
                ];
                
                $fieldsToUpdate = ['type', 'brand'];
                foreach ($fieldsToUpdate as $field) {
                    if ($this->request->getPost("{$field}_edit") != "") {
                        $data[$field] = $this->request->getPost("{$field}_edit");
                    }
                }

                
                $this->model_armada->reset_increment();
                $insertData = $this->model_armada->save($data);

                
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
            case 'armada':
                $deleteData = $this->model_armada->delete($this->request->getPost('id'));

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
                $returnedData = $this->model_armada->getMainDatatable($filters);
            
                function generateTableRow($data, $number) {
                    return "
                        <tr>
                            <td class='text-center'>$number</td>
                            <td class='text-center'>$data->kode</td>
                            <td class='text-center'>$data->type</td>
                            <td class='text-center'>$data->brand</td>
                            <td class='text-center'>$data->unit_name</td>
                            <td class='text-center'>$data->plat_number</td>
                            <td class='text-center'>$data->kapasitas_kursi</td>
                            <td class='text-center'>$data->kapasitas_beban</td>
                            <td class='text-center'>
                                <button class='btn btn-sm btn-info' id='btn_edit'
                                    data-id='$data->id'
                                    data-kode='$data->kode'
                                    data-type='$data->type'
                                    data-brand='$data->brand'
                                    data-unit_name='$data->unit_name'
                                    data-plat_number='$data->plat_number'
                                    data-kapasitas_kursi='$data->kapasitas_kursi'
                                    data-kapasitas_beban='$data->kapasitas_beban'
                                >
                                    <i class='bx bx-edit'></i> 
                                </button>
                                <button class='btn btn-sm btn-danger' id='btn_delete' 
                                    data-id='$data->id'
                                    data-kode='$data->kode'
                                    data-path='".base_url('armada/delete/armada')."'
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
