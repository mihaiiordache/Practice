<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_page extends CI_Controller {

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
            
              if(!isset($_SESSION)) { session_start(); }
              else echo "You need to log in!";    
              if(isset($_SESSION)){
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
              }}
	}
        
      
        public function sendEmail($to,$subject,$message,$from){
            $txt = $message;
            $headers = "From: ".$from;
            mail($to,$subject,$txt,$headers);
        }
           public function addReview(){
              if(!isset($_SESSION)){
                session_start();
            }
            if($_SESSION['logged_in']==true){
            $this->load->helper('url');
                $this->load->view('header');
                $this->load->view('main_page');
                $this->load->view('footer');
           
            $this->load->model('review');
            $review=new review();
            $review->addReview($_REQUEST);
            }
            else {echo "You need to log in!";}
        }
}
