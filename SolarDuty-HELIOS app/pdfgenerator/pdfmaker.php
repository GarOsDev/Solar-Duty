<?php
session_start();
require_once('../fpdf/fpdf.php');
require_once("../db.php");
$db = new HeliosDB();

class PDF extends FPDF {
    // Cabecera de página
    function Header() {
        $this->Image('../iconos_png/helios-high-resolution-logo-transparent.png',10,8,33);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Título
        $this->Cell(0,10,'Reporte de Registros. Prevision de producciones',0,1,'C');
        // Salto de línea
        $this->Ln(20);
    }

    // Pie de página
    function Footer() {
        // Posición a 1.5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
    }

    function AddJsonText($json) {
        $this->SetFont('Courier', '', 10); // Usar una fuente de ancho fijo
        $formattedJson = json_encode(json_decode($json), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        // Divide el texto en líneas y agrega cada línea al PDF
        $lines = explode("\n", $formattedJson);
        foreach ($lines as $line) {
            $this->MultiCell(0, 5, $line);
        }
    }
}

$pdf = new PDF();
$pdf->SetRightMargin(1);
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

$registrosProduccion = $db->pdfRegistrosProduccion($_SESSION['idInstalacion']);

foreach($registrosProduccion as $res) {
    $pdf->SetTextColor(255,0,0);
    $pdf->Cell(75,10,'Id Registro: '.$res['id_registro'],0,1,'L');
    $pdf->Cell(75,10,'Id Instalacion: '.$res['id_instalacion'],0,1,'L');
    $pdf->Cell(80,10,'Fecha de Registro: '.$res['fecha_registro'],0,1,'L');
    $pdf->Ln(10);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->AddJsonText($res['registros_produccion']);
}

$pdf->Output('D', 'HELIOS_solar.pdf');

?>
