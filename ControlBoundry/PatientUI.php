<?php 
include_once("header.php");
/**
 * Description of PatientUI
 *
 * @author Lincoln
 */
class PatientUI 
{
    private $tb1TestResults;
    private $tb1lblSearchDate;
    private $tb1btnSearch;
    private $tb1btnEnterNewResult;
    private $tb2Appointments;
    private $tb2lblCurrentAppointments;
    private $tb2lblAvailableAppointments;
    private $tb2btnSearch;
    private $tb2btnCancelAppointment;
    private $tb2btnScheduleAppointment;
    private $tb3Memos;
    private $tb4Prescriptions;
	
  public function __construct($pat)
  {
      $this->tb1TestResults = "Test Results";
      $this->tb1lblSearchDate = "Search Date";
      $this->tb1btnSearch = "Search";
      $this->tb1btnEnterNewResult = "Enter New Results";
        
      $this->tb2Appointments = "Appointments";
      $this->tb2lblCurrentAppointments = "Current Appointments";
      $this->tb2lblAvailableAppointments = "Schedule Appointment";
      $this->tb2btnSearch = "Search";
      $this->tb2btnCancelAppointment = "Cancel Appointment";
      $this->tb2btnScheduleAppointment = "Schedule Appointment";
      
      $this->tb3Memos = "Memos";
      
      $this->tb4Prescriptions = "Prescriptions";
    //Sets up the table for the UI
    echo "
     <tr>
        <td colspan='2'>
        <div id='tabs'>
        <ul>
            <li><a href='#tabs-1'>$this->tb1TestResults</a></li>
            <li><a href='#tabs-2'>$this->tb2Appointments</a></li>
            <li><a href='#tabs-3'>$this->tb3Memos</a></li>
            <li><a href='#tabs-4'>$this->tb4Prescriptions</a></li>
  </ul>";
    //first tab of the table
  echo "<div id='tabs-1'>";
    
    $testResults = $pat->getTestResults(date_create("0000-00-00"));
    
    $numTestResults = count($testResults);
    //display the test results
    if($numTestResults < 1)
        echo "No test results entered. <br>
            press the button bellow to enter test resutls";
    else
    {
        echo "<table border = '1'>
            <tr>
            <td>Date</td>
            <td>Blood Pressure Systolic</td>
            <td>Blood Pressure Diastolic</td>
            <td>Sugar Level</td>
            <td>Weight</td>
            </tr>";
        for($i = 0; $i < $numTestResults; $i++)
        {
            $tempTestResult = $testResults[$i];
            $tempDate = $tempTestResult->getDate()->format('m-d-Y');
            $tempBPSystolic = $tempTestResult->getBPSystolic();
            $tempBPDiastolic = $tempTestResult->getBPDiastolic();
            $tempBSlevel = $tempTestResult->getBloodSugarLevel();
            $tempWeight = $tempTestResult->getWeight();
            echo "<tr>
                    <td>$tempDate</td>
                    <td>$tempBPSystolic</td>
                    <td>$tempBPDiastolic</td>
                    <td>$tempBSlevel</td>
                    <td>$tempWeight</td>
                 </tr>";
        }
        echo "</table>";
        //Enter new test result button and dialog box
        $tempBPS = 0;
        $tempBPD = 0;
        $tempW = 0;
        $tempBS = 0;
        
        echo "<script> 
                $(function(){
                    $( '#New-result-field' ).dialog({
                        autoOpen: false,
                        height: 345,
                        width: 250
                    });
                    $( '#create-result' ).click(function() {
                        $( '#New-result-field' ).dialog( 'open' );
                    });
                  });
              </script>
                <div id='New-result-field' title='Enter new results'>
                    <form name = 'input' action = 'home.php' method = 'post'>
                        <label for = 'inputBPS' >Blood Pressure Systolic:</label><input type = 'text' name = 'inputBPS' id = 'inputBPS' class='text ui-widget-content ui-corner-all'><br>
                        <label for = 'inputBPD' >Blood Pressure Diastolic:</label><input type = 'text' name = 'inputBPD' id = 'inputBPD' class='text ui-widget-content ui-corner-all'><br>
                        <label for = 'inputSugarLevel' >Sugar Level:</label><input type = 'text' name = 'inputSugarLevel' id = 'inputSugarLevel' class='text ui-widget-content ui-corner-all'><br>
                        <label for = 'inputWeight' >Weight:</label><input type = 'text' name = 'inputWeight' id = 'inputWeight' class='text ui-widget-content ui-corner-all'><br>
                        <input type = 'submit' value = 'enter test result'>
                    </form>
                </div>
                <button id='create-result'>Enter new result</button>";
    }       
    echo "</div>";
    
    //tab 2 appointments
    echo "<div id='tabs-2'>";
    
    $tempAppointments = $pat->getAppointments();
    
    $numTempAppointments = count($tempAppointments);
    
    if($numTempAppointments < 1)
        echo "No appointments";
    else
    {
        echo "<table border = '1'>
            <tr>
                <td>Date</td>
                <td>Time</td>
                <td>Status</td>
            </tr>";
        for($i = 0; $i < $numTempAppointments; $i++)
        {
            $tempAppointment = $tempAppointments[$i];
            $tempDate = $tempAppointment->getDate()->format('m-d-Y');
            $tempTime = $tempAppointment->getDate()->format('H:i');
            $tempStatus = $tempAppointment->getStatus();
            
            echo "<tr>
                    <td>$tempDate</td>
                    <td>$tempTime</td>
                    <td>$tempStatus</td>";
        }
        echo "</table>";
    }
            
  echo "</div>";
       
  //tab 3 memos
  echo "<div id='tabs-3'>";
  
  $tempMemos = $pat->getMemos();
  
  $numTempMemos = count($tempMemos);
  
  if($numTempMemos < 1)
      echo "There are no Memos";
  else
  {
      echo "<table border = '1'>
          <tr>
            <td>Date</td>
            <td>Notes</td>
          </tr>";
      for($i = 0; $i < $numTempMemos; $i++)
      {
          $tempMemo = $tempMemos[$i];
          $tempDate = $tempMemo->getDate()->format('m-d-Y');
          $tempNote = $tempMemo->getNote();
          echo "<tr>
                  <td>$tempDate</td>
                  <td>$tempNote</td>
                </tr>";
      }
      echo "</table>";
  }
    echo "</div>";
  
    //tab 4 prescriptions
    echo "<div id='tabs-4'>";
    
    $tempPrescriptions = $pat->getPrescriptions();
    
    $numTempPrescriptions = count($tempPrescriptions);
    
    if($numTempPrescriptions < 1)
        echo "No prescriptions";
    else
    {
        echo "<table border = '1'>
            <tr>
                <td>Medication</td>
                <td>Dosage</td>
                <td>Use Until</td>";
        for($i = 0; $i < $numTempPrescriptions; $i++)
        {
            $tempPrescription = $tempPrescriptions[$i];
            $tempMedication = $tempPrescription->getDrugName();
            $tempDosage = $tempPrescription->getDosage();
            $tempEndDate = $tempPrescription->getExpireDate()->format('m-d-Y');
            
            echo "<tr>
                    <td>$tempMedication</td>
                    <td>$tempDosage</td>
                    <td>$tempEndDate</td>
                  </tr>";
        }
        echo "</table>";
    }
    echo "</div></td></tr>";
    
    

  }
}

?>
