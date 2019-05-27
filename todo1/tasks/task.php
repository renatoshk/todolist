<?php require_once("../login/db.php");
foreach ($_POST["value"] as $key => $value) {
    $data["position"]=$key+1;
    updatePosition($data, $value);
}
echo "Sorting Done";
function updatePosition($data,$id){
    global $connection;
    if(array_key_exists("Name", $data)){
        $data["Name"]=$this->real_escape_string($data["Name"]);
       }
    foreach ($data as $key => $value) {
        $value="'$value'";
        $updates[]="$key=$value";
       }
    $imploadAray=  implode(",", $updates);
    $query="Update tasks Set $imploadAray Where tasks_id='$id'";
    $result=  mysqli_query($connection,$query) or die(mysqli_error($connection));
      if($result){
            return true;
           }
     else
           {
            return "Error while updating position";
           }
}
