<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
            $this->load->view('home');

	}
        
        public function LogIn(){
             $this->load->helper('url');
            $this->load->view('home');

             $this->load->model('user');
             $username=$_POST['username'];
             $password=$_POST['password']; 
             $user=new user();
             $user->logIn($username, $password);
             
        }
        
        public function checkLogin(){
            $this->load->model('user');
            
             $username=$_POST['username'];
             $password=$_POST['password']; 
             $user=new user();
             $user->logIn($username, $password);
            if($_SESSION['logged_in']==true){
               $this->load->helper('url');
                $this->load->view('header');
                $this->load->view('main_page');
                $this->load->view('footer');
                $this->load->model('user');
                
            } else{
                echo "Incorrect username or password. Try again!";
                 $this->load->helper('url');
                
                $this->load->view('home');
                
                $this->load->model('user');
            }
        }
       
        public function logout(){
           
           
            if(!isset($_SESSION)){
                
                session_start();
                $_SESSION['logged_in']=false;
                 
                 unset($_SESSION["logged_in"]);
              
              session_destroy();
              
            }
            if(isset($_SESSION)){
                session_start();
                $_SESSION['logged_in']=false;
                  unset($_SESSION["logged_in"]);
              
               session_destroy();
               
            }
            $this->load->helper('url');
            $this->load->view('home');
        }
}
