<?php
include_once("header.php");
/**
 * TestResult Class
 * date             Date
 * BPSystolic       int
 * BPDiastolic      int
 * bloodSugarLevel  int
 * weight           double
 * 
 * @author Lincoln
 */
class TestResult 
{
    private $date;
    private $BPSystolic;
    private $BPDiastolic;
    private $bloodSugarLevel;
    private $weight;
    /**
     * Creates a new TestResult Object
     * 
     * @param type $newTRArray array containing indices date, BPSystolic, 
     * BPDiastolic, bloodSugarLevel, weight
     */
    public function __construct($newTRArray)
    {
        $this->date = $newTRArray["date"];
        $this->BPSystolic = $newTRArray["BPSystolic"];
        $this->BPDiastolic = $newTRArray["BPDiastolic"];
        $this->bloodSugarLevel = $newTRArray["bloodSugarLevel"];
        $this->weight = $newTRArray["weight"];
    }
    //#####################################################
    //GETTER FUNCTIONS
    //#####################################################
    public function getDate(){ return $this->date; }
    public function getBPSystolic(){ return $this->BPSystolic; }
    public function getBPDiastolic(){ return $this->BPDiastolic; }
    public function getBloodSugarLevel(){ return $this->bloodSugarLevel; }
    public function getWeight(){ return $this->weight; }
    
    
    //#####################################################
    //SETTER FUNCTIONS
    //#####################################################
    public function setDate($newDate){ $this->date = $newDate; }
    public function setBPSystolic($newBPSystolic)
    { 
        $this->BPSystolic = $newBPSystolic;
    }
    public function setBPDiastolic($newBPDiastolic)
    { 
        $this->BPDiastolic = $newBPDiastolic;
    }
    public function setBloodSugarLevel($newBloodSugarLevel)
    { 
        $this->bloodSugarLevel = $newBloodSugarLevel;
    }
    public function setWeight($newWeight){ $this->username = $newWeight; }
    
    public function toString()
    {
        return "date = ".$this->date->format("Y-m-d")."<br>
        BPSystolic = $this->BPSystolic<br>  		
        BPDiastolic = $this->BPDiastolic<br>
        bloodSugarLevel = $this->bloodSugarLevel<br>
        weight = $this->weight<br>"; 
    }
}

?>
