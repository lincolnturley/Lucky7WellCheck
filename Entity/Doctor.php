<?php
include_once("header.php");
/**
 * Description of Doctor
 *
 * appointments     Appointment[]
 * 
 * @author Taylor
 */
class Doctor extends User {
    //Attributes
    
    private $appointments;

   
     /**
    * Creates a new Doctor object
    * 
    * @param array $newDoctorArray  
    * 
    * array containing indices
    * userid, password, fname, lname, birthdate, activeUser, boolean,
    * appointments
    * @return Doctor 
    */
    public function __construct($newDoctorArray)
    {
        parent::__construct($newDoctorArray);
        
        $this->appointments = array();
        if (isset($newDoctorArray["appointments"]))
          $this->appointments = $newDoctorArray["appointments"];
       
    }
    
    //#####################################################
    //GETTER FUNCTIONS
    //#####################################################
    
    public function getDoctorSchedule(){ return $this->appointments; }
    
    
    public function toString()
    {
        $rtnVal = parent::toString();

        
        $rtnVal .= "<br>SCHEDULE<br>";
        $len_app = count($this->appointments);
        for($i = 0;$i<$len_app;$i++)
        {
            if(isset($this->appointments[$i]))
            $rtnVal .= $i.": ".$this->appointments[$i]->toString()."<br>";
        }
        return $rtnVal;
    }
}

?>
