<?php session_start();
include_once("header.php");

if (isset($_POST))
  //var_dump($_POST);

if(isset($_POST['inputBPS']) && isset($_POST['inputBPD']) && isset($_POST['inputSugarLevel']) && isset($_POST['inputWeight']))
{
    $todayDate = new DateTime();
    $tr = new TestResult(array('date'=>$todayDate,
        'BPSystolic'=>$_POST['inputBPS'], 
        'BPDiastolic'=>$_POST['inputBPD'], 
        'bloodSugarLevel'=>$_POST['inputSugarLevel'],
        'weight'=>$_POST['inputWeight']));
    $ntr = new NewTestResult($tr,$_SESSION['userid']);
    $ntr->upload();
}

//Checks to see if user selecting a user to display info for. 
if (isset($_POST['txtboxPatientInfo']))
{
  $tempstr = $_POST['txtboxPatientInfo'];
  //strrpos($tempstr, '-') + 1
  $_SESSION['SelectedUserId'] = substr(strtoupper($_POST['txtboxPatientInfo']),strrpos($tempstr, '-') + 1);
  $_SESSION['SelectedUserInfo'] = $tempstr;
}

//Check to see if Nurse or Doctor User has pushed the change patient button. 
//Unsets the session variables for selected patient
if (isset($_POST['btnChangePatient']))
{
  unset($_SESSION['SelectedUserId']);
  unset($_SESSION['SelectedUserId']);
}
        
//Check to see if Nurse or Doctor User has pushed the create user button. 
if (isset($_POST['tb4txtUserid']) && isset($_POST['tb4txtUserType']))
{
  $tuserid = strtoupper($_POST['tb4txtUserid']);
  $tusertype = substr(strtoupper($_POST['tb4txtUserType']),0,2);
  $tuserpassword = 'pas';
  $tuseremail = "example@icloud.com";
  $tuserfname = $_POST['tb4txtFname'];
  $tuserlname = $_POST['tb4txtLname'];
  
  $tuserbirthdate = date_create($_POST['tb4txtDateOfBirth'])->format('Y-m-d');
  $tuseractive = isset($_POST['tb4ckActiveUser']);
  $tpa_mrnnumber = $_POST['tb4txtMRNNumber'];
  $tpa_doctorid = substr(strtoupper($_POST['tb4txtAssignedDoctor']),strrpos($_POST['tb4txtAssignedDoctor'], '-') + 1);
  $tpa_doctorname = substr($_POST['tb4txtAssignedDoctor'],0, strrpos($_POST['tb4txtAssignedDoctor'], '-') - 1);
  $tnu_hasmanagerauth = isset($_POST['tb4ckboxHMA']);
  $tnu_doctorid1 = "";
  $tnu_doctorid2 = "";
  $tnu_doctorid3 = "";
  $tnu_doctorid4 = "";

  $insert_sql = "INSERT INTO wcheck.users (
    userid ,
    usertype ,
    userpassword ,
    useremail ,
    userfname ,
    userlname ,
    userbirthdate ,
    useractive ,
    pa_mrnnumber ,
    pa_doctorid ,
    pa_doctorname ,
    nu_hasmanagerauth ,
    nu_doctorid1 ,
    nu_doctorid2 ,
    nu_doctorid3 ,
    nu_doctorid4)
    VALUES (
    '$tuserid','$tusertype', '$tuserpassword', '$tuseremail', '$tuserfname', '$tuserlname', '$tuserbirthdate', '$tuseractive',
    '$tpa_mrnnumber', '$tpa_doctorid', '$tpa_doctorname', '$tnu_hasmanagerauth', '$tnu_doctorid1', '$tnu_doctorid2', '$tnu_doctorid3', '$tnu_doctorid4'    
)";
  
  $da = new DataAccess();
  $da->addUser($insert_sql);
}



$loginResult = "";
$LOC = new LogOnControl();
if (!isset($_SESSION['userid']) && isset($_POST['userid']) && isset($_POST['userpassword']))
  $loginResult =  $LOC->logOn($_POST['userid'], $_POST['userpassword']);
new MainUI($loginResult);

//if(isset($_POST))
//{
//    $myLOC = new LogOnControl();
//    $myLOC->logIn($_POST['userid'], $_POST['userpassword']);
//    new MainUI("");
//}
?>
