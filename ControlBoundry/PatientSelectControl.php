<?php
include_once("header.php");
/**
 * Description of PatientSelectControl
 *
 * @author Lincoln
 */
class PatientSelectControl {
  private $user;
  private $isUserSelected;
  private $userType;
  
  public function __construct()
  {
    $this->user = NULL;
    $this->isUserSelected = false;
    $this->userType = "UKN";
    
    if (!isset($_SESSION['SelectedUserId']))
      echo "  
<form action='home.php' method='post'>
  <tr>
    <td>
      <label for='search'>Search for User: </label>
      <input id='search' name='txtboxPatientInfo'/>
      <input type='submit' value='Select'/>
    </td>
  <tr>
</form>
";
    else 
    {
        $myloc = new LogOnControl();
        $this->user = $myloc->getUser($_SESSION['SelectedUserId']);
        $this->isUserSelected = true;
        
        if (is_a($this->user, "Patient"))
          $this->userType = "PA";
        else if(is_a($this->user, "Nurse"))
          $this->userType = "NU";
        else 
          $this->userType = "DO";
        
        
      echo "
<form action='home.php' method='post'>
<tr>
  <td>Patient Selected: ".$_SESSION['SelectedUserInfo']." 
    <input type='submit' name='btnChangePatient' value='Change Patient'/>
  </td>
</tr>
</form>";
    }


$autoData = $this->getAutoCompleteUsers("ALL");

echo "
<script>
$(function() {
  var data = [$autoData]; ";


echo "
  $( '#search' ).catcomplete({
    delay: 0,
    source: data
  });
});
</script>";
    
  }
  
  public function getSelectedUser(){ return $this->user;}
  public function getIsUserSelected() { return $this->isUserSelected;}
  public function getUsertype() { return $this->userType;}
  
  /**
  *This function isuser to generate a list of user names and id's that will be passed to
  * a java script that will generate a list of Doctors to be used in the autocomplete 
  *text box on create edit user tab as well as the for the patientSelectControl
  *
  */
  public function getAutoCompleteUsers($usertype)
  {
    $DA = new DataAccess();
    $rtnval = "";
   
    $where_stmt = "";
    if ($usertype != "ALL")
      $where_stmt = "WHERE usertype = '$usertype'";
    
    //Retrieve all users in Database to populate the user search box
    $usersql = "
    SELECT userfname, userlname, userid, usertype
    FROM users
    $where_stmt
    ORDER BY usertype, userfname, userlname";
    $userResult = mysqli_query($DA->getCon(),$usersql);

    $numUsers = 0;
    $fname = "";
    $lname = "";
    $userid = "";
    while($user_row = mysqli_fetch_array($userResult))
    {
      $fname = $user_row["userfname"];
      $lname = $user_row["userlname"];
      $userid = $user_row["userid"];
      if ($numUsers > 0)
        $rtnval .= "
          , ";
      switch ($user_row["usertype"])
      {
        case "DO":
          $rtnval .= "{ label: '$fname $lname - $userid', category: 'Doctor' }";
          break;
        case "NU":
          $rtnval .= "{ label: '$fname $lname - $userid', category: 'Nurse' }";
          break;
        case "PA":
          $rtnval .= "{ label: '$fname $lname - $userid', category: 'Patient' }";
          break;
        default:
          $rtnval .= "{ label: '$fname $lname - $userid', category: '' }";
          break;
        
      }      
      $numUsers++;
    }
    return $rtnval;
  }
  
  
}

?>
