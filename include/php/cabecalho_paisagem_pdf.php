<?php
    $TextoTeleMarketing = "";
    if(trim($TeleMarketing) == "M")
     {
    	$TextoTeleMarketing = " - TELEMARKETING";
     }


       $pdf->Ln(5);
       $pdf->SetFont('Arial','B',7);
       $pdf->Cell(143,5,$NomeRel.$TextoTeleMarketing,0,0,'L');
       $npage=$pdf->PageNo();
       $pdf->Cell(118,5,"Página ".$npage,0,0,'R');
       $pdf->Ln(4);
        $pdf->SetFont('Arial','',7);
       $pdf->Cell(238,5,$ResultEnt[razsoc],0,0,'L');
       $pdf->Cell(1,5,strftime("%d/%m/%Y - %H:%M"),'R');
       $pdf->Ln(4);
       $pdf->Cell(20,5,"_____________________________________________________________________________________________________________________________________________________________________________________________",0,0,'L');
       $pdf->Ln(8);

?>