<?php

       $pdf->Sety(260);
       $pdf->SetFont('Arial','',7);
       $pdf->Cell(20,5,"___________________________________________________________________________________________________________________________________",0,0,'L');
       $pdf->Ln(5);

       $pdf->Image($_SESSION["s_Patch"]."/assets/images/logo-topo.png",25,265,25);

       $pdf->SetFont('Arial','',7);
       $pdf->Cell(180,5,utf8_decode($_SESSION["s_FranquiaNome"]),0,0,'C');
       $pdf->Ln(5);
        $pdf->Cell(180,5,utf8_decode("Telefone: ".$_SESSION["s_FranquiaTelefone"]." - Email: ".$_SESSION["s_FranquiaEmail"]),0,0,'C');
        $pdf->Ln(5);
       $pdf->Cell(180,5,utf8_decode("Veículo - Franshising"),0,0,'C');
       $pdf->Ln(5);
       $pdf->Cell(180,5,utf8_decode("www.Veículo.com.br"),0,0,'C');
       $pdf->Ln(5);
?>