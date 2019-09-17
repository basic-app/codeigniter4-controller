<?php

namespace denis303\codeigniter4;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use Config\Services;

abstract class BaseController extends Controller
{

    protected $user;

    protected $layout = "App\\layout";

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Constructor.
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		
        $this->session = Services::session();
	
        $this->user = Services::user();
    }

    protected function render(string $view, array $params = [])
    {
        $content = view($view, $params, ['saveData' => true]);

        $layout = $this->layout;

        $data = Services::renderer()->getData();

        if (array_key_exists('layout', $data))
        {
            $layout = $data['layout'];
        }

        if ($layout)
        {
            return view($this->layout, ['content' => $content], ['saveData' => false]);
        }

        return $content;
    }

    public function goHome()
    {
        return redirect()->to(base_url());
    }

    public function goBack()
    {
        return redirect()->back();
    }

}