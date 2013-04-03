<?php //session_start();
 
include_once("header.php");



$myLOC = new LogOnControl();

//$pat = $myLOC->getUser("LVMLLT","PA");


//$nur = $myLOC->getUser("NURSEJ","NU");



echo $nur->toString();





//$newUserArray = array();
//$newUserArray["username"] = "LVMLLT";
//$newUserArray["password"] = "changeme01";
//$newUserArray["fname"] = "Lincoln";
//$newUserArray["lname"] = "Turley";
//$newUserArray["birthDate"] = date_create("1988-01-10");
//$newUserArray["activeUser"] = true;
//
//$myUser = new User($newUserArray);
//
//echo $myUser->toString();
//
//echo "<br><br>";
//
//$myUser2 = new User(array(
//    'username'=>'ART'
//    , "password"=>"pa\$\$word01"
//    , "fname"=>"Amber"
//    , "lname"=>"Turley" 
//    , "birthDate"=>date_create("1981-04-07")
//    , "activeUser"=>true));
//
//echo "<br><br>",$myUser2->toString();
//
////echo "<br>", $myUser2->getUserName();
////echo "<br>", $myUser2->getFName();
////echo "<br>", $myUser2->getLName();
////echo "<br>", $myUser2->getFullName();
////echo "<br>", $myUser2->getBirthDate()->format("Y-m-d");
////echo "<br>", $myUser->getActiveUser();
//
//$myUser2->setUsername("ART2");
//$myUser2->setPassword("02password");
//$myUser2->setFName("Abmber_2");
//$myUser2->setLName("Turley_2");
//$myUser2->setBirthDate(date_create("1922-02-02"));
//$myUser2->setActiveUser(false);
//
//echo "<br><br>",$myUser2->toString();
//
//echo "<br><br>##########################################<br>TESTING PATIENT CLASS<br>
    ##########################################<br>";

//$myTR = new TestResult(array("date"=>date_create("2013-03-12")
//    , "BPSystolic"=>122
//    , "BPDiastolic"=>79
//    , "bloodSugarLevel"=>100
//    , "weight"=>196.7));
//echo $myTR->toString(),"<br>";
//$myTR1 = new TestResult(array("date"=>date_create("2013-03-13")
//    , "BPSystolic"=>120
//    , "BPDiastolic"=>80
//    , "bloodSugarLevel"=>85
//    , "weight"=>195.2));
//echo $myTR1->toString(),"<br>";
//$myTR2 = new TestResult(array("date"=>date_create("2013-03-13")
//    , "BPSystolic"=>119
//    , "BPDiastolic"=>75
//    , "bloodSugarLevel"=>80
//    , "weight"=>196.2));
//echo $myTR2->toString(),"<br>";
//
//$myPatentArray = array(
//    "username"=>"ART"
//    , "password"=>"pa\$\$word01"
//    , "fname"=>"Amber"
//    , "lname"=>"Turley" 
//    , "birthDate"=>date_create("1981-04-07")
//    , "activeUser"=>true
//    , "MRNNumber"=>"12345abc"
//    , "doctor"=>"Temporary Doctor"
//    , "results"=>array()
//    , "memos"=>array()
//    , "prescriptions"=>array()
//    , "appointments"=>array()
//    );
//$myPatient = new Patient($myPatentArray);
//$myPatient->getMRNNumber();
////echo $myPatient->toString();
//
//echo "<br><br>";
//$myPatient->addTestResult($myTR);
//$myPatient->addTestResult($myTR1);
//$myPatient->addTestResult($myTR2);
//$myPatient->addMemo("Memo111111");
//$myPatient->addPrescription("Script111111");
//$myPatient->addAppointment("Appointment11111");
////echo $myPatient->toString();
//
//$temp = $myPatient->getTestResults(date_create("2013-03-13"));
//
//\var_dump($temp);

//TESTING TEST RESULTS


//<editor-fold desc="Testing Database and display results in table">



//$host =  "localhost";
//$user = "root";
//$password = "";
//$database = "wcheck";
//$con = new mysqli($host, $user, $password, $database);      
////$con = mysqli_connect($host, $user, $password, $database, $port, $socket);
//
//// Check connection
//if (mysqli_connect_errno($con))
//{
//    echo "Failed to connect to MySQL: " . mysqli_connect_error();
//}
//else
//{
//    echo "Connection Seccessful!!!<br>";
//    //var_dump($con);
//    
//    
//}
//
//$result = mysqli_query($con,"SELECT * FROM testresults");
//echo "<table border='1'>
//<tr>
//<th>trid</th>
//<th>trpatientid</th>
//<th>trdate</th>
//<th>trbpsystolic</th>
//<th>trbpdiastolic</th>
//<th>trbloodsugarlevel</th>
//<th>trweight</th>
//</tr>";
//var_dump($result);
//
//while($row = mysqli_fetch_array($result))
//{
//    echo "<tr>";
//    echo "<td>" . $row['trid'] . "</td>";
//    echo "<td>" . $row['trpatientid'] . "</td>";
//    echo "<td>" . $row['trdate'] . "</td>";
//    echo "<td>" . $row['trbpsystolic'] . "</td>";
//    echo "<td>" . $row['trbpdiastolic'] . "</td>";
//    echo "<td>" . $row['trbloodsugarlevel'] . "</td>";
//    echo "<td>" . $row['trweight'] . "</td>";
//
//    echo "</tr>";
//}
//echo "</table>";
//echo "</table>";
// </editor-fold>




//$myLOC2 = new LogOnControl();
////$newui = new LogonUI();
////$newui->display();
//$_SESSION['LogOnObj'] = serialize($myLOC2);
//$_SESSION['UserIsLoggedIn'] = true;
//if (0)
//{
//    echo "<p>The username from the ui is: ", $_POST["username"],"<br></p>";
//    echo "The password from the ui is: ", $_POST["password"],"<br>";
//}

?>


