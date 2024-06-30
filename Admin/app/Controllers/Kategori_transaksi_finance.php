<?php

namespace App\Controllers;
use App\Models\Model_kategori_transaksi_finance;

class Kategori_transaksi_finance extends BaseController
{
    
    protected $model_user;
 
    function __construct(){
        $this->model_kategori_transaksi_finance = new Model_kategori_transaksi_finance();
        helper('session');
        helper('formatting');
    }
    
	// home ================================================================================================================================================================
	public function index($kode)
	{
	    switch($kode){
	        case 'pemasukan':
	            $data = [
        			'title_meta' => view('partials/title-meta', ['title' => 'Kategori Pemasukan']),
        			'page_title' => view('partials/page-title', [
        			    'title' => 'Kategori Pemasukan', 
        			    'li_1' => '', 
        			    'li_2' => ''
        		    ]),
        			'data_kategori_pemasukan' => $this->model_kategori_transaksi_finance->getAllRaw('pemasukan')
        		];
        		
        		return view('data_master/kategori_pemasukan', $data);
	        break;
	        
	        case 'pengeluaran':
	            $data = [
        			'title_meta' => view('partials/title-meta', ['title' => 'Kategori Pengeluaran']),
        			'page_title' => view('partials/page-title', [
        			    'title' => 'Kategori Pengeluaran', 
        			    'li_1' => '', 
        			    'li_2' => ''
        		    ]),
        			'data_kategori_pengeluaran' => $this->model_kategori_transaksi_finance->getAllRaw('pengeluaran')
        		];
        		
        		return view('data_master/kategori_pengeluaran', $data);
	        break;
	    }
		
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
            case 'pemasukan':
                $data = [
                    'tipe'              => 'pemasukan',
                    'nama'              => $this->request->getPost('nama'), 
                    'deskripsi'         => $this->request->getPost('deskripsi'),
                    'created_by'        => activeId()
                ];
                $this->model_kategori_transaksi_finance->reset_increment();
                $insertData = $this->model_kategori_transaksi_finance->save($data);
                
                if ($insertData) {
                    $response = [
                        'success' => true,
                        'message' => 'Kategori Pemasukan baru berhasil disimpan.'
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'Gagal menyimpan Kategori Pemasukan.'
                    ];
                }
                return $this->response->setJSON($response);
            break;
            
            case 'pengeluaran':
                $data = [
                    'tipe'              => 'pengeluaran',
                    'nama'              => $this->request->getPost('nama'), 
                    'deskripsi'         => $this->request->getPost('deskripsi'),
                    'created_by'        => activeId()
                ];
                $this->model_kategori_transaksi_finance->reset_increment();
                $insertData = $this->model_kategori_transaksi_finance->save($data);
                
                if ($insertData) {
                    $response = [
                        'success' => true,
                        'message' => 'Kategori Pengeluaran baru berhasil disimpan.'
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'Gagal menyimpan Kategori Pengeluaran.'
                    ];
                }
                return $this->response->setJSON($response);
            break;
        }
    }
    
    // edit ================================================================================================================================================================
    public function edit($kode = '')
    {
        switch ($kode) {
            case '':
                $data = [
                    'id'        => $this->request->getPost('id_edit'), 
                    'nama'      => $this->request->getPost('nama_edit'), 
                    'deskripsi' => $this->request->getPost('deskripsi_edit')
                ];
                
                $this->model_kategori_transaksi_finance->reset_increment();
                $insertData = $this->model_kategori_transaksi_finance->save($data);
                
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
    public function delete($kode = '')
    {
        switch ($kode) {
            case '':
                $deleteData = $this->model_kategori_transaksi_finance->delete($this->request->getPost('id'));

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
    public function ajax_get($kode="", $tipe)
    {
        switch ($kode) {
            case 'main_table_data':
                $filters = $this->request->getJSON();
                $returnedData = $this->model_kategori_transaksi_finance->getMainDatatable($tipe);
            
                function generateTableRow($data, $number) {
                    return "
                        <tr>
                            <td class='text-center'>$number</td>
                            <td class='text-center'>$data->nama</td>
                            <td class='text-center'>$data->deskripsi</td>
                            <td class='text-center'>
                                <button class='btn btn-sm btn-info' id='btn_edit'
                                    data-id='$data->id'
                                    data-nama='$data->nama'
                                    data-deskripsi='$data->deskripsi'
                                >
                                    <i class='bx bx-edit'></i> 
                                </button>
                                <button class='btn btn-sm btn-danger' id='btn_delete' 
                                    data-id='$data->id'
                                    data-nama='$data->nama'
                                    data-path='".base_url('kategori_transaksi_finance/delete')."'
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
