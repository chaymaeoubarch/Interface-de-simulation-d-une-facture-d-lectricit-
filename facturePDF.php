<?php
error_reporting(0);
require('fpdf/fpdf.php');
function calcule($first,$second) {
                $kwh = $second - $first;
		$kwhO = $kwh;
		$kwh2 = 100 ;
                $tranch ; 
		$tranch2 ;
                $p_u ;
                $tumbre = '0.45';
                $tva = 0.14;
                $calibre = $_POST['cars'];
		$hors_tax2;
		$mont_tax2;
		$tplce2;
		$resultF;
	
                $rfe = number_format((float) $calibre * 0.14 ,2,'.','');
                if ($kwh < 150) {
                        if ($kwh > 0 && $kwh < 100) {
                                $tranch ='TRANCHE 1';
                                $p_u  = '0,794'; 
                        } else if ($kwh > 101 && $kwh < 150) {
				$kwh2 = $kwh - $kwh2;
				$kwh = 100 ;
                                $tranch = 'TRANCHE 1';
				$tranch2 = 'TRANCHE2';
				$p_u = '0,794';
				$p_u2 = '0,883';

                        }

                } else if ($kwh > 150) {
                        if ($kwh > 151 && $kwh < 210) {
                                $tranch ='TRANCHE 3';
                                $p_u = '0,9451'; 
                        }else if ($kwh > 211 && $kwh < 310) {
                                $tranch ='TRANCHE 4';
                                $p_u = '1,0489'; 
                        }else if ($kwh > 311 && $kwh < 510) {
                                $tranch ='TRANCHE 5';
                                $p_u = '1,2915'; 
                        }else if($kwh > 511) {
                                $tranch = 'TRANCHE 6';
                                $p_u =  '1,4975';
                        }

                }

                $hors_tax = number_format((float)$kwh * str_replace(',','.',$p_u),2,'.','');
		if ($tranch2 !='') {
			$hors_tax2 = number_format((float)$kwh2 * str_replace(',','.',$p_u2),2,'.','');
			$hors_tat = number_format((float)$kwh * str_replace(',','.',$p_u),2,'.','');
                	$mont_tax2 = number_format((float) str_replace(',','.',$p_u2)* $kwh ,2,'.','');
			$tplce = number_format((float) $hors_tax * $tva ,2,'.','');
			$tplce2 =  number_format((float) $hors_tax2 * $tva ,2,'.','');
			$consom = $tplce + $tplce2 + $rfe;
			$consom = number_format((float)$consom,2,'.','');
			$result = $consom + $tumbre;
			$resultF = $hors_tax + $hors_tax2 + $calibre;
			$result_tva = $resultF + $consom;
		}else{
                $rfe = str_replace(',','.',$rfe);
                $tumbre = str_replace(',','.',$tumbre);
                // $mont_tax = number_format((float)str_replace(',','.',$p_u)* $kwh * 0.14,1,'.','');
                $mont_tax = str_replace(',','.',$p_u)* $kwh * 0.14;
                $mont_tax = number_format((float)$mont_tax,2,'.','');
                $tplce = $hors_tax * $tva ;
                $consom =  number_format((float)$hors_tax,1,'.','') * $tva + $rfe + $tumbre;
                $result = $hors_tax + str_replace(',','.',$calibre);
                $result_tva = $result + $consom ;
			}		
				
		//echo $hors_tax.' '.$hors_tax2.' '.$mont_tax2.' '.$tplce.' '.$rfe.' '.$consom.' '.$result.' '.$resultF.' '.$result_tva;
		$array_info = [
				'hors_tax'=>$hors_tax,
				'tva'=>'14%',
				'kwh2'=>$kwh2,
				'kwhO'=>$kwhO,
				'calibre2'=>$calibre2,
				'hors_tax2'=>$hors_tax2,
				'mont_tax2'=>$mont_tax2,
				'tplce2'=>$tplce2,
				'tplce'=>$tplce,
				'kwh'=> $kwh,
                                'p_u'=> $p_u,
				'p_u2'=> $p_u2,
                                'mont_tax'=> $mont_tax,
                                'consom'=>$consom,
                                'tplce'=>$tplce,
				'resultF'=>$resultF,
                                'result'=> $result,
                                'tranche'=> $tranch,
				'tranche2'=>$tranch2,
                                'calibre'=>$calibre,
                                'rfe'=> $rfe ,
                                'total_tva'=>$result_tva
				];
		return $array_info;
        }

$first_index = intval($_POST['firstIndex']);
$second_index =intval($_POST['secondIndex']);
$write = calcule($first_index,$second_index);
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetTextColor(128,128,140);
$pdf->SetFont('Arial','',8);
$pdf->Cell(55,5,'Ancien index : '.$first_index,1,0);
$pdf->Cell(55,5,'Nouvel index : '.$second_index,1,0);
$pdf->Cell(55,5,'Consommation : '.$write['kwhO'].' kwh',1,0);
$pdf->Cell(55,5,"",0,1);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(55,5,"",0,0);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(20,10,'Facture :  ',0,0);
$pdf->Cell(20,10,'P.U :  ',0,0);
$pdf->Cell(20,10,'Montant HT  ',0,0);
$pdf->Cell(20,10,'Taux TVA    ',0,0);
$pdf->Cell(20,10,'Montant Taxes ',0,0);
$pdf->Cell(20,10,"",0,1);
$pdf->Cell(55,5,'CONSOMMATION ELECTRICITE ',0,1);

$pdf->Cell(55,5,$write['tranche'],0,0);
$pdf->cell(20,5,$write['kwh'],0,0);
$pdf->Cell(20,5,$write['p_u'],0,0);
$pdf->Cell(20,5,$write['hors_tax'],0,0);
$pdf->Cell(20,5,$write['tva'],0,0);
$pdf->Cell(20,5,$write['tplce'],0,0);
$pdf->Cell(20,5,'',0,1);

if($write['tranche2'] !='') {
$pdf->Cell(55,5,$write['tranche2'],0,0); 
$pdf->cell(20,5,$write['kwh2'],0,0);
$pdf->Cell(20,5,$write['p_u2'],0,0);
$pdf->Cell(20,5,$write['hors_tax2'],0,0);
$pdf->Cell(20,5,$write['tva'],0,0);
$pdf->Cell(20,5,$write['tplce2'],0,0);
$pdf->Cell(20,5,'',0,1);

}

$pdf->SetFont('Arial','B',8);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(55,10,'REDEVANCE FIXE ELECTRICITE ',0,0);
$pdf->Cell(20,5,'',0,0);
$pdf->Cell(20,5,'',0,0);
$pdf->Cell(20,10,$write['calibre'],0,0);
$pdf->Cell(20,10,$write['tva'],0,0);
$pdf->Cell(20,10,$write['rfe'],0,1);

$pdf->Cell(55,10,'TAXES POUR LE COMPTE DE L\' ETAT',0,1);
$pdf->Cell(55,5,'TOTVAL TVA ',0,0);
$pdf->Cell(20,5,' ',0,0);
$pdf->Cell(20,5,'',0,0);
$pdf->Cell(20,5,'',0,0);
$pdf->Cell(20,5,' ',0,0);
$pdf->Cell(20,5,$write['consom'],0,1);
$pdf->Cell(55,5,'TIMBRE ',0,0);
$pdf->Cell(20,5,' ',0,0);
$pdf->Cell(20,5,'',0,0);
$pdf->Cell(20,5,'',0,0);
$pdf->Cell(20,5,' ',0,0);
$pdf->Cell(20,5,'0.45',0,1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(55,10,'SOUS - TOTAL',0,0);
$pdf->Cell(20,10,'',0,0);

$pdf->Cell(20,10,$write['resultF'],0,0);
$pdf->Cell(20,10,' ',0,0);
$pdf->Cell(20,10,$write['result'],0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(55,20,'TOTAL ELECTRICITE',0,0);
$pdf->Cell(20,20,' ',0,0);
$pdf->Cell(20,20,' ',0,0);
$pdf->Cell(20,20,$write['total_tva'],0,0);

$pdf->Output();
?>
