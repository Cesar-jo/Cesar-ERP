<?php
	include 'cabecerafpdf.php';
    require 'conexion.php';
	

    $query = "SELECT v.*,
    g.genero,
    u.nombre,
    u.email
    FROM stock v
    LEFT JOIN generos g ON v.id_genero = g.id
    LEFT JOIN usuarios u ON v.id_usuario = u.id ";
	$resultado = $mysqli->query($query);
  
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(20,6,'ID',1,0,'C',1);
	$pdf->Cell(50,6,'Producto',1,0,'C',1);
	$pdf->Cell(50,6,'Stocks',1,0,'C',1);
    $pdf->Cell(50,6,'fecha',1,1,'C',1);
   
	
	$pdf->SetFont('Arial','',10);
	
    while($row = $resultado->fetch_assoc())
	{
		$pdf->Cell(20,6,($row['id']),1,0,'C');
		$pdf->Cell(50,6,$row['Nombre'],1,0,'C');
		$pdf->Cell(50,6,($row['cantidad']),1,0,'C');
        $pdf->Cell(50,6,($row['creado']),1,1,'C');
        
	}
	
	$pdf->Output();
?>