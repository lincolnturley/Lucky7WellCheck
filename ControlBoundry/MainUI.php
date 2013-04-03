  <link rel="stylesheet" href="/Lucky7/jquery-ui-1.10.2.custom.css" />
  <script src="/Lucky7/ControlBoundry/jquery-1.9.1.js"></script>
  <script src="/Lucky7/ControlBoundry/ui/jquery-ui.js"></script>
<?php 
include_once('header.php');


class MainUI 
{
    private $LOC;
    public function __construct($loginResult)
    {   
      $this->LOC = new LogOnControl();
                  
      echo "
      <html>
        <table width='100%' border='1'>
          <tr>
            <td align='center'> 
              <H1 class='title'>Luck7 Well Check</H1>
            </td>
          </tr>";
                
            if (isset($_SESSION['userid']))
                echo "<div style='position: absolute; top: 0; right: 0; width: 150px; text-align:left;'>
                        <form action='index.php' method='post'>
                          Logged in as ".$_SESSION['userid']."<br>
                            <input type='submit' value='Log Off'> 
                        </form>
                      </div>";
           
        if($loginResult == "forgotUseridOrPassword")
        {
            $this->LOC->forgotUseridOrPassword();
        }
        else if($loginResult == "logOff")
        {
            echo "<tr><td>";
            $this->LOC->logOff();
            echo "</td></tr>";
        }
        else if (!isset($_SESSION['userid']))
        {
            echo "<tr><td>";
            
            if($loginResult == "logOnFailed")
                echo "<font color='red'>Invalid Username or Password. 
                    Please try again.</font>";
            
            else if ($loginResult == "inactiveUser")
                echo "<font color='red'>Account is not active.</font>";
            
            $myLOUI = $this->LOC->getLOUI(); 
            $myLOUI->displayLogOnUI();
            echo "</td></tr>";
        }
        else
        {          
          $generalUser = $this->LOC->getUser($_SESSION['userid']);
          
          switch ($_SESSION['usertype'])
          {
            case "PA":
              
              //$pat = $this->LOC->getUser($_SESSION['userid']);
              new PatientUI($generalUser);
              break;
            
            case "NU":
              
              //new PatientSelectControl();
              new NurseUI($generalUser);
              break;
            
            case "DO":
              //new PatientSelectControl();
              new DoctorUI($generalUser);
              break;
          }
        }
        echo "
        </table>
        </html>";

    }
}
?>

<script>
  $(function() {
    $( "#tabs" ).tabs();
  });
</script>
<script>
  $(function() {
    $( "#accordion" ).accordion();
  });
</script>
<script>
$.widget( "custom.catcomplete", $.ui.autocomplete, {
  _renderMenu: function( ul, items ) {
    var that = this,
      currentCategory = "";
    $.each( items, function( index, item ) {
      if ( item.category !== currentCategory ) {
        ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
        currentCategory = item.category;
      }
      that._renderItemData( ul, item );
    });
  }
});
</script>
<script>
$(function() {
  var data = [
    { label: 'DO - Doctor', category: '' },
    { label: 'NU - Nurse', category: '' },
    { label: 'PA - Patient', category: '' }
  ]; 
  $( '#userTypeDropDown' ).catcomplete({
    delay: 0,
    source: data
  });
});
</script>
<script>
$(function() {
  $( "#datepicker" ).datepicker({
    changeMonth: true,
    changeYear: true
  });
});
</script>
