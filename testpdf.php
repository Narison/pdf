<html>
<head>
<title>Prosoft Test</title>
</head>
<body>
<?php

	require('fpdf.php');

	define('FPDF_FONTPATH','font/');

	  $connectstr_dbhost = 'db4free.net:3307';
	  $connectstr_dbname = 'esslinebot';
	  $connectstr_dbusername = 'weatherzilla';
	  $connectstr_dbpassword = '12345678';

  $link = mysqli_connect($connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword,$connectstr_dbname);

  if (!$link) {
      echo "Error: Unable to connect to MySQL." . PHP_EOL;
      echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
      echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
      exit;
  }
  mysqli_set_charset($link, "utf8");

  return $link;
}
$sql = "SELECT * FROM employee ";
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {

	class PDF extends FPDF
	{
		function Header(){
			$this->Image('prosoft.jpg',87,0,40);
			$this->AddFont('angsa','','angsa.php');
			$this->SetFont('angsa','',15);
	 		$this->Cell(0,0,iconv( 'UTF-8','TIS-620','หน้าที่... '.$this->PageNo()),0,1,"R");
			$this->Ln(20);
		}

		function Footer(){
			$this->AddFont('angsa','','angsa.php');
			$this->SetFont('angsa','',10);
			$this->SetY(-15);
	 		$this->Cell(0,0,iconv( 'UTF-8','TIS-620','By... Narison'),0,1,"L");
			$this->Cell(0,0,iconv( 'UTF-8','TIS-620','Create date : '.date("Y-m-d")),0,1,"R");
		}

	}

	$pdf=new PDF();
	$pdf->SetMargins( 5,5,5 );
	$pdf->AddPage();
	$pdf->AddFont('angsa','','angsa.php');
	$pdf->SetFont('angsa','',15);

	for( $i=0;$i<=1;$i++ ){
		$pdf->Cell(0,10,iconv( 'UTF-8','TIS-620',.$row['emcode'], .$i),0,1,"C");
	}

	$pdf->Output("MyPDF/MyPDF.pdf","F");

	}
}
?>
	PDF Created Click <a href="MyPDF/MyPDF.pdf">here</a> to Download
</body>
</html>
