<?php
include_once("header.php");
/**
 * Description of Appointment
 * date Date
 * time String
 * status String
 * doctor Doctor
 * patient Patient
 *
 * @author Taylor
 */
class Appointment {
    private $date;
    private $time;
    private $status;
    private $doctorId;
    private $doctorName;
    private $patientId;
    private $patientName;
    private $dataAccess;

    //constructor
    public function __construct($newApArray)
    {
      $this->date = "";
      $this->time = "";
      $this->status = "";
      $this->doctorId = "";
      $this->doctorName = "";
      $this->patientId = "";
      $this->patientName = "";
      $this->DA = new DataAccess();
      
      if (isset($newApArray["date"]))
        $this->date = $newApArray["date"];
      
      if (isset($newApArray["time"]))
        $this->time = $newApArray["time"];
      
      if (isset($newApArray["status"]))
        $this->status = $newApArray["status"];
      
      if (isset($newApArray["doctorId"]))
        $this->doctorId = $newApArray["doctorId"];
      
      if (isset($newApArray["doctorName"]))
        $this->doctorName = $newApArray["doctorName"];
      
      if (isset($newApArray["patientId"]))
        $this->patientId = $newApArray["patientId"];
      
      if (isset($newApArray["patientName"]))
        $this->patientName = $newApArray["patientName"];
      
    }

    //#####################################################
    //GETTER FUNCTIONS
    //#####################################################
    public function getDate(){ return $this->date; }
    public function getTime(){ return $this->time; }
    public function getStatus(){ return $this->status; }
    public function getDoctorId(){ return $this->doctorId; }
    public function getDoctorName(){ return $this->doctorName; }
    public function getPatientId(){ return $this->patientId; }
    public function getPatientName(){ return $this->patientName; }

    //####################################################
    //SETTER FUNCTIONS
    //####################################################
    public function setDate($newDate)
    { $this->date = $newDate; }
    public function setTime($newTime)
    { 
        $this->time = $newTime;
    }
    public function setStatus($newStatus)
    { 
        $this->status = $newStatus;
    }
    public function setDoctorId($newDoctorId)
    { 
        $this->doctorId = $newDoctorId;
    }
    public function setDoctorName($newDoctorName)
    { 
        $this->doctorName = $newDoctorName;
    }
    public function setPatient($newPatientID)
    { $this->patientId = $newPatientID; }
    
    public function setPatientName($newPatientName)
    { $this->patientName = $newPatientName; }
    
    public function storeAppointment()
    {
      //should consider checking for an existing appointment before saving  
      $con = $this->DA->getCon();
        $query = "INSERT INTO appointments (apdate, aptime, apstatus, apdoctorid, apdoctorname, appatientid, appatientname)
                  VALUES ('".date('Y-m-d', strtotime($this->date))."', '$this->time', 'Future', '$this->doctorId', '$this->doctorName', '$this->patientId', '$this->patientName')";
        $result = $con->query($query);
    }
    
    public function getAppointment()
    {
        $con = $this->DA->getCon();
        $query = "SELECT * FROM appointments WHERE apdate='$this->date' AND aptime='$this->time' AND apdoctorid='$this->doctorId'";                  
        $result = $con->query($query);
        if($result->num_rows >0)
        {
          $row = mysqli_fetch_array($result);
          $this->patientName = $row['appatientname'];
        }
        else
        {
          $this->patientName = "-";
        }
    }   
    
    public function toString()
    {
        return "date = ".$this->date->format("Y-m-d")."<br>
        Time = $this->time<br>  		
        Status = $this->status<br>
        DoctorId = $this->doctorId<br>
        DoctorName = $this->doctorName<br>
        PatientId = $this->patientId<br>
        PatientName = $this->patientName<br>";
    }


}

?>
