<?php
//set default time zome
date_default_timezone_set ('America/Phoenix');

//Entity classes
include_once("Entity\User.php");
include_once("Entity\Patient.php");
include_once("Entity\Doctor.php");
include_once("Entity\Nurse.php");
include_once("Entity\TestResult.php");
include_once("Entity\Prescription.php");
include_once("Entity\Memo.php");
include_once("Entity\Appointment.php");

//Control Boundry Classes
include_once("ControlBoundry\DataAccess.php");
include_once("ControlBoundry\LogOnControl.php");
include_once("ControlBoundry\PatientSelectControl.php");
include_once("ControlBoundry\MainUI.php");
include_once("ControlBoundry\LogOnUI.php");
include_once("ControlBoundry\PatientUI.php");
include_once("ControlBoundry\NurseUI.php");
include_once("ControlBoundry\DoctorUI.php");
//include_once("ControlBoundry\NewMemoUI.php");
//include_once("ControlBoundry\NewResultsUI.php");
include_once("ControlBoundry\NewTestResult.php");

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
