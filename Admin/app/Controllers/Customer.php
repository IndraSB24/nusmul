<?php

namespace App\Controllers;
use App\Models\Model_user;
use App\Models\Model_customer;
use App\Models\Model_provinsi;
use App\Models\Model_kota;

class Customer extends BaseController
{
    
    protected $model_user;
 
    function __construct(){
        $this->model_user = new Model_user();
        $this->model_customer = new Model_customer();
        $this->model_provinsi = new Model_provinsi();
        $this->model_kota = new Model_kota();
        helper('session');
        helper('formatting');
    }
    
	// home ================================================================================================================================================================
	public function index()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Data Customer']),
			'page_title' => view('partials/page-title', [
			    'title' => 'Data Customer', 
			    'li_1' => 'Travel', 
			    'li_2' => 'Data Customer'
		    ]),
			'data_customer' => $this->model_customer->getAllRaw(),
			'data_provinsi' => $this->model_provinsi->findAll(),
			'data_kota' => $this->model_kota->getAllRaw()
		];
		
		return view('travel/data_master_list_customer/index', $data);
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
            case 'customer':
                $data = [
                    'name'          => $this->request->getPost('name'), 
                    'gender'        => $this->request->getPost('gender'),
                    'hp'            => $this->request->getPost('hp'),
                    'kode_provinsi' => $this->request->getPost('kode_provinsi'),
                    'kode_kota'     => $this->request->getPost('kode_kota'),
                    'alamat'        => $this->request->getPost('alamat'),
                    'id_service'    => activeServiceId(),
                    'created_by'    => activeId()
                ];
                
                $this->model_customer->reset_increment();
                $insertData = $this->model_customer->save($data);
                
                if ($insertData) {
                    // set customer code
                    $insertedID = $this->model_customer->insertID();
                    $updateData = [
                        'id' => $insertedID,
                        'kode' => generate_customer_code($insertedID),
                    ];
                    $this->model_customer->save($updateData);
                    
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
            case 'customer':
                $provinsi_edit = $this->request->getPost('provinsi_edit');
                $kota_edit = $this->request->getPost('kota_edit');
                
                $data = [
                    'id' => $this->request->getPost('id_edit'),
                    'name' => $this->request->getPost('nama_edit'),
                    'gender' => $this->request->getPost('gender_edit'),
                    'hp' => $this->request->getPost('hp_edit'),
                    'alamat' => $this->request->getPost('alamat_edit')
                ];
                
                if ($provinsi_edit != "") {
                    $data['kode_provinsi'] = $provinsi_edit;
                }
                
                if ($kota_edit != "") {
                    $data['kode_kota'] = $kota_edit;
                }
                
                $this->model_customer->reset_increment();
                $insertData = $this->model_customer->save($data);

                
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
            case 'customer':
                $deleteData = $this->model_customer->delete($this->request->getPost('id'));

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
            case 'kota_by_kode_provinsi':
                $provinsiCode = $this->request->getPost('provinsi_code');
                $data_kota = $this->model_kota->getByProvinsi($provinsiCode);
    
                $options = [];
                foreach ($data_kota as $row) {
                    $options[] = array(
                        'value' => $row->kode,
                        'text' => $row->nama
                    );
                }
    
                $response = array('options' => $options);
                return $this->response->setJSON($response);
            break;
            
            case 'main_table_data':
                $filters = $this->request->getJSON();
                $returnedData = $this->model_customer->getMainDatatable($filters);
            
                function generateTableRow($data, $number) {
                    return "
                        <tr>
                            <td class='text-center'>$number</td>
                            <td class='text-center'>$data->kode</td>
                            <td>$data->name</td>
                            <td class='text-center'>".format_gender($data->gender)."</td>
                            <td class='text-center'>$data->hp</td>
                            <td class='text-center'>$data->nama_provinsi</td>
                            <td class='text-center'>$data->nama_kota</td>
                            <td>$data->alamat</td>
                            <td class='text-center'>
                                <button class='btn btn-sm btn-info' id='btn_edit'
                                    data-id='$data->id'
                                    data-nama='$data->name'
                                    data-gender='$data->gender'
                                    data-hp='$data->hp'
                                    data-provinsi='$data->nama_provinsi'
                                    data-kota='$data->nama_kota'
                                    data-alamat='$data->alamat'
                                >
                                    <i class='bx bx-edit'></i> 
                                </button>
                                <button class='btn btn-sm btn-danger' id='btn_delete' 
                                    data-id='$data->id'
                                    data-nama='$data->name'
                                    data-path='".base_url('customer/delete/customer')."'
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
