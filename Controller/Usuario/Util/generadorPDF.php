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
            $this->Ln(5);
            $this->Cell(80);
            $this->Cell(30,10,'Reporte de ciere de caja',0,0,'C');
            $this->Ln(5);
            // Line break
            $this->Ln(15);
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
        function tablaIngresos($header, $data, $sumaConceptos)
        {
            // Column widths
            $w = array(105, 40);
            // Header
            $this->Cell(20);
            for($i=0;$i<count($header);$i++)
                $this->Cell($w[$i],10,utf8_decode($header[$i]),1,0,'C');
            $this->Ln();
            // Data
            $num_ventas = 0;
            foreach($data as $row)
            {
                $this->Cell(20);
                $this->Cell($w[0],6,$row[0],'LR');
                $this->Cell($w[1],6,"$".number_format($row[1], 2),'LR',0,'R');
                $num_ventas += $row[1];
                $this->Ln();
            }
            $this->Cell(20);
            $this->Cell(array_sum($w),0,'','T');
            $this->Ln();
            $this->Cell(20);
            $this->Cell(105,6,"",'LR',0,'R');
            $this->Cell(40,6,"$".number_format($sumaConceptos, 2),'LR',0,'R');
            $this->Ln();
            // Closing line
            $this->Cell(20);
            $this->Cell(array_sum($w),0,'','T');
            $this->Ln(20);
        }

        function tablaGastos($header, $nombres, $totales, $sumaGastos)
        {
            // Column widths
            $w = array(105, 40);
            // Header
            $this->Cell(20);
            for($i=0;$i<count($header);$i++)
                $this->Cell($w[$i],10,$header[$i],1,0,'C');
            $this->Ln();
            // Data
            $size = sizeof($nombres);
            if($nombres[0] != '' && $totales[0] != ''){
                for ($i=0; $i < $size; $i++) { 
                    $this->Cell(20);
                    $this->Cell($w[0],6,$nombres[$i],'LR');
                    $this->Cell($w[1],6,"$".number_format($totales[$i], 2),'LR',0,'R');
                    $this->Ln();
                }
            }
            $this->Cell(20);
            $this->Cell(array_sum($w),0,'','T');
            $this->Ln();
            $this->Cell(20);
            $this->Cell(105,6,"Total",'LR',0,'R');
            $this->Cell(40,6,"$".number_format($sumaGastos, 2),'LR',0,'R');
            $this->Ln();
            // Closing line
            $this->Cell(20);
            $this->Cell(array_sum($w),0,'','T');
            $this->Ln(10);
        }
    }

    function generarPDF($id_documento, $id_corte_caja, $diaCorteCaja, $numTotalVentasDia, $centro, $conceptos, $observaciones, $nombres_gastos, $total_gastos, $sumaConceptos, $sumaGastos, $efectivo_a_entregar, $filename){
        // Instanciation of inherited class
        $pdf = new PDF();

        $header = array('Método de pago', 'Total');
        $header_gastos = array('Nombre del gasto', 'Total');
        $data = $conceptos;
        
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',15);
        $pdf->Cell(20);
        $pdf->Cell(40,10,utf8_decode($centro).' - ('.$diaCorteCaja.')');
        $pdf->Cell(40);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(80,10,utf8_decode('ID documento: '.$id_documento));
        $pdf->SetFont('Arial','B',15);
        $pdf->Ln();
        $pdf->Cell(20);
        $pdf->Cell(40,10,utf8_decode('Ventas totales del día: '.$numTotalVentasDia));
        $pdf->Cell(40);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(50,10,utf8_decode('Corte caja: '.$id_corte_caja));
        $pdf->SetFont('Arial','B',15);
        $pdf->Ln();
        $pdf->tablaIngresos($header, $data, $sumaConceptos);
        $pdf->Ln();
        $pdf->tablaGastos($header_gastos, $nombres_gastos, $total_gastos, $sumaGastos);
        $pdf->SetFont('Arial','B',15);
        $pdf->Cell(20);
        $pdf->Cell(40,10,utf8_decode('Efectivo a entregar: $'.number_format($efectivo_a_entregar)));
        $pdf->Ln();
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