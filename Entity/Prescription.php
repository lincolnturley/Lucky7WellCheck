<?php
include_once("header.php");
/**
 * Prescription         Class
 * drugName             String
 * dosage               String
 * startDate            Date
 * expireDate           Date
 * prescriptionActive   Bool
 * @Author Dillan
 */
class Prescription {
    //Attributes
    private $drugName;
    private $dosage;
    private $startDate;
    private $expireDate;
    private $prescriptionActive;
    
     /**
     * Creates a new Prescription Object
     * 
     * @param Array newPrescriptionArray array containing
     * drugName     String
     * dosage       String
     * startDate    Date
     * expireDate   Date
     * prescriptionActive   Bool
     * @return Prescription
     */
    
    public function __construct($newPrescriptionArray)
    {
        $this->drugName = $newPrescriptionArray["drugName"];
        $this->dosage = $newPrescriptionArray["dosage"];
        $this->startDate = $newPrescriptionArray["startDate"];
        $this->expireDate = $newPrescriptionArray["expireDate"];
        $this->prescriptionActive = $newPrescriptionArray["prescriptionActive"];
    }
    
    //###########################
    //Getter functions
    //###########################
    
    public function getDrugName(){return $this->drugName;}
    public function getDosage(){return $this->dosage;}
    public function getStartDate(){return $this->startDate;}
    public function getExpireDate(){return $this->expireDate;}
    public function getPrescriptionActive(){return $this->prescriptionActive;}
    
    
    //############################
    //Setter functions
    //############################
    
    public function setDrugName($newDrugName){$this->drugName = $newDrugName;}
    public function setDosage($newDosage){$this->dosage = $newDosage;}
    public function setStartDate($newStartDate){$this->startDate = $newStartDate;}
    public function setExpireDate($newExpireDate){$this->expireDate = $newExpireDate;}
    public function setPrescriptionActive($newPrescriptionActive){$this->prescriptionActive = $newPrescriptionActive;}
    
    public function toString()
    {
        if($this->prescriptionActive)
            $prescription = "true";
        else
            $prescription = "false";
        $return = "Drug Name = $this->drugName <br>
                Dosage = $this->dosage <br>
                Start Date = ".$this->startDate->format('Y-m-d')." <br>
                Expire Date = ".$this->expireDate->format('Y-m-d')." <br>
                Prescription Active = ".$prescription." <br>";
        return $return;
    }
}

?>
