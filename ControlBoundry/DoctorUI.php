<?php
include_once("header.php");
/**
 * Description of DoctorUI
 *
 * @author Lincoln
 */
class DoctorUI 
{
  private $tb1Schedule;
  private $tb1lblSearchDate;
  private $tb1btnSearch;
  
  private $tb2PatientInfo;
  private $tb2lblSearchDate;
  private $tb2btnSearch;
  private $tb2btnEdit;
  private $tb2btnAddNewResult;
  
  private $tb3Memos;
  private $tb3lblDoctorMemos;
  private $tb3lblPatientMemos;

  private $tb4CreateEditUser;
  
  private $PSC;
  
  public function __construct($doc)
  {
    $this->tb1Schedule = "Schedule";
    $this->tb1lblSearchDate = "Search Date: ";
    $this->tb1btnSearch = "Search";

    $this->tb2PatientInfo = "Patient Info";
    $this->tb2lblSearchDate = "Search Date: ";
    $this->tb2btnSearch = "Search";
    $this->tb2btnEdit = "Edit";
    $this->tb2btnAddNewResult = "Add New Test Result";

    $this->tb3Memos = "Memos";
    $this->tb3lblDoctorMemos = "Doctor Memos";
    $this->tb3lblPatientMemos = "Patient Memos";
    
    $this->tb4CreateEditUser = "Create/Edit User";
    
    $this->PSC = new PatientSelectControl();
    
    echo "
    <tr>
      <td colspan='2'>
      <div id='tabs'>
      <ul>
        <li><a href='#tabs-1'>$this->tb1Schedule</a></li>
        <li><a href='#tabs-2'>$this->tb2PatientInfo</a></li>
        <li><a href='#tabs-3'>$this->tb3Memos</a></li>
        <li><a href='#tabs-4'>$this->tb4CreateEditUser</a></li>
      </ul>
      <div id='tabs-1'>    
        <table class='schedule' border='1'>
          <tr>
            <th>Date</th>
            <th>8 am</th>
            <th>9 am</th>
            <th>10 am</th>
            <th>11 am</th>
            <th>12 pm</th>
            <th>1 pm</th>
            <th>2 pm</th>
            <th>3 pm</th>
            <th>4 pm</th>
          </tr>";
  for($days = 0; $days<3; $days +=1)
  {
    //display schedule in table
    if(isset($_GET['date']))
    {
      //$date = new DateTime($_GET['date']); 
      $date = date('Y-m-d', strtotime($_GET['date']));
      //$date->modify('+1 day');
      $date = date('Y-m-d',  strtotime($date.' +1 day'));
    }
    else {
      $plural ='';
      if($days != 1)
        $pluras = 's';
      $date = date('Y-m-d', strtotime('today'));
      $date = date('Y-m-d',  strtotime($date." +$days day".$plural));
    }

    echo '<tr>
             <td>'.$date.'</td>';

    for($loop = 8; $loop < 17; $loop+=1)
    {
      if($loop > 12)
      {
        $hour = ($loop - 12).":00";
        $timeLabel = "PM";
      }
      else
      {
        $hour = $loop.":00";
        $timeLabel = "AM";    
      }
      if($loop == 12)
        $timeLabel = "PM";

     $appointment = array("date"=>"$date", "time"=>$hour." ".$timeLabel, "doctorId"=>$doc->getUserId());
     $test = new Appointment($appointment);
     $test->getAppointment();
     echo '<td align="center">'.$test->getPatientName().'</td>';
     
    }
  echo "</tr>";
  }
 echo"  </table>
   <br>
   <table>
   <tr align='center'>
       <form action='home.php' method='get'>
          <label for='datesearch'>$this->tb1lblSearchDate</label>
          <input id='datesearch' name='date'/>
          <input type='submit' value='$this->tb1btnSearch'/>
       </form>
   </tr>
</table>"; 

 echo "</div>";
  //search form
  echo "<div id='tabs-2'>";
        if (!isset($_POST['txtboxPatientInfo']))
        {
          echo "Please select a patient using the serach box above...";
        }
        else
        {
          //takes the value from the search box and grabs the userID
          $str_Pattern = '/[^ ]*$/';
          preg_match($str_Pattern, $_POST['txtboxPatientInfo'], $result); 
          $activePatient = $result[0];
          echo"
            <table>
              <tr>
                <th>Date</th>
                <th>Blood Pressure</th>
                <th>Sugar Level</th>
                <th>Weight</th>
                <th>Exercise</th>
              </tr>
              <tr>
              </tr>
            ";
          
        }
  
        
      echo "</div>
      <div id='tabs-3'>
        Memos here
      </div>
      <div id='tabs-4'>
        Create Edit User Here
      </div>
    </div></td>
    </tr>";
/*
    $today = "2013-03-31"; 
    
 $aptmntArray = array("date"=>"$today", "time"=>"4:00 PM", "status"=>"Future", "doctorId"=>777, 
                      "doctorName"=>"Bob", "patientId"=>994, "patientName"=>"Green Man");
 $test = new Appointment($aptmntArray);
 $test->storeAppointment();
 */
  }
}

?>