<?php
    include_once("../../Documents/fpdf184/fpdf.php");

    class PDF extends FPDF {
        // Page header
        function Header(){
            // Logo
            $this->Image('../../View/img/logoProSkin.png',20,10,20);
            // Arial bold 15
            $this->SetFont('Arial','B',15);
            // Move to the right
            $this->Cell(80);
            // Title
            $this->Cell(30,10,'Reporte de ciere de caja',0,0,'C');
            $this->Ln(5);
            $this->Cell(80);
            $this->Cell(30,10,'Centro de belleza x',0,0,'C');
            $this->Ln(5);
            $this->Cell(80);
            $this->Cell(30,10,'24/09/2021',0,0,'C');
            $this->Ln(5);
            // Line break
            $this->Ln(20);
        }

        // Page footer
        function Footer()
        {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Page number
            $this->Cell(0,10,utf8_decode('Página '.$this->PageNo().'/{nb}'),0,0,'C');
        }
        function ImprovedTable($header, $data)
        {
            // Column widths
            $w = array(70, 35, 40);
            // Header
            $this->Cell(20);
            for($i=0;$i<count($header);$i++)
                $this->Cell($w[$i],10,$header[$i],1,0,'C');
            $this->Ln();
            // Data
            foreach($data as $row)
            {
                $this->Cell(20);
                $this->Cell($w[0],6,$row[0],'LR');
                $this->Cell($w[1],6,$row[1],0,0,'C');
                $this->Cell($w[2],6,"$".number_format($row[2], 2),'LR',0,'R');
                $this->Ln();
            }
            $this->Cell(20);
            $this->Cell(array_sum($w),0,'','T');
            $this->Ln();
            $this->Cell(20);
            $this->Cell(70,6,"Total",'LR',0,'R');
            $this->Cell(35,6,number_format(100),'LR',0,'R');
            $this->Cell(40,6,number_format(10780),'LR',0,'R');
            $this->Ln();
            // Closing line
            $this->Cell(20);
            $this->Cell(array_sum($w),0,'','T');
            $this->Ln(20);
        }
    }

    function generarPDF($conceptos, $observaciones, $filename){
        // Instanciation of inherited class
        $pdf = new PDF();

        $header = array('Concepto', '# de ventas', 'Total');
        $data = $conceptos;
        
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->ImprovedTable($header,$data);
        $pdf->SetFont('Arial','B',15);
        $pdf->Cell(20);
        $pdf->Cell(40,10,'Observaciones:');
        $pdf->SetFont('Times','',12);
        $pdf->Ln();
        $pdf->Cell(20);
        $pdf->Multicell(145,10,utf8_decode($observaciones)); 

        // $pdf->Output();
        $pdf->Output('F', '../../Documents/ReportesCierreCaja/' . $filename, true); // save into some other location
    }
?>