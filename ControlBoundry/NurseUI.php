<?php
include_once("header.php");
/**
 * Description of StaffUI
 *
 * @author Lincoln
 */
class NurseUI 
{
  private $tb1Schedule;
  private $tb1lblSearchDate;
  private $tb1btnSearch;
  
  private $tb2PatientInfo;
  private $tb2lblSearchDate;
  private $tb2btnSearch;
  private $tb2btnEdit;
  private $tb2btnAddNewResult;
  
  private $tb3Memos;
  private $tb3lblDoctorMemos;
  private $tb3lblPatientMemos;

  private $tb4CreateEditUser;
  private $tb4lblEditPatientInformation;
  private $tb4lblFname;
  private $tb4lblLname;
  private $tb4lblUserid;
  private $tb4lblDateOfBirth;
  private $tb4lblMRNNumber;
  private $tb4lblUsertype;
  private $tb4lblAssignedDoctor;
  private $tb4btnSaveChanges;
  private $tb4btnCreateNewUser;
  private $tb4btnCancel;
  private $tb4chkboxHasManagerAuthorization;
  private $tb4chkboxActiveUser;
          
  private $PSC;
  
  public function __construct($nur)
  {
    $this->tb1Schedule = "Schedule";
    $this->tb1lblSearchDate = "Search Date: ";
    $this->tb1btnSearch = "Search";

    $this->tb2PatientInfo = "Patient Info";
    $this->tb2lblSearchDate = "Search Date: ";
    $this->tb2btnSearch = "Search";
    $this->tb2btnEdit = "Edit";
    $this->tb2btnAddNewResult = "Add New Test Result";

    $this->tb3Memos = "Memos";
    $this->tb3lblDoctorMemos = "Doctor Memos";
    $this->tb3lblPatientMemos = "Patient Memos";
    
    $this->tb4CreateEditUser = "Create/Edit User";
    
    $this->tb4lblEditPatientInformation = "Edit User Information";
    $this->tb4lblFname = "First Name: ";
    $this->tb4lblLname = "Last Name: ";
    $this->tb4lblUserid = "User Id: ";
    $this->tb4lblDateOfBirth = "Date of Birth: ";
    $this->tb4lblMRNNumber = "MRN #: ";
    $this->tb4lblUsertype = "User Type: ";
    $this->tb4lblAssignedDoctor = "Assigned Doctor: ";
    $this->tb4btnSaveChanges = "Save Changes";
	$this->tb4btnCreateNewUser = "Create User";
    $this->tb4btnCancel = "Cancel";
    $this->tb4ckboxHMA = "Has Manager Authorization";
    $this->tb4ckboxActiveUser = "Active User";
    
    $this->PSC = new PatientSelectControl();
     
echo "
<tr>
  <td colspan='2'>
  <div id='tabs'>
  <ul>
    <li><a href='#tabs-1'>$this->tb1Schedule</a></li>
    <li><a href='#tabs-2'>$this->tb2PatientInfo</a></li>
    <li><a href='#tabs-3'>$this->tb3Memos</a></li>
    <li><a href='#tabs-4'>$this->tb4CreateEditUser</a></li>
  </ul>
  <div id='tabs-1'>";
    
    $docArray = $nur->getDoctors();
    
    $num_docs = count($docArray);
    if ($num_docs < 1)
      echo "You have no Assigned Doctors. <br>
        To add a doctor to your user record please visit Create/Edit User Tab";
    else
    {
      echo "<div id='accordion'>
        ";
      
      
      for($i = 0;$i<$num_docs;$i++)
      {
        $tempDoc = $docArray[$i];
        echo "
      <h3>Dr. ".$tempDoc->getFullName()."</h3>
      <div>
      <table border='1'>
        <tr>
        <th>Date</th>
        <th>9 am</th>
        <th>10 am</th>
        <th>11 am</th>
        <th>12 pm</th>
        <th>1 pm</th>
        <th>2 pm</th>
        <th>3 pm</th>
        <th>4 pm</th>
        </tr>
       </table>
      </div>";
      }
      
      echo "
     </div>";
      
    }
echo 
"     
    </div>
  <div id='tabs-2'>
    Patient Info Here
  </div>
  <div id='tabs-3'>
    Memos here
  </div>
  <div id='tabs-4'>";
    if (!$this->PSC->getIsUserSelected())
      echo "
<form action='home.php' method='post'>
<table border='1'>
  <tr><td colspan='4'> <h4>Create New User</h4></td></tr>
  <tr>
    <td align='right'>".$this->tb4lblFname."</td>
    <td align='left'><input type='text' name='tb4txtFname'></td>
    <td align='right'>".$this->tb4lblLname."</td>
    <td align='left'><input type='text' name='tb4txtLname'></td>
  </tr>
  <tr>
    <td align='right'>".$this->tb4lblUserid."</td>
    <td align='left'><input type='text' name='tb4txtUserid'></td>
    <td align='right'>".$this->tb4lblDateOfBirth."</td>
    <td align='left'><input type='text' id='datepicker' name='tb4txtDateOfBirth'></td>
  </tr>
  <tr>
    <td align='right'>".$this->tb4lblMRNNumber."</td>
    <td align='left'><input type='text' name='tb4txtMRNNumber'></td>
  </tr>
  <tr>
    <td><label for='search'>".$this->tb4lblUsertype."</label></td>
    <td><input id='userTypeDropDown' name='tb4txtUserType'/></td>
    <td>
      <input type='checkbox' name='tb4ckboxHMA' value='true'>".$this->tb4ckboxHMA."
    </td>
    <td>
      <input type='checkbox' name='tb4ckActiveUser' value='true'>".$this->tb4ckboxActiveUser."
    </td>
  </tr>
  <tr>
    <td align='right'><label for='searchDoctors'>".$this->tb4lblAssignedDoctor."</label></td>
    <td align='left'><input id='searchDoctors' name='tb4txtAssignedDoctor'></td>
  </tr>
  <tr/>
  <tr>
    <td colspan ='2' align='right'><input type='submit' value='".$this->tb4btnCreateNewUser."'>
    </td>
    </form>
    <form action='home.php' action='post' name='cancelCreateUser'>    
      <td colspan ='2' align='left' valign='bottom'>
       <input type='submit' value='Cancel'>
      </td>
    </form>
  </tr>

</form>
</table>
";
    else
      echo "User selected. Edit user logic here.";


echo"  </div>
</div></td>
</tr>";

$autoData = $this->PSC->getAutoCompleteUsers("DO");

echo "
<script>
$(function() {
  var data = [$autoData]; ";
  
echo "
  $( '#searchDoctors' ).catcomplete({
    delay: 0,
    source: data
  });
});
</script>";

  }
}

?>



