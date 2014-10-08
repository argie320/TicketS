<?php

include("init.php");
require("htmlToPDF.php");

$pullout_remarks ="";

$itemDetails = "";
$pulloutType="";
$pulloutNo="";
$workNo="";
$preparedBy="";
$pulloutDate="";
$fullname="";
$c_logo="";
$pulloutCHK="";
$custcode = "";
	$CustomerName = "";
	$EmailAddress = "";
	$ContactNumber = "";
	$FaxNo = "";
	$Address = "";
	$ContactPerson = "";

	$source = "";
	$department = "";
	$HelpTopic = "";
	$priority = "";
	$SLAPlan = "";
	$duedate  = "";
	$duetime = "";
	$assignto ="";
	$company = "";
	$Reference = "";

	$item = "";
	$Unit_Brand = "";
	$Unit_Model = "";
	$Machine_Serial_No = "";
	$Part_No_Quantity = "";
	$Quantity = "";
	$Warranty = "";
	$sv_number = "";

	$subject = "";
	$issue  = "";
	$details = "";
	$remarks  = "";

	$attachment = "";



$tabledata ="";

if(isset($_GET['id'])&& isset($_GET['log'])){

	$id=  preg_replace('#[^0-9]#i', '' , stripslashes( strip_tags( trim(  $_GET['id'] ) )));
    $log=  preg_replace('#[^0-9]#i', '' , stripslashes( strip_tags( trim(  $_GET['log'] ) )));

	$result =DB::getInstance()->prepare("SELECT DISTINCT *
FROM `tbcustomer` INNER JOIN sv_ticket_header ON tbcustomer.sv_number = sv_ticket_header.sv_number
INNER JOIN sv_ticket_details ON tbcustomer.sv_number = sv_ticket_details.sv_number
INNER JOIN sv_ticket_details_attachment ON tbcustomer.sv_number = sv_ticket_details_attachment.sv_number
INNER JOIN sv_ticket_item_details ON tbcustomer.sv_number = sv_ticket_item_details.sv_number
INNER JOIN wo_ticket_details ON tbcustomer.sv_number = wo_ticket_details.sv_number
INNER JOIN tb_pullout ON tbcustomer.sv_number = tb_pullout.sv_number

INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email
WHERE tbcustomer.sv_number = ? AND sv_ticket_item_details.sv_number = ? AND tb_pullout.log=?");
  $result->execute(array($id,$id,$log));

  //	$result = mysqli_query($dbc, $sql);
	echo $loginSuccess = FALSE;

	if($result->rowCount()){

         while ($row = $result->fetch(PDO::FETCH_ASSOC)) {



				$custcode = $row['customer_snum'];
				$CustomerName = $row['customer_name'];
				$EmailAddress = $row['customer_email'];
				$ContactNumber = $row['customer_cnum'];
				$FaxNo = $row['customer_fnum'];
				$Address = $row['customer_baddr'];
				$ContactPerson = $row['customer_contact'];
			    $company = $row['customer_company'];

				$source  = $row['source'];
				$department = $row['department'];
				$HelpTopic = $row['help_topic'];
				$priority = $row['priority'];
				$SLAPlan = $row['slaplan'];
				$duedate = $row['duedate'];
				$duetime= $row['duetime'];
				$assignto = $row['assignto'];
				$Reference = $row['reference'];

				$item = $row['item'];
				$Unit_Brand = $row['Unit_Brand'];
				$Unit_Model = $row['Unit_Model'];
				$Machine_Serial_No = $row['Machine_Serial_No'];
				$Part_No_Quantity = $row['Part_No_Quantity'];
				$Quantity = $row['Quantity'];
				$Warranty = $row['Warranty'];
				$sv_number = $row['sv_number'];

				$ticketTimeCreated = $row['time_created'];
				$ticketDateCreated = $row['date_created'];


                $workNo = $row['work_number'];
                $pulloutType = $row['pullout_type'];
                $preparedBy = $row['preparedBy'];
                $pulloutDate = $row['pulloutDate'];
	
	$pullout_remarks = $row['pullout_remarks'];
	
	
				$pulloutNo = $row['pulloutNo'];

                $fullname = $row['fullname'];

				$attachment = $row['attachment'];
             // $data .= "$source $assignto $subject $issue $remarks $department $company $duedate";
                                //echo  $data;

			}

 	

	}else{ echo "No Record"; }	


		 $qry2 = DB::getInstance()->prepare("SELECT * FROM sv_ticket_details WHERE sv_number = ? AND log_ID = ?");
$qry2->execute(array($id,$log));
	if($qry2->rowCount()){
         while ($row = $qry2->fetch(PDO::FETCH_ASSOC)) { 
		         $subject = $row['subject'];
				 $issue = $row['issue'];
				 $remarks = $row['remarks'];
				}}else{ echo "No Record"; }	




$ItemDetailsClass = new ItemDetails();

$itemDetailsResult = DB::getInstance()->query(" SELECT * FROM sv_ticket_item_details  WHERE sv_number = ".$id."");

while($row = $itemDetailsResult->fetch()){

    $ItemDetailsClass->addDetails($row['item'], $row['Unit_Brand'],$row['Unit_Model'],$row['Machine_Serial_No'],$row['Part_No_Quantity'],$row['Quantity'],$row['Warranty'],$row['sv_number']);

}

$items =  $ItemDetailsClass->Unit_Brand;

$itemDetails ='';

$itemBrand='';
$itemModel='';
$itemSerial='';
$itemPart='';
$itemWarranty='';
for($i = 0;  $i < sizeof($items); $i++){

   //$itemDetails .= '
                     $itemBrand.= ''.$ItemDetailsClass->Unit_Brand[$i].'';
					 $itemModel.=''.$ItemDetailsClass->Unit_Model[$i].'';
					 $itemSerial.= ''.$ItemDetailsClass->Machine_Serial_No[$i].'';
				     $itemPart.=''.$ItemDetailsClass->Part_No_Quantity[$i].'';
				     $itemWarranty.= ''.$ItemDetailsClass->Warranty[$i].'';
       //     ';
}


}

if($pulloutNo==0){
	     echo '<script type="text/javascript">'; 
		 echo "alert('Ticket number $id has no pulloutslip issued');"; 
         echo 'window.location.href = "myworkorder.php" </script>;';
}else{

// Begin configuration

$textColour = array( 0, 0, 0 );
$headerColour = array( 100, 100, 100 );
$tableHeaderTopTextColour = array( 255, 255, 255 );
$tableHeaderTopFillColour = array( 125, 152, 179 );
$tableHeaderTopProductTextColour = array( 0, 0, 0 );
$tableHeaderTopProductFillColour = array( 143, 173, 204 );
$tableHeaderLeftTextColour = array( 99, 42, 57 );
$tableHeaderLeftFillColour = array( 184, 207, 229 );
$tableBorderColour = array( 50, 50, 50 );
$tableRowFillColour = array( 213, 170, 170 );
$reportName = "2009 Widget Sales Report";
$reportNameYPos = 160;
$logoFile = " ";
$logoXPos = 50;
$logoYPos = 108;
$logoWidth = 110;
$columnLabels = array( "Machine/Part No.", "Serial No.","Warranty" );
$line = array(" "," "," "," ");
$rowLabels = array( "SupaWidget", "WonderWidget", "MegaWidget", "HyperWidget" );
$chartXPos = 20;
$chartYPos = 250;
$chartWidth = 160;
$chartHeight = 80;
$chartXLabel = "Product";
$chartYLabel = "2009 Sales";
$chartYStep = 20000;

$chartColours = array(
                  array( 255, 100, 100 ),
                  array( 100, 255, 100 ),
                  array( 100, 100, 255 ),
                  array( 255, 255, 100 ),
                );

$data = array($ItemDetailsClass->Unit_Brand,
              $ItemDetailsClass->Unit_Model,
			  $ItemDetailsClass->Machine_Serial_No,
			  $ItemDetailsClass->Part_No_Quantity,
			  $ItemDetailsClass->Warranty
        );

// End configuration


////////////////////////////////////////////////////////


$pdf = new PDF('P','mm','A4');
$pdf->AddPage();
$pdf->AliasNbPages();     
//$pdf->SetFontSize(11);

///////// header ////////////////////////////
switch($company){
       case'Forefront Innovative Technologies Inc.': 
	        $c_logo ="images/logo_fit.jpg";
	   break;
	    case'Stead Fast Solutions Inc.': 
		    $c_logo ="images/logo_steadfast.jpg";
		break;
		 default: 
		     $c_logo ="images/logo_jump.jpg";
		 break;
}




	$pdf->Image($c_logo,10,6,60,0);
    // Arial bold 15
    $pdf->SetFont('Arial','B',15);
    // Move to the right
    $pdf->Cell(78);
    // Title
    $pdf->write(40,"PULLOUT SLIP");
    // Line break
    $pdf->Ln(30);

// generate pullout //
if($pulloutNo==""){
	$pulloutCHK=rand(1,999999);	
}else{
	$pulloutCHK=$pulloutNo;
}
$pdf->SetFont( 'Arial', '', 10 );
$pdf->SetDrawColor(255,255,255);
$pdf->Cell( 150, 5,"", 1, 0, 'C');
$pdf->Cell( 20, 5, "Pullout No. :", 1, 0, 'L');
$pdf->Cell( 20, 5, $pulloutCHK, 1, 0, 'C');
$pdf->Ln( 5 );

// LINE //
$pdf->SetDrawColor(0,0,0);
for ( $i=0; $i<count($line); $i++ ) {
 $pdf->Cell( 47.5, 0, $line[$i], 1, 0, 'C', true );
}

$pdf->Ln( 8 );
$pdf->SetFont( 'Arial', '', 10 );
$pdf->SetDrawColor(255,255,255);
$pdf->SetTextColor(0,0,0);
 $pdf->Cell( 30, 6, "Ticket No. :", 1, 0, 'L');
  $pdf->Cell( 55, 6, ($sv_number), 1, 0, 'L');
    $pdf->Cell( 35, 6, " ", 1, 0, 'L');
$pdf->CellFitScale(70,6," ",1,1);
$pdf->Ln( 2 );
  $pdf->Cell( 30, 6, "Pullout Type :", 1, 0, 'L');
  $pdf->Cell( 55, 6, ($pulloutType), 1, 0, 'L');
    $pdf->Cell( 35, 6, "WorkOrder No. :", 1, 0, 'L');
$pdf->CellFitScale(70,6,$workNo,1,1);
	$pdf->Ln( 2 );
  $pdf->Cell( 30, 6, "Customer Name :", 1, 0, 'L');
  $pdf->Cell( 55, 6, ($CustomerName), 1, 0, 'L');
    $pdf->Cell( 35, 6, "Email Address :", 1, 0, 'L');
    $pdf->Cell( 70, 6,$EmailAddress, 1, 0, 'L');
$pdf->Ln( 8 );
  $pdf->Cell( 30, 6, "Fax No. :", 1, 0, 'L');
  $pdf->Cell( 55, 6, ($FaxNo), 1,'L');
    $pdf->Cell( 35, 6, "Contact Person :", 1,0,'L');
    $pdf->CellFitScale( 70, 6,$ContactPerson, 1,1);
	  $pdf->Ln( 2 );
  $pdf->Cell( 30, 6, "Contact No. :", 1, 0, 'L');
  $pdf->Cell( 55, 6, ($ContactNumber), 1,'L');

    $pdf->Cell( 35, 6, "Company Address :", 1,0,'L');
    $pdf->MultiCell( 70, 6, ($Address), 1,'L');

/**
  Create the table
**/

$pdf->SetDrawColor( $tableBorderColour[0], $tableBorderColour[1], $tableBorderColour[2] );
$pdf->Ln( 8 );

// Create the table header row
$pdf->SetFont( 'Arial', 'B', 11 );
// Remaining header cells

$pdf->SetTextColor( $tableHeaderTopTextColour[0], $tableHeaderTopTextColour[1], $tableHeaderTopTextColour[2] );
 $pdf->Cell( 30, 5,"Unit Brand",1, 0, 'C', true );
 $pdf->Cell( 46, 5,"Unit Model",1, 0, 'C', true );
for ( $i=0; $i<count($columnLabels); $i++ ) {
 $pdf->Cell(38, 5, $columnLabels[$i], 1, 0, 'C', true );
}

$pdf->Ln( 8 );
// Create the table data rows

$pdf->SetFont('Arial','',9);
$pdf->SetTextColor(0,0,0);

 $pdf->CellFitScale( 30, 5,$itemBrand, 1,0, 'C');
 $pdf->CellFitScale( 46, 5, ($itemModel), 1,  'C');
 $pdf->CellFitScale( 38, 5, ($itemSerial), 1, 'C');
 $pdf->CellFitScale( 38, 5, ($itemPart), 1, 'C');
 $pdf->Cell( 38, 5, ($itemWarranty), 1,  'C');
///// problems encounter ////////////////

    $pdf->Ln(10);

$pdf->SetDrawColor( $tableBorderColour[0], $tableBorderColour[1], $tableBorderColour[2] );
$pdf->Ln( 8 );
$pdf->SetTextColor(0,0,0);
  $pdf->Cell( 190, 5,"Problem Encountered", 1, 0, 'C');
  $pdf->Ln( 8 );
$pdf->SetDrawColor(255,255,255);
$pdf->SetFont( 'Arial', '', 10 );
 $pdf->MultiCell( 190, 5,$issue, 1,'C');            

///////////// remarks /////////////////

$pdf->SetDrawColor( $tableBorderColour[0], $tableBorderColour[1], $tableBorderColour[2] );
$pdf->Ln( 8 );
$pdf->SetTextColor(0,0,0);
  $pdf->Cell( 190, 5,"Remarks", 1, 0, 'C');
$pdf->Ln( 8 );
$pdf->SetDrawColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont( 'Arial', '', 10 );
 $pdf->MultiCell( 190, 5,$pullout_remarks, 1,'C');            
  $pdf->Ln(30);
//////////////// acknowlegement /////////////////

$pdf->SetFont( 'Arial', '', 10 );
$pdf->Write( 6, "Prepared By : ".$preparedBy."");
    $pdf->Ln(10);
$pdf->Write( 6,"Date : ".$pulloutDate."");
    $pdf->Ln(10);
$pdf->Write( 6, "Pullout By : ".$fullname."");
 $pdf->Ln(30);
    $pdf->Cell(100, 0,'',0,0,'C');
	$pdf->Write( 6, "Acknowledge By : _____________________________");
	$pdf->Ln(5);
	$pdf->Cell(135, 0,'',0,0,'C');
	$pdf->Write( 6,"Printed Name and Signature");
            $pdf->Ln(10);

$pdf->Output();

}
?>
