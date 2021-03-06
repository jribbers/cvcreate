<?php
  include 'inc/package.php';
  include 'inc/classes/concept.php';

  define('PAGE_TITLE', 'Create');
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  $additionalCSS = ['create'];
  // $additionalJS = ['create.js'];

  // General Data

  $personalData = array(
    ['Persoonlijke informatie', false],
    'firstName'    => ['Voornaam', 'text', true],
    'lastName'     => ['Achternaam', 'text', true],
    'completeName' => ['Naam, volledig', 'text', true],
    'maritalStatus' => ['Burgerlijke staat', 'select', true, ['Ongehuwd', 'Gehuwd']],
    'gender' => ['Geslacht', 'select', true, ['Man', 'Vrouw']],
    'address_street' => ['Straat, huisnummer', 'text', false],
    'address_zip' => ['Postcode, stad', 'text', false],
    'telphone_land' => ['Vaste telefoon', 'text', false],
    'telphone_mob' => ['Mobiel', 'text', false],
    'dob' => ['Geboortedatum', 'text', true],
    'cityob' => ['Geboorteplaats', 'text', true],
    'email' => ['Email', 'text', true]
  );

  $educationData = array(
    ['Opleidingen', true],
    'education_school' => ['School', 'text', false],
    'education_education' => ['Opleiding', 'text', false],
    'education_from' => ['Van', 'text', false],
    'education_to' => ['Tot', 'text', false]
  );

  $workExperienceData = array(
    ['Werkervaring', true],
    'work_company' => ['Bedrijf', 'text', false],
    'work_function' => ['Functie', 'text', false],
    'work_tasks' => ['Taken', 'textarea', false],
    'work_from' => ['Van', 'text', false],
    'work_to' => ['Tot', 'text', false]
  );

  $linguarData = array(
    ['Taalkennis', true],
    'language' => ['Taal', 'text', false],
    'languageSkill' => ['Behendigheid', 'range', false]
  );

  $computerData = array(
    ['Programmas', true],
    'program' => ['Programma', 'text', false],
    'programSkill' => ['Behendigheid', 'range', false]
  );

  $drivingData = array(
    ['Rijbewijs', true],
    'license' => ['Rijbewijs', 'select', false,['A', 'A1', 'A2', 'AM', 'B', 'BE', 'C', 'CE', 'C1', 'C1E', 'D', 'DE', 'D1', 'D1E', 'T']]
  );

  // Sector specific
  $sectorProgramming = array(
    ['Programmeertalen', true],
    'programmingLanguage' => ['Programmeertaal', 'text', false],
    'programmingSkill' => ['Behendigheid', 'range', false]
  );

  $sectorProjects = array(
    ['Projecten', true],
    'project' => ['Projectnaam', 'text', false],
    'description' => ['Omschrijving', 'textarea', false],
    'link' => ['Link', 'text', false]
  );

  //Default form elements
  $form = [$personalData, $educationData, $workExperienceData, $linguarData, $computerData, $drivingData];
  if(isset($_POST['startform-sector'])) {
    switch ($_POST['startform-sector']) {
      case '9':
      array_push($form, $sectorProgramming, $sectorProjects);
      break;

      default:
      # code...
      break;
    }
    $formSet = true;
  }


  //Handling the form on index.php


  //Save CV input
  if(isset($_POST['saveCV'])) {
    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
      if(isset($_SESSION['username']) && isset($_SESSION['id'])){
        $concept = new Concept(true, $_POST, $_SESSION['username'], $_SESSION['id']);
        header('Location: /profile.php');
      }
    } else {
      echo "You're nog logged in";
    }
  }


  $view = 'views/create.php';

  include $template;

  if (isset($_POST['submitCV'])) {
    if (isset($_POST['startform-firstname'])) {
      echo "<script>$('#firstName').val('".$_POST['startform-firstname']."')</script>";
    }
    if (isset($_POST['startform-lastname'])) {
      echo "<script>$('#lastName').val('".$_POST['startform-lastname']."')</script>";
    }
    if (isset($_POST['startform-dob'])) {
      echo "<script>$('#dob').val('".$_POST['startform-dob']."')</script>";
    }
    if (isset($_POST['startform-email'])) {
      echo "<script>$('#email').val('".$_POST['startform-email']."')</script>";
    }
  }
?>
