<?php require_once("../login/db.php");

foreach ($_POST["value"] as $key => $value) {
    $data["position"]=$key+1;
    updatePositionlist($data, $value);
}
echo "Sorting Done";
function updatePositionlist($data,$id){
    global $connection;
    if(array_key_exists("Name", $data)){
        $data["Name"]=$this->real_escape_string($data["Name"]);
    }
    foreach ($data as $key => $value) {
        $value="'$value'";
        $updates[]="$key=$value";
    }
    $imploadAray=  implode(",", $updates);
    $query="Update task Set $imploadAray Where task_id='$id'";
    $result=  mysqli_query($connection,$query) or die(mysqli_error($connection));
        if($result){
            return true;
        }
        else
        {
            return "Error while updating position";
        }
}
