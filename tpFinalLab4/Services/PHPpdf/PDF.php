<?php 

namespace Services\PHPpdf;
use Services\PHPpdf\fpdf as FPDF;

class PDF{
    
    public static function CreateAndSaveFile($invoiceid,$content){
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Helvetica','',15);
            $pdf->Cell(0,16,"PET HERO - INVOICE",1,1,'C',);

            $pdf->SetFont('Arial','',12);
            
            for($i = 0; $i<count($content);$i++){
                $pdf->Cell(0,16,$content[$i],0,0,'L');
                $pdf->Ln();
            }
            $pdf->Cell(0,16,"Thanks for use Pet Hero :)",1,1,'C');

            $nameFile = strval($invoiceid);
            
            $filePath = ROOT.'Data/Uploads/invoices/' . $nameFile . '.pdf';
            
            $pdf->Output($filePath,'F');

            
            return $filePath;


    }
}



?>