<?php
include_once("header.php");

/**
 * User Class
 * userid     string unique identifier
 * password     string
 * email        string
 * fname        string
 * lname        string
 * birthDate    Date
 * activeUser   bool
 * 
 * @author Lincoln
 */
class User
{
    //Attributes
    private $userid;
    private $password;
    private $email;
    private $fname;
    private $lname;
    private $birthDate;
    private $activeUser;

    /**
     * Creates a new user object
     * 
     * @param array $newUserArray  array containing indices
     * userid string
     * password string
     * fname string
     * lname string
     * birthdate Date
     * activeUser boolean
     */

    public function __construct($newUserArray)
    {
        $this->userid = "";
        $this->password = "";
        $this->email = "";
        $this->fname = "";
        $this->lname = "";
        $this->birthDate = date_create("1900-01-01");
        $this->activeUser = false;
        
      if (isset($newUserArray['userid']))
        $this->userid = $newUserArray['userid'];
      
      if (isset($newUserArray['password']))
        $this->password = $newUserArray['password'];
      
      if (isset($newUserArray['email']))
        $this->email = $newUserArray['email'];
      
      if (isset($newUserArray['fname']))
        $this->fname = $newUserArray['fname'];
      
      if (isset($newUserArray['lname']))
        $this->lname = $newUserArray['lname'];
      
      if (isset($newUserArray['birthDate']))
        $this->birthDate = $newUserArray['birthDate'];
      
      if (isset($newUserArray['activeUser']))
        $this->activeUser = $newUserArray['activeUser'];
    }
    
    //#####################################################
    //GETTER FUNCTIONS
    //#####################################################
    public function getUserId(){ return $this->userid; }
    public function getEmail(){ return $this->email; }
    public function getFName(){ return $this->fname; }
    public function getLName(){ return $this->lname; }
    public function getFullName(){ return "$this->fname $this->lname"; }
    public function getBirthDate(){ return $this->birthDate; }
    public function getActiveUser(){ return $this->activeUser; }
    
    
    //#####################################################
    //SETTER FUNCTIONS
    //#####################################################
    public function setUsername($newUserid){ $this->userid = $newUserid; }
    public function setPassword($newPassword){ $this->password = $newPassword; }
    public function setEmail($newPassword){ $this->password = $newPassword; }
    public function setFName($newFName){ $this->fname = $newFName; }
    public function setLName($newLName){ $this->lname = $newLName; }
    public function setBirthDate($newBirthDate)
    {
        $this->birthDate= $newBirthDate;
    }
    public function setActiveUser($newActiveUserStatus)
    {
        $this->activeUser = $newActiveUserStatus; 
    }
   
    public function toString()
    {
        if ($this->activeUser)
            $temp_au = "TRUE";
        else
            $temp_au = "FALSE";
        
        return "userid = $this->userid <br>
        password = $this->password <br>
        email = $this->email <br>           
        fname = $this->fname <br>
        lname = $this->lname <br>
        birthDate = ".$this->birthDate->format('Y-m-d')." <br>
        activeUser = $temp_au <br>"; 
    }
}
?>


