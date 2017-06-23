<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_jobs extends CI_Controller {

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
            if(!isset($_SESSION)){
                session_start();
            }
             $this->load->model('user');
           echo $_SESSION['logged_in'];
                if($_SESSION['logged_in']==true||$_SESSION['logged_in']!=0){
            $this->load->helper('url');
            $this->load->view('header');
            $this->load->view('add_jobs');
            $this->load->view('footer');}
            
            else {echo "You need to log in!";}
	}
        
        public function addJob(){
            $this->load->helper('url');
            $this->load->view('header');
            $this->load->view('add_jobs');
            $this->load->view('footer');
            $this->load->model('job');
            $job=new job();
            $job->addJob($_POST);
        }
        }

