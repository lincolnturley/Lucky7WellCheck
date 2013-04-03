<?php 
include_once 'header.php';


class NewTestResult
{
	private $testResult;
	private $userid;
	private $da;
    
	public function __construct($tr, $u)
	{
		$this->testResult = $tr;
		$this->userid = strtoupper($u);
		$this->da = new DataAccess();
	}


	public function upload()
	{
		$con = $this->da->getCon();
		$tempDate = $this->testResult->getDate()->format('Y-m-d');
		$tempBPS = $this->testResult->getBPSystolic();
		$tempBPD = $this->testResult->getBPDiastolic();
		$tempBS = $this->testResult->getBloodSugarLevel();
		$tempWeight = $this->testResult->getWeight();
		mysqli_query($con, "INSERT INTO testresults (trpatientid, trdate, trbpsystolic, trbpdiastolic, trbloodsugarlevel, trweight)
			VALUES ('$this->userid', '$tempDate', '$tempBPS','$tempBPD', '$tempBS', '$tempWeight')");
	}

}
?>
