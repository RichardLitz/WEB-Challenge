<?php
       $pdf->SetTopMargin(0);
       $pdf->SetLeftMargin(15);
       $pdf->SetAutoPageBreak('auto',1);

       $pdf -> AddPage();
       $pdf->Image($_SESSION["s_Patch"]."/assets/images/logo-contrato-topo.png",20,10,50);
       $pdf->Image($_SESSION["s_Patch"]."/assets/images/abese-contrato-topo.jpg",120,10,30);

       $pdf->Ln(30);

       $pdf->SetFont('Arial','B',11);
       $pdf->Cell(160,5,utf8_decode($NomeRel),0,0,'C');
       $pdf->SetFont('Arial','B',7);
       $npage=$pdf->PageNo();
       $pdf->Cell(20,5,utf8_decode("Página ").$npage,0,0,'R');
       $pdf->Ln(5);
       $pdf->SetFont('Arial','',7);
       #$pdf->Cell(25,5,strftime("%d/%m/%Y - %H:%M"),0,0,'R');
       $pdf->Ln(5);
       $pdf->Cell(20,5,"___________________________________________________________________________________________________________________________________",0,0,'L');
       $pdf->Ln(10);
?>