<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/fpdf/fpdf.php";
 
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class Pdf extends FPDF {
        public function __construct() {
            parent::__construct();
        }
        // El encabezado del PDF
        public function Header(){
            $this->Image(base_url('publico/media/escudo.png'),10,8,15);
            $this->SetFont('Arial','B',13);
            $this->Cell(30);
            $datosHeader = $this->GetDatosHeader();
            $datosBody = $this->GetDatosBody();
            $this->Cell(120, 5, $datosHeader , 0, 0, "C");
            $this->Ln('5');
            $this->SetFont('Arial','B',8);
            $this->Cell(30);
            $this->Cell(120,10,$datosBody,0,0,'L');
            $this->Ln(20);
       }
       // El pie del pdf
       public function Footer(){
           $this->SetY(-15);
           $this->SetFont('Arial','I',8);
           $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
      }
      public function SetDatosHeader( $datos ){
      $this->datosHeader = $datos;
      }
      public function SetDatosBody( $datos ){
      $this->datosBody = $datos;
      }
      public function GetDatosHeader(){
      return $this->datosHeader;
     }      
      public function GetDatosBody(){
      return $this->datosBody;
     }       
    }
?>