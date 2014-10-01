<?php
/**
* @author Salipro
* @copyright Sungate Technologies - http://suga.vn
* @tutorial  ClassName and FileName is the same and sensitive 
*/
namespace Suga\Core;

class View {

	private $mustacheLoadDir = 'Mustache/Autoloader.php';
	private $viewExtension = 'tpl';
	public $mustache = null;

	function __construct() {
        
        $view_path = BASE_PATH . SG_VIEW;

		# register auto load Mustache
		require $this->mustacheLoadDir;		
		\Mustache_Autoloader::register();

		# init Mustache engine
		$ext  = array('extension' => $this->viewExtension);
		$opts = array(
			'loader'          => new \Mustache_Loader_FilesystemLoader($view_path,$ext),
			'partials_loader' => new \Mustache_Loader_FilesystemLoader($view_path,$ext),
            'helpers' => array(
                'baseurl' => BASE_URL,
                'assets' => BASE_URL . SG_ASSETS
            )
        );
		
		$this->mustache = new \Mustache_Engine($opts);
	}

/**
 * @return object return View object
 */
	public static function register(){
		$obj = new self(); 
		return $obj;
	}
    
    public function display($layout , $view , $data = null ){
        $numargs = func_num_args();
        switch($numargs){
            case 2: $this->_dis2agr($layout,$view); break;
            case 3: $this->_dis3agr($layout,$view,$data); break;
        }    
    }
    private function _dis2agr($view = '', $data = array()){
        if(!is_array($data)){
            throw new \ErrorException('$data is repuired as array.');
        }
        echo $this->mustache->render($view, $data);
        
    }
    private function _dis3agr($layout = '', $view = '', $data = array()){
        if(!is_array($data)){
            throw new \ErrorException('$data is repuired as array.');
        }
        $data['_yield_'] = $this->mustache->render($view, $data);
        echo $this->mustache->render($layout, $data);
        
    }
}