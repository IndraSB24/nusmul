<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class BaseController extends Controller
{
	protected $helpers = [];

	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.: $this->session = \Config\Services::session();
		$session = \Config\Services::session();
      	$language = \Config\Services::language();
      	$language->setLocale($session->lang);
      	
      	$this->checkSession($session);
	}
	
	private function checkSession($base_session)
    {
        // Check if the user is logged in
        if (!$base_session->has('activeId')) {
            // Redirect to the login page or perform logout
            return redirect()->to('/');
        }

        // Check if the session is still valid
        $lastActivity = $base_session->get('last_activity');
        $sessionExpiration = config('App')->sessionExpiration;

        if (time() - $lastActivity > $sessionExpiration) {
            // Session expired, perform logout
            $base_session->destroy();
            return redirect()->to('/');
        }

        // Update the last activity time to keep the session alive
        $base_session->set('last_activity', time());
    }
}
