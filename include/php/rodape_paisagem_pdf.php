<?php

       $pdf->Sety(188);
       $pdf->SetFont('Arial','',7);
       $pdf->SetTextColor(0,0,0);
       $pdf->Cell(0,5,"__________________________________________________________________________________________________________________________________________________________________________________________________",0,0,'C');
       $pdf->Ln(5);


       $pdf->Cell(50, 10, $pdf->Image('../../lib/img/logoSGFpequeno.jpg', 15, 195, 22));
       $pdf->Ln(1);
       $pdf->SetFont('Arial','',7);
       $pdf->Cell(0,5,"SGFweb – www.sgfweb.com.br – (17)3272-2691",0,0,'C');
       $pdf->Ln(4);
       $pdf->Cell(0,5,"SGFweb – Sistema de Gestão Financeira Via Web",0,0,'C');
       $pdf->Ln(4);
       $pdf->Cell(0,5,"Usuário: ".$_SESSION["s_Nome"],0,0,'C');
       $pdf->Ln(4);
?>