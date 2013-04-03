<?php
include_once("header.php");
/**
 * Description of StaffUI
 *
 * @author Lincoln
 */
class StaffUI 
{
  private $subUI;
  
  public function __construct()
  {
    ?>
<tr><td colspan="2"><div id="tabs">
  <ul>
    <li><a href="#tabs-1">Schedule</a></li>
    <li><a href="#tabs-2">Patient Info</a></li>
    <li><a href="#tabs-3">Memos</a></li>
    <li><a href="#tabs-4">Create/Edit User</a></li>
  </ul>
  <div id="tabs-1">
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

<!--var_dump($result);

while($row = mysqli_fetch_array($result))
{
    echo "<tr>";
    echo "<td>" . $row['trid'] . "</td>";
    echo "<td>" . $row['trpatientid'] . "</td>";
    echo "<td>" . $row['trdate'] . "</td>";
    echo "<td>" . $row['trbpsystolic'] . "</td>";
    echo "<td>" . $row['trbpdiastolic'] . "</td>";
    echo "<td>" . $row['trbloodsugarlevel'] . "</td>";
    echo "<td>" . $row['trweight'] . "</td>";

    echo "</tr>";
}
-->

    </table>
  </div>
  <div id="tabs-2">
    Patient Info Here
  </div>
  <div id="tabs-3">
    Memos here
  </div>
  <div id="tabs-4">
    Create Edit User Here
  </div>
</div></td>
</tr>
<?php
  }
}

?>
