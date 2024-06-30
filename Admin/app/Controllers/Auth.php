<?php

namespace App\Controllers;
use App\Models\Model_user;
use App\Models\Model_template;
use App\Models\Model_entitas;

class Auth extends BaseController
{
    protected $model_user;
 
    function __construct(){
        $this->model_user = new Model_user();
        $this->template_model = new Model_template();
        $this->model_entitas = new Model_entitas();
    }
    
	// Pages
	public function index()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Login']),
			'data_template' => $this->template_model->findAll()
		];
		return view('auth/auth-login', $data);
	}
	
	
    // login ========================================================================================================================================================	
	public function login()
    {
	    $session = session();
        
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $data = $this->model_user->where('username', $username)->first();
        if($data){
            $pass = $data->password;
            // $verify_pass = password_verify($password, $pass);
            if($pass === $password){
                $data_entitas = $this->model_entitas->where('id', $data->id_entitas)->first();
                $ses_data = [
                    'activeId'      => $data->id,
                    'username'      => $data->username,
                    'id_service'    => $data_entitas->id_service,
                    'last_activity' => time()
                ];
                $session->set($ses_data);
                $session->setFlashdata('message', 'Login Berhasil');
                // Log success
                error_log("Login successful for username: $username");
                return redirect()->to('/data-master-customer');
            }else{
                $session->setFlashdata('error', 'Password Anda Salah');
                
                // Log incorrect password
                error_log("Login failed for username: $username due to incorrect password");

                return redirect()->to('/');
            }
        }else{
            $session->setFlashdata('error', 'Username Tidak Ditemukan');
            
            // Log username not found
            error_log("Login failed because username not found: $username");
            
            return redirect()->to('/');
        }
    }
 
    public function logout()
    {
        $session = session();
        $session->setFlashdata('message', 'Berhasil Logout');
        $session->destroy();
        return redirect()->to('/');
    }
}
