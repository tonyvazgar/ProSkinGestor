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
        function tablaIngresos($header, $data, $sumaConceptos)
        {
            // Column widths
            $w = array(70, 35, 40);
            // Header
            $this->Cell(20);
            for($i=0;$i<count($header);$i++)
                $this->Cell($w[$i],10,$header[$i],1,0,'C');
            $this->Ln();
            // Data
            $num_ventas = 0;
            foreach($data as $row)
            {
                $this->Cell(20);
                $this->Cell($w[0],6,$row[0],'LR');
                $this->Cell($w[1],6,$row[1],0,0,'C');
                $num_ventas += $row[1];
                $this->Cell($w[2],6,"$".number_format($row[2], 2),'LR',0,'R');
                $this->Ln();
            }
            $this->Cell(20);
            $this->Cell(array_sum($w),0,'','T');
            $this->Ln();
            $this->Cell(20);
            $this->Cell(70,6,"Total",'LR',0,'R');
            $this->Cell(35,6,number_format($num_ventas),'LR',0,'C');
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
            for ($i=0; $i < $size; $i++) { 
                $this->Cell(20);
                $this->Cell($w[0],6,$nombres[$i],'LR');
                $this->Cell($w[1],6,"$".$totales[$i],'LR',0,'R');
                $this->Ln();
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

    function generarPDF($conceptos, $observaciones, $nombres_gastos, $total_gastos, $sumaConceptos, $sumaGastos, $totalDelDia, $filename){
        // Instanciation of inherited class
        $pdf = new PDF();

        $header = array('Concepto', '# de ventas', 'Total');
        $header_gastos = array('Nombre del gasto', 'Total');
        $data = $conceptos;
        
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->tablaIngresos($header, $data, $sumaConceptos);
        $pdf->Ln();
        $pdf->tablaGastos($header_gastos, $nombres_gastos, $total_gastos, $sumaGastos);
        $pdf->SetFont('Arial','B',15);
        $pdf->Cell(20);
        $pdf->Cell(40,10,utf8_decode('Total venta del día: $'.number_format($totalDelDia)));
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

    // $conceptos = [["Efectivo", $num_efectivo, $efectivo],
    //                  ["TDC", $num_tdc, $tdc],
    //                  ["TDD", $num_tdd, $tdd],
    //                  ["Transferencia", $num_transferencia, $transferencia],
    //                  ["Deposito", $num_deposito, $deposito],
    //                  [$sumaGeneralMetodos, $sumaGeneralGastos, $totalDelDia]];
    // $nombres_gastos = ["papel","limpiador","perfume"];
    // $total_gastos = ["40","100","84"];
    
    // generarPDF($conceptos, "kuahsdasjkdas", $nombres_gastos, $total_gastos, "hola.pdf");
?>