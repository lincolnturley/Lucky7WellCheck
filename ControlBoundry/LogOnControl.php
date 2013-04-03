<?php 
include_once('header.php');

/**
 * Description of LogOnControl
 *
 * @author Lincoln
 */
class LogOnControl 
{
    //private $loggedIn;
    //private $loggedInUser;
    private $DA;
    private $LOUI;
    
    public function __construct()
    {
        //$this->loggedIn = false;
        //$this->loggedInUser = new User();
        $this->DA = new DataAccess();
        $this->LOUI = new LogOnUI();
    }
    
    /**
     * logOn Method
     * 
     * This method will take the userid and password as paramaters and will verify them against the database
     * The loggedInUser object will also be instantiated
     * 
     * @param type $userid
     * @param type $password
     * @return string
     */
    public function logOn($userid, $password)
    {
        $rtnval="";
        $con = $this->DA->getCon();
        
        $result = mysqli_query($con,"
          SELECT *
          FROM users 
          WHERE userid = '$userid' 
            AND (userpassword = '$password' OR useractive = 0)");

        //var_dump($result);
  
        if($result->num_rows > 0)
        {  
            $row = mysqli_fetch_array($result);
            if($row['useractive'] == 1)
            {  
                $_SESSION['userid'] = $userid;
                $_SESSION['usertype'] = $row['usertype'];
                
                $rtnval = "logOnSuccessful";
            }
            else
                $rtnval = "inactiveUser";
        }
        else
            $rtnval = "logOnFailed";
        
        return $rtnval;
    }
    
    /**
     * log of function will destrpy the session and unset the userid variable so that 
     * the log on screen will be displayed. 
     */
    public function logOff()
    {
        session_destroy();
        unset($_SESSION['userid']);  
        $this->LOUI->displayLoggedOutUI();
    }
    public function getLOUI(){return $this->LOUI;}

    /**
     * getUser() will retrive all user information from the database and return the appropriate 
     * user type **See return type. NULL will be returned if on of the paramaters is blank or if there is no such 
     * user defined in the database. 
     * 
     * @param type $userid
     * @param type $usertype
     * @return null|\Patient|\Nurse|\Doctor
     */    
    public function getUser($userid)
    { 
      if ($userid == "")
        return NULL;
      $con = $this->DA->getCon();
      
      $usersql = "
      SELECT *
      FROM users 
      WHERE userid = '$userid' ";

      $userResult = mysqli_query($con,$usersql);

      $user_row = mysqli_fetch_array($userResult);
      $usertype = $user_row['usertype'];
      
    switch($usertype)
      {
        case "PA":
          //Retrieve up mysqli variable for selecting info from Database
          
          
//          //Retrie User info from users table
//          $usersql = "
//          SELECT *
//          FROM users 
//          WHERE userid = '$userid' and usertype = 'PA'";
//          
//          $userResult = mysqli_query($con,$usersql);
//          
//          $user_row = mysqli_fetch_array($userResult);
          
 
          
          //Retrieve patient test results from database
          $trsql = "
          SELECT *
          FROM testresults 
          WHERE trpatientid = '$userid'
          ORDER BY trdate";
          $trResult = mysqli_query($con,$trsql);
          
          $trArray = array();
          $xcnt = 0;
          while($tr_row = mysqli_fetch_array($trResult))
          {
            $trArray[$xcnt] = new TestResult(array(
             "date"=>date_create($tr_row['trdate'])
             , "BPSystolic"=>$tr_row['trbpsystolic']
             , "BPDiastolic"=>$tr_row['trbpdiastolic']
             , "bloodSugarLevel"=>$tr_row['trbloodsugarlevel']
             , "weight"=>$tr_row['trweight']));
            $xcnt++;
          }



          //Retrieve patient memos from database
          $memsql = "
          SELECT *
          FROM memos 
          WHERE mepatientid = '$userid'
          ORDER BY meread, medate";
          $memResult = mysqli_query($con,$memsql);
          
          $memArray = array();
          $xcnt = 0;
          while($mem_row = mysqli_fetch_array($memResult))
          {
            $memArray[$xcnt] = new Memo(array(
             "date"=>date_create($mem_row['medate'])
             , "note"=>$mem_row['menote']
             , "messageRead"=>$mem_row['meread']
             , "messageType"=>$mem_row['metype']));
            $xcnt++;
          }
          
          //Retrieve Prescriptions
           $presql = "
          SELECT *
          FROM prescriptions 
          WHERE prpatientid = '$userid'
          ORDER BY prprescriptionactive DESC, prexpiredate";
          $preResult = mysqli_query($con,$presql);
          
          $preArray = array();
          $xcnt = 0;
          while($pre_row = mysqli_fetch_array($preResult))
          {
            $preArray[$xcnt] = new Prescription(array(
             "drugName"=>$pre_row['prdrugname']  
             , "dosage"=>$pre_row['prdosage']
             , "startDate"=>date_create($pre_row['prstartdate'])
             , "expireDate"=>date_create($pre_row['prexpiredate'])
             , "prescriptionActive"=>$pre_row['prprescriptionactive']));
            $xcnt++;
          }
          
          //Get patient's appointments from the Database
           $appsql = "
          SELECT *
          FROM appointments
          WHERE appatientid = '$userid'
          ORDER BY apdate";
          $appResult = mysqli_query($con,$appsql);
          
          $appArray = array();
          $xcnt = 0;
          while($app_row = mysqli_fetch_array($appResult))
          {
            $appArray[$xcnt] = new Appointment(array(
             "date"=>date_create($app_row['apdate'])
             , "time"=>$app_row['aptime']
             , "status"=>$app_row['apstatus']
             , "doctorId"=>$app_row['apdoctorid']
             , "doctorName"=>$app_row['apdoctorname']
             , "patientId"=>$app_row['appatientid']
             , "patientName"=>$app_row['appatientname']));
            $xcnt++;
          }
                
          $newPatentArray = array(
          "userid"=>$user_row["userid"]
          , "password"=>$user_row["userpassword"]
          , "email"=>$user_row["useremail"]
          , "fname"=>$user_row["userfname"]
          , "lname"=>$user_row["userlname"] 
          , "birthDate"=>date_create($user_row["userbirthdate"])
          , "activeUser"=>$user_row["useractive"]
          , "MRNNumber"=>$user_row["pa_mrnnumber"]
          , "doctor"=>$this->getUser($user_row["pa_doctorid"])
          , "results"=>$trArray
          , "memos"=>$memArray
          , "prescriptions"=>$preArray
          , "appointments"=>$appArray);
          
          
          $myUser = new Patient($newPatentArray);
          
          return $myUser;
          break;
        
          
          
        case "NU":
          
//          $usersql = "
//          SELECT *
//          FROM users 
//          WHERE userid = '$userid' and usertype = 'NU' ";
//          
//          $userResult = mysqli_query($con,$usersql);
//          
//          $user_row = mysqli_fetch_array($userResult);
          
          $docArray = array();
          $docsInserted = 0;
          for ($xcnt = 1; $xcnt <= 4; $xcnt++)
          {
            if ($user_row["nu_doctorid$xcnt"] != "")
            {
               $tempDoc = $this->getUser($user_row["nu_doctorid$xcnt"]);
               if ($tempDoc != NULL)
                $docArray[$docsInserted] = $tempDoc;
               $docsInserted++;
            }
          }
          
          $newNurseArray = array(
          "userid"=>$user_row["userid"]
          , "password"=>$user_row["userpassword"]
          , "email"=>$user_row["useremail"]
          , "fname"=>$user_row["userfname"]
          , "lname"=>$user_row["userlname"] 
          , "birthDate"=>date_create($user_row["userbirthdate"])
          , "activeUser"=>$user_row["useractive"]
          , "hasManagerAuthorization"=>$user_row["nu_hasmanagerauth"]
          , "doctors"=>$docArray);
          
          $myUser = new Nurse($newNurseArray);
          return $myUser;
          
          break;
        
          
        case "DO":
          
//          $usersql = "
//          SELECT *
//          FROM users 
//          WHERE userid = '$userid' AND usertype = 'DO' ";
//          
//          $userResult = mysqli_query($con,$usersql);
//          
//          $user_row = mysqli_fetch_array($userResult);
          
          //Get doctor's appointments from the Database
          $appsql = "
          SELECT *
          FROM appointments
          WHERE apdoctorid = '$userid'
          ORDER BY apdate";
          $appResult = mysqli_query($con,$appsql);
          
          $appArray = array();
          $xcnt = 0;
          while($app_row = mysqli_fetch_array($appResult))
          {
            $appArray[$xcnt] = new Appointment(array(
             "date"=>date_create($app_row['apdate'])
             , "time"=>$app_row['aptime']
             , "status"=>$app_row['apstatus']
             , "doctorName"=>$app_row['apdoctorname']
             , "doctorId"=>$app_row['apdoctorid']
             , "patientName"=>$app_row['appatientid']
             , "patientID"=>$app_row['appatientname']));
            $xcnt++;
          }
          
          $newDoctorArray = array(
          "userid"=>$user_row["userid"]
          , "password"=>$user_row["userpassword"]
          , "email"=>$user_row["useremail"]
          , "fname"=>$user_row["userfname"]
          , "lname"=>$user_row["userlname"] 
          , "birthDate"=>date_create($user_row["userbirthdate"])
          , "activeUser"=>$user_row["useractive"]
          , "appointments"=>$appArray);
          
          return new Doctor($newDoctorArray);
          break;
        default:
          return NULL;
          break;
      }
    
    }
    public function forgotUseridOrPassword()
    {
        $this->LOUI->displayForgotPasswordUI();
    }
    
    public function sendEmail($email)
    {
        $subject = "Lucky7 password retrival";
        $message = "Your password is "; //need help obtaining password from email
        
        //checks for valid email
        if (!preg_match("/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/", $email)) 
            {
                echo "<h4>Invalid email address</h4>";
                echo "<a href='javascript:history.back(1);'>Back</a>";
            }
        elseif (mail($email,$subject,$message)) 
            {
                echo "<h4>Your password will be delivered to your email shortly</h4>";
            } 
        else {
                echo "<h4>Error: Can't send email to $email</h4>";
             }  
    }
}

?>
