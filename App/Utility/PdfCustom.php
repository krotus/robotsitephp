<?php 

namespace App\Utility;

use \fpdf\FPDF as FPDF;

class PdfCustom extends FPDF{

	function Header(){
        $this->SetTextColor(0,64,0);
        $this->SetLineWidth(0.25);
        $this->Rect(10,10,190, 15);
        $this-> SetY(15);
        $this-> SetX(15);
        $this->SetFont('Arial','B',16);
        $this->Cell(110,5,'ARMduino',0,0,'L');
        $this->SetFont('Arial','',10);
        $this->Cell(75,5,'Fecha y hora: '.date("d/m/Y G:i"),0,0,'R');
        $this->Ln(15);
        $this->SetFont('Arial','B',14);
        $this->Cell(0,0,'Estadisticas');
        $this->Ln(10);
        $this->SetFont('Arial','B',13);
        //$this->SetWidths(array(15,35,15,115));            
        //$this->SetAligns(array('L', 'L', 'L', 'L' ));
        //$this->Row(array('Codi:', $GLOBALS['petcod'], 'Nom:', $GLOBALS['petnom']  ));   
    }   

    function Footer() {
        //Go to 1.5 cm from bottom
        $this->SetY(-15);
        //Select Arial italic 8
        $this->SetFont('Arial','I',8);
        //Print centered page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'R');
    }

    // Better table
    function ImprovedTable($header, $data)
    {
    // Column widths
    $w = 40;
    // Header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w,7,$header[$i],1,0,'C');
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        foreach ($row as $key => $value) {
            $this->Cell($w,6,$value[0],'LR');
        }
        $this->Ln();
    }
    // Closing line
    $this->Cell($w*(count($header)),0,'','T');
    }


    // Colored table
    function FancyTable($header, $data)
    {
        // Colors, line width and bold font
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Header
    $w = array(40, 35, 40, 45);
    for($i=0;$i<count($header);$i++){
        $this->Cell($w[0],6,rtrim($header[$i]),1,0,'C',true);
    }
    $this->Ln();
        
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data
    $fill = false;
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
        $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
        //$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
    }
		
}

?>