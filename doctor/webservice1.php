<?php
$search_param=$_POST["search"];
$search_area=$_POST["area"];

if(isset($_POST["search"]) && isset($_POST["area"])){
// Connect to database
$host='localhost';
$dbuser='id20877763_doctor';
$dbpass= 'Abcde1234@';
$dbname='id20877763_doctor';

$conn= new mysqli($host,$dbuser,$dbpass,$dbname);
// $sql = "SELECT id,Doctorname,Doctorinformation,Doctorimage from doctors where DoctorArea like '%".$search_area."%' and $search_area like '%".$search_param."%' ";

$sql = "SELECT *FROM `doctors` WHERE DoctorArea like '%".$search_area."%' and Doctorcategory like '%".$search_param."%' ";
$result = $conn->query($sql);

if($result->num_rows > 0){
    $data='div class="appointmentstepsheading">
    Doctors Found in Your Area 
  </div>';
  $doctor_data="";
  while($row = $result->fetch_assoc()){
    $doctorid = $row["id"];
    $doctorname = $row["Doctorname"];
    $doctorinfo = $row["Doctorinformation"];
    $doctorimg = $row["Doctorimage"];

    $doctor_data=$doctor_data.'<div class="doctor-serial-parent">
    <div class="doctor-serial">'.$doctorname.'</div>
    <img class="frame-child" alt="" src="'.$doctorimg.'" />

    <div class="shortdescriptiontext1">'.$doctorinfo.'</div>
    <div class="learnmorebtn1">
      <div class="signupbg1"></div>
      <b class="learn-more-1">Learn More -&gt;</b>
    </div>
    <div class="frame-item"></div>
  </div>';
}
}else{
    $data='div class="appointmentstepsheading">
    No Doctor Found in Your Area 
  </div>';
}

}else{
    $data='div class="appointmentstepsheading">
    Bad Query
  </div>';
}

$data=$data.$doctor_data;
echo $data;

?>