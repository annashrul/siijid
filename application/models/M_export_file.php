<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_export_file extends CI_Model {
	
	public function create_barcode($barcode=null){
		/*
		$barcode['file']; $barcode['code']; $barcode['type']; $barcode['imageline']; $barcode['drawcross']; 
		*/
		
		// -------------------------------------------------- //
		//                  PROPERTIES
		// -------------------------------------------------- //
		// download a ttf font here for example : http://www.dafont.com/fr/nottke.font
		//$font     = './NOTTB___.TTF';
		// - -
		
		$file = isset($barcode['file'])?$barcode['file']:'barcode.png';
		$file = explode('.', $file);
		$nama = $file[0]; 
		isset($file[1]) ? $ext=$file[1] : $ext='png';
		$code = isset($barcode['code'])?$barcode['code']:'123456789'; // barcode, of course ;)
		$type = isset($barcode['type'])?$barcode['type']:'code128';
		
		$l = 150 + (15 * strlen($code));
		$t = 65;
		$fontSize = 10;   // GD1 in px ; GD2 in point
		$marge    = 100;   // between barcode and hri in pixel
		$x        = $l / 2;  // barcode center horizontal
		$y        = $t / 2;  // barcode center vertical
		$height   = 30;   // barcode height in 1D ; module size in 2D
		$width    = 3;    // barcode height in 1D ; not use in 2D
		$angle    = 0;   // rotation in degrees : nb : non horizontable barcode might not be usable because of pixelisation
		
		
		// -------------------------------------------------- //
		//            ALLOCATE GD RESSOURCE
		// -------------------------------------------------- //
		$im     = imagecreatetruecolor($l, $t);
		$black  = ImageColorAllocate($im,0x00,0x00,0x00);
		$white  = ImageColorAllocate($im,0xff,0xff,0xff);
		
		$red    = ImageColorAllocate($im,0xff,0x00,0x00);
		$blue   = ImageColorAllocate($im,0x00,0x00,0xff);
		
		imagefilledrectangle($im, 0, 0, $l, $t, $white);
		
		// -------------------------------------------------- //
		//                      BARCODE
		// -------------------------------------------------- //
		$data = Barcode::gd($im, $black, $x, $y, $angle, $type, array('code'=>$code), $width, $height);
		
		// -------------------------------------------------- //
		//                    MIDDLE AXE
		// -------------------------------------------------- //
		if(isset($barcode['imageline']) && $barcode['imageline']==true){
			imageline($im, $x, 0, $x, $t, $red);
			imageline($im, 0, $y, $l, $y, $red);
		}
		
		if(isset($barcode['drawcross']) && $barcode['drawcross']==true){
			// -------------------------------------------------- //
			//                    USEFUL
			// -------------------------------------------------- //
			function drawCross($im, $color, $x, $y){
				imageline($im, $x - 10, $y, $x + 10, $y, $color);
				imageline($im, $x, $y- 10, $x, $y + 10, $color);
			}
			
			// -------------------------------------------------- //
			//                  BARCODE BOUNDARIES
			// -------------------------------------------------- //
			for($i=1; $i<5; $i++){
				drawCross($im, $blue, $data['p'.$i]['x'], $data['p'.$i]['y']);
			}
		}

		// -------------------------------------------------- //
		//                        HRI
		// -------------------------------------------------- //
		if ( isset($font) ){
		$box = imagettfbbox($fontSize, 0, $font, $data['hri']);
		$len = $box[2] - $box[0];
		Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
		imagettftext($im, $fontSize, $angle, $x + $xt, $y + $yt, $blue, $font, $data['hri']);
		}
		
		// -------------------------------------------------- //
		//                     ROTATE
		// -------------------------------------------------- //
		// Beware ! the rotate function should be use only with right angle
		// Remove the comment below to see a non right rotation
		/** /
		$rot = imagerotate($im, 45, $white);
		imagedestroy($im);
		$im     = imagecreatetruecolor(900, 300);
		$black  = ImageColorAllocate($im,0x00,0x00,0x00);
		$white  = ImageColorAllocate($im,0xff,0xff,0xff);
		$red    = ImageColorAllocate($im,0xff,0x00,0x00);
		$blue   = ImageColorAllocate($im,0x00,0x00,0xff);
		imagefilledrectangle($im, 0, 0, 900, 300, $white);

		// Barcode rotation : 90�
		$angle = 90;
		$data = Barcode::gd($im, $black, $x, $y, $angle, $type, array('code'=>$code), $width, $height);
		Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
		imagettftext($im, $fontSize, $angle, $x + $xt, $y + $yt, $blue, $font, $data['hri']);
		imagettftext($im, 10, 0, 60, 290, $black, $font, 'BARCODE ROTATION : 90�');

		// barcode rotation : 135
		$angle = 135;
		Barcode::gd($im, $black, $x+300, $y, $angle, $type, array('code'=>$code), $width, $height);
		Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
		imagettftext($im, $fontSize, $angle, $x + 300 + $xt, $y + $yt, $blue, $font, $data['hri']);
		imagettftext($im, 10, 0, 360, 290, $black, $font, 'BARCODE ROTATION : 135�');

		// last one : image rotation
		imagecopy($im, $rot, 580, -50, 0, 0, 300, 300);
		imagerectangle($im, 0, 0, 299, 299, $black);
		imagerectangle($im, 299, 0, 599, 299, $black);
		imagerectangle($im, 599, 0, 899, 299, $black);
		imagettftext($im, 10, 0, 690, 290, $black, $font, 'IMAGE ROTATION');
		/**/
		
		// -------------------------------------------------- //
		//                    GENERATE
		// -------------------------------------------------- //
		//header('Content-type: image/png');
		//imagepng($im);
		imagepng($im, 'assets/images/barcode/'.$nama.'.'.$ext);
		imagedestroy($im);
	}

    public function to_tcpdf($method='I', $file, $content, $header='', $footer='', $conf=null){
        $filename = str_replace('/', '-', str_replace(' ', '_', $file));
        if($conf==null){
            //'paper'=>array(200,100)
            $conf = array('mode'=>'utf-8','paper'=>'A4','font_size'=>0,'font_family'=>null,'left'=>15,'right'=>15,'top'=>10,'bottom'=>15,'header'=>0,'footer'=>5);
        }

        $pdf = new Pdf($conf['mode'],$conf['paper'],$conf['font_size'],$conf['font_family'],$conf['left'],$conf['right'],$conf['top'],$conf['bottom'],$conf['header'],$conf['footer']);
        $pdf->SetTitle($file);
        $pdf->SetMargins($conf['left'], $conf['top'], $conf['right'], true);
        $pdf->SetHeaderMargin($conf['header']);
        $pdf->setFooterMargin($conf['footer']);
        $pdf->SetAutoPageBreak(true, 0);
        $pdf->SetAuthor('Author');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();

        $pdf->WriteHTML($header, true, 0, true, 0);
        $pdf->WriteHTML($content, true, 0, true, 0);
        $pdf->WriteHTML($footer, true, 0, true, 0);

        $pdf->Output($filename.'.pdf', $method);
    }

	public function to_pdf($method='I', $file, $content, $header=null, $footer=null, $conf=null){
		if($conf==null){
			//'paper'=>array(200,100)
			$conf = array('mode'=>'utf-8','paper'=>'A4','font_size'=>0,'font_family'=>null,'left'=>15,'right'=>15,'top'=>15,'bottom'=>15,'header'=>5,'footer'=>5);
		}
		$this->pdf = new mPDF($conf['mode'],$conf['paper'],$conf['font_size'],$conf['font_family'],$conf['left'],$conf['right'],$conf['top'],$conf['bottom'],$conf['header'],$conf['footer']);
		$this->pdf->SetHTMLHeader($header);
        $this->pdf->WriteHTML($content);
        $this->pdf->SetHTMLFooter($footer);
		if(strtoupper($method) == 'I'){
			$pdfFilePath = str_replace('/', '-', str_replace(' ', '_', $file));
			$this->pdf->Output($pdfFilePath, "I"); //priview
		} else if(strtoupper($method) == 'D'){
			$pdfFilePath = str_replace('/', '-', str_replace(' ', '_', $file)).".pdf";
			$this->pdf->Output($pdfFilePath, "D"); //download
		} else if(strtoupper($method) == 'F'){
			$pdfFilePath = str_replace('/', '-', str_replace(' ', '_', $file)).".pdf";
			$this->pdf->Output($pdfFilePath, "F"); //save file
		}
	}

    public function to_excel($file, $data_header, $data_body){
        $file = explode('.', $file);
        $nama = $file[0];
        isset($file[1]) ? $ext=$file[1] : $ext='xlsx';
        $cols = array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',7=>'G',8=>'H',9=>'I',10=>'J',11=>'K',12=>'L',13=>'M',14=>'N',15=>'O',16=>'P',17=>'Q',18=>'R',19=>'S',20=>'T',21=>'U',22=>'V',23=>'W',24=>'X',25=>'Y',26=>'Z',27=>'AA',28=>'AB',29=>'AC',30=>'AD',31=>'AE',32=>'AF',33=>'AG',34=>'AH',35=>'AI',36=>'AJ',37=>'AK',38=>'AL',39=>'AM',40=>'AN');
        //$this->load->library('PHPExcel');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$nama.'.'.$ext.'"');
        header('Cache-Control: max-age=0');

        $objPHPExcel = new PHPExcel();
        $activeSheet = $objPHPExcel->getActiveSheet();
        $activeSheet->setTitle($nama);

        foreach($data_header as $row => $value){
            if($row == 'merge'){
                if(is_array($value)){ foreach($value as $set){ $activeSheet->mergeCells($set); } }
                else { $activeSheet->mergeCells($value); }
            } else if($row == 'auto_size'){
                if($value == true){ foreach($cols as $col){ $activeSheet->getColumnDimension($col)->setAutoSize(true); } }
            } else if($row == 'font' || $row == 'alignment'){
                foreach($value as $cell => $set){ $activeSheet->getStyle($cell)->applyFromArray(array($row => $set)); }
            } else if(is_array($value)){
                $i = $row;
                foreach($value as $col => $cell){
                    $activeSheet->setCellValue($col.$row, $cell);
                }
            }
        }
        foreach($data_body as $row => $value){
            $col = 0;
            foreach($value as $values => $cell){ $col++;
                $rows = $row + $i + 1;
                if(file_exists("./".$cell) && $cell != '')
                {
                    $objDrawing = new PHPExcel_Worksheet_Drawing();
                    $objDrawing->setPath("./".$cell);
                    $objDrawing->setCoordinates($cols[$col].$rows);
                    $objDrawing->setWorksheet($activeSheet);
                    $objDrawing->setHeight(80);
                    $objDrawing->setOffsetX(10);
                    $objDrawing->setOffsetY(10);
                    $activeSheet->getRowDimension($rows)->setRowHeight(80);
                    $activeSheet->getColumnDimension($cols[$col])->setWidth(20);
                } else {
                    $activeSheet->setCellValue($cols[$col].$rows, $cell);
                }
            }
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        //$objWriter->save('files/contoh.xlsx');
        exit;
    }
	

}
