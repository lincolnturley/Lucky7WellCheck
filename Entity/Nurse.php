<?php
include_once("header.php");
/**
 * Nurse                    Class              
 * hasManagerAuthorization  bool
 * doctorId1                String
 * doctorId2                String
 * doctorId3                String
 * doctorId4                String
 * @author Dillan
 */
class Nurse extends User{
    //Attributes 
    private $hasManagerAuthorization;
    private $doctors;
    
    /**
     * Creates a new Nurse Object
     * 
     * @param Array newNurseArray array containing
     * userid String
     * password String
     * fname String
     * lname String
     * birthdate Date
     * activeUer bool
     * hasManagerAuthorization bool
     * doctors Doctor
     * @return Nurse
     */
    
    public function __construct($newNurseArray)
    {
        parent::__construct($newNurseArray);
        
        $this->hasManagerAuthorization = FALSE;
        $this->doctors = array();
        
        if (isset($newNurseArray["hasManagerAuthorization"]))
          $this->hasManagerAuthorization = $newNurseArray["hasManagerAuthorization"];
        
        if (isset($newNurseArray["doctors"]))
          $this->doctors = $newNurseArray["doctors"];
    }
    
    //##############################
    //Getter Functions
    //##############################
    public function getManagerAuthorization(){return $this->hasManagerAuthorization;}
    public function getDoctors(){return $this->doctors;}
    
    //##############################
    //Setter functions
    //##############################
    public function addDoctor($newDoctor)
    {
      $len_docs = count($this->doctors);
      $this->results[$len_docs] = $newDoctor;
    }
    
    public function setManagerAuthorization($newAuthorization){$this->hasManagerAuthorization = $newAuthorization;}
    
    public function toString()
    {
        $return = parent::toString();
        if($this->hasManagerAuthorization)
            $manager = "true";
        else
            $manager = "false";
            
        $return .= "<br>Doctors<br>";
        $len_docs = count($this->doctors);
        for($i = 0;$i<$len_docs;$i++)
        {
          if(isset($this->doctors[$i]))
            $return .= $i.": ".$this->doctors[$i]->toString()."<br>";
        }
        $return .= "<br>Has Manager Authorization = $manager";
        return $return;
    }
}

?>
