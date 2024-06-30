<?php

namespace App\Controllers;
use App\Models\Model_list_posisi;

class List_posisi extends BaseController
{
    
    protected $model_list_posisi;
 
    function __construct(){
        $this->model_list_posisi = new Model_list_posisi();
        helper('session');
        helper('formatting');
    }
    
	// home ================================================================================================================================================================
	public function index()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'List Posisi']),
			'page_title' => view('partials/page-title', [
			    'title' => 'List Posisi', 
			    'li_1' => '', 
			    'li_2' => ''
		    ]),
			'data_list_posisi' => $this->model_list_posisi->getAllRaw()
		];
		
		return view('data_master/list_posisi', $data);
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
            case 'karyawan':
                $data = [
                    'nama'          => $this->request->getPost('nama'), 
                    'hp'            => $this->request->getPost('hp'),
                    'alamat'        => $this->request->getPost('alamat'),
                    'id_posisi'     => $this->request->getPost('posisi'),
                    'id_service'    => activeServiceId(),
                    'created_by'    => activeId()
                ];
                
                $this->model_karyawan->reset_increment();
                $insertData = $this->model_karyawan->save($data);
                
                if ($insertData) {
                    $response = [
                        'success' => true,
                        'message' => 'Karyawan baru berhasil disimpan.'
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'Gagal menyimpan Karyawan.'
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
            case 'karyawan':
                $posisi_edit = $this->request->getPost('posisi_edit');
                
                $data = [
                    'id'        => $this->request->getPost('id_edit'),
                    'nama'      => $this->request->getPost('nama_edit'),
                    'hp'        => $this->request->getPost('hp_edit'),
                    'alamat'    => $this->request->getPost('alamat_edit')
                ];
                
                if ($posisi_edit != "") {
                    $data['id_posisi'] = $posisi_edit;
                }
                
                $this->model_karyawan->reset_increment();
                $insertData = $this->model_karyawan->save($data);

                
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
            case 'karyawan':
                $deleteData = $this->model_karyawan->delete($this->request->getPost('id'));

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
                $returnedData = $this->model_karyawan->getMainDatatable($filters);
            
                function generateTableRow($data, $number) {
                    return "
                        <tr>
                            <td class='text-center'>$number</td>
                            <td class='text-center'>$data->nama</td>
                            <td class='text-center'>$data->hp</td>
                            <td class='text-center'>$data->alamat</td>
                            <td class='text-center'>$data->nama_posisi</td>
                            <td class='text-center'>$data->nama_service</td>
                            <td class='text-center'>
                                <button class='btn btn-sm btn-info' id='btn_edit'
                                    data-id='$data->id'
                                    data-nama='$data->nama'
                                    data-hp='$data->hp'
                                    data-alamat='$data->alamat'
                                    data-nama_posisi='$data->nama_posisi'
                                    data-nama_service='$data->nama_service'
                                >
                                    <i class='bx bx-edit'></i> 
                                </button>
                                <button class='btn btn-sm btn-danger' id='btn_delete' 
                                    data-id='$data->id'
                                    data-nama='$data->nama'
                                    data-path='".base_url('karyawan/delete/karyawan')."'
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
