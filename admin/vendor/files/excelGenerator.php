<?php
    // require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

    class ExcelGenerator {

        public function createFile($dataToExport) {
            $titulo = '';
            $data = '';
            foreach ($dataToExport as $row) {
                $line = '';
                foreach ($row as $value) {
                    if (!isset($value) || $value == '') {
                        $value = "\t";
                    } else {
                        $value = str_replace('"', '""', $value);
                        $value = '"' . $value . '"' . "\t";
                    }
                    $line .= $value;
                }
                $data .= trim($line) . "\n";
            }

            $data = str_replace("\r", "", $data);

            if ($data == "") {
                $data = "\n(0) Records Found!\n";
            }

            // Si deseas obtener los títulos de las columnas del array asociativo
            $titulo = implode("\t", array_keys($dataToExport[0]));

            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=archivo_exportado.csv");
            // header("Pragma: no-cache");
            // header("Expires: 0");
            // print "$titulo\n$data";

            $fp = fopen('php://output', 'w');
            fputcsv($fp, array_keys($dataToExport[0])); // Escribir títulos de columnas
            foreach ($dataToExport as $row) {
                fputcsv($fp, $row);
            }
            fclose($fp);
            exit;
        }
    }
?>