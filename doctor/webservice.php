<?php
$search_param=$_POST["search"];
$search_area=$_POST["area"];

if(isset($_POST["search"]) && isset($_POST["area"])){

    // echo $search_param;
    // echo $search_area;
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
  while($row = $result->fetch_assoc()){
    $doctorid = $row["id"];
    $doctorname = $row["Doctorname"];
    $doctorinfo = $row["Doctorinformation"];
    $doctorimg = $row["Doctorimage"];

    $doctor_data["DocName"]=$doctorname;
    $doctor_data["DocInfo"]=$doctorinfo;
    $doctor_data["DocImage"]=$doctorimg;

    $data[$doctorid] =$doctor_data;
  }
  $data["Result"]="True";
  $data["Message"]="Doctors fetched Successfully";
}else{
    $data["Result"]="false";
    $data["Message"]="No Doctors found";
}

}else{
    $data["Result"]="false";
    $data["Message"]="Bad Query";
}

// sending response back to the user
echo json_encode($data,JSON_UNESCAPED_SLASHES);
?>