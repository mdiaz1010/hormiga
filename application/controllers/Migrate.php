<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller{   
    
    public function __construct() { 
        parent::__construct();
    }

    public function index()
    {
        $this->load->library('migration');
        $this->migration->latest();
        
    }
    
    public function modulo() {
        $this->load->library('migration');
        $this->migration->version('20161228000001');
    }
    
    public function reset($hasta='20161228000009') {
        $this->load->library('migration');
        $this->migration->version($hasta);
    }
}
?>