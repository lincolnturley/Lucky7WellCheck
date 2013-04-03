<?php
include_once("header.php");
/**
 * Patient Class extends User Class
 * 
 * MRNNumber        string
 * doctor           Doctor
 * results          TestResult[]
 * memos            Memo[]
 * prescriptions    Prescription[]
 * appointments     Appointment[]
 *
 * @author Lincoln
 */
//
class Patient extends User
{
    //Atributes
    private $MRNNumber;
    private $doctor;
    private $results;
    private $memos;
    private $prescriptions;
    private $appointments;


    /**
    * Creates a new Patient object
    * 
    * @param array $newPatientArray  
    * 
    * array containing indices
    * userid, password, fname, lname, birthdate, activeUser, boolean,
    * MRNNumber, doctor, results, memos, prescriptions, appointments
    * @return Patient 
    */
    public function __construct($newPatientArray)
    {
        parent::__construct($newPatientArray);
        
        $this->MRNNumber = "";
        $this->doctor = NULL;
        $this->results = array();
        $this->memos = array();
        $this->prescriptions = array();
        $this->appointments = array();

        if (isset($newPatientArray["MRNNumber"]))
          $this->MRNNumber = $newPatientArray["MRNNumber"];
        
        if (isset($newPatientArray["doctor"]))
          $this->doctor = $newPatientArray["doctor"];
        
        if (isset($newPatientArray["results"]))
          $this->results = $newPatientArray["results"];
        
        if (isset($newPatientArray["memos"]))
          $this->memos = $newPatientArray["memos"];
        
        if (isset($newPatientArray["prescriptions"]))
          $this->prescriptions = $newPatientArray["prescriptions"];
        
        if (isset($newPatientArray["appointments"]))
          $this->appointments = $newPatientArray["appointments"];        
    }

    //#####################################################
    //GETTER FUNCTIONS
    //#####################################################
    public function getMRNNumber(){ return $this->MRNNumber; }
    public function getDoctor(){ return $this->doctor; }
    public function getTestResults($searchDate)
    { 
        if ($searchDate == date_create("0000-00-00"))
            return $this->results;
        else
        {
            $len_res = count($this->results);
            $numInserted = 0;
            $rtnArray = array();
            for ($i = 0; $i <$len_res;$i++ )
            {
                if($this->results[$i]->getDate()==$searchDate)
                {
                   $rtnArray[$numInserted] = $this->results[$i];
                   $numInserted++;
                }        
            }
            return $rtnArray;    
        }  
    }
    
    public function getMemos(){ return $this->memos; }
    public function getPrescriptions(){ return $this->prescriptions; }
    public function getAppointments(){ return $this->appointments; }


    //#####################################################
    //SETTER FUNCTIONS
    //#####################################################
    public function setMRNNumber($newMRNNumber){ $this->fname = $newMRNNumber; }
    public function setDoctor($newDoctor){ $this->doctor = $newDoctor; }

    public function addTestResult($newTestResult)
    {
        $len_res = count($this->results);
        $this->results[$len_res] = $newTestResult;
    }
    
    public function addMemo($newMemo)
    {
        $len_mem = count($this->memos);
        $this->memos[$len_mem] = $newMemo;
    }
    
    public function addPrescription($newPrescription)
    {
        $len_pres = count($this->prescriptions);
        $this->prescriptions[$len_pres] = $newPrescription;
    }
    
    public function addAppointment($newAppointment)
    {
        $len_app = count($this->appointments);
        $this->appointments[$len_app] = $newAppointment;
    }
    
    public function toString()
    {
        $rtnVal = parent::toString();

        $rtnVal .= "MRNNumber = $this->MRNNumber <br>";
        
        //Replace with Doctor.tostring method
        $rtnVal .= "<br>DOCTOR = <br>".$this->doctor->toString();
        
        $rtnVal .= "RESULTS<br>";
        $len_res = count($this->results);
        for($i = 0;$i<$len_res;$i++)
        {
            //memos array will eventuall hold a Memo object at each index
            //will replace this with a memo[$i]->toString
            $rtnVal .= $i.": ".$this->results[$i]->toString()."<br>";
        }

        $rtnVal .= "MEMOS<br>";
        $len_mem = count($this->memos);
        for($i = 0;$i<$len_mem;$i++)
        {
            //memos array will eventuall hold a Memo object at each index
            //will replace this with a memo[$i]->toString
            $rtnVal .= $i.": ".$this->memos[$i]->toString()."<br>";
        }

        $rtnVal .= "PRESCRIPTIONS<br>";
        $len_pres = count($this->prescriptions);
        for($i = 0;$i<$len_pres;$i++)
        {
            //memos array will eventuall hold a Memo object at each index
            //will replace this with a memo[$i]->toString
            $rtnVal .= $i.": ".$this->prescriptions[$i]->toString()."<br>";
        }
        
        $rtnVal .= "APPOINTMENTS<br>";
        $len_app = count($this->appointments);
        for($i = 0;$i<$len_app;$i++)
        {
            //memos array will eventuall hold a Memo object at each index
            //will replace this with a memo[$i]->toString
            $rtnVal .= $i.": ".$this->appointments[$i]->toString()."<br>";
        }
        return $rtnVal;
    }

}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
