<?php
	include 'cabecerafpdf.php';
    require 'conexion.php';

  $query = "SELECT id, nombre, email, rol FROM usuarios";
  $resultado = mysqli_query($mysqli,$query); 
  
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(20,6,'ID',1,0,'C',1);
	$pdf->Cell(50,6,'Nombre',1,0,'C',1);
	$pdf->Cell(50,6,'Email',1,0,'C',1);
    $pdf->Cell(50,6,'Rol',1,1,'C',1);
	
   
	
	$pdf->SetFont('Arial','',10);
	
    while($row = $resultado->fetch_assoc())
	{
		$pdf->Cell(20,6,($row['id']),1,0,'C');
		$pdf->Cell(50,6,$row['nombre'],1,0,'C');
		$pdf->Cell(50,6,($row['email']),1,0,'C');
        $pdf->Cell(50,6,($row['rol']),1,1,'C');
  
	}
	
	$pdf->Output();
?>