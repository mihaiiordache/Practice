<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_profile extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            $this->load->helper('url');
            $this->load->view('header');
            $this->load->view('update_profile');
            $this->load->view('footer');
           
	}
        
        public function updateProfile(){
            $this->load->helper('url');
            $this->load->view('header');
            $this->load->view('update_profile');
            $this->load->view('footer');
            $this->load->model('user');
            $user=new user();
           
           
            
             $user->updateProfile($_POST,$_FILES['myfile'],['name']);
             
             
               $config['upload_path']  = './images/';
                $config['allowed_types'] = 'gif|jpg|png';
               $config['max_size']     = '9000';
               $config['max_width'] = '10024';
                $config['max_height'] = '1768';

                $this->load->library('upload', $config);
                //$this->upload->initialize($config);
                //echo $ext=pathinfo('myfile', PATHINFO_EXTENSION)."test";
                if ( ! $this->upload->do_upload('myfile'))
                {
                       $error = array('error' => $this->upload->display_errors());

                       // echo "not";
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());

                      //  echo "done";
                }
        }
        
     
}
