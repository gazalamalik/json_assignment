<?php
include 'dbConnection.php';

$db = new DB();


$jsonCont = file_get_contents('https://raw.githubusercontent.com/khkwan0/countryCityStateJson/master/lib/compiledCities.json');


$content = json_decode($jsonCont, true);

foreach($content as $key => $value) {
    $country_id=$key;
    foreach($value as $set1 => $set2){
       if($set1=='name'){ $name=$set2; }
       if($set1=='native') { $native=$set2; }
       if($set1=='phone') { $phone=$set2; }
       if($set1=='continent') { $continent=$set2; }
       if($set1=='capital') { $capital=$set2; }
       if($set1=='currency') { $currency=$set2; }
       if($set1=='emoji') { $emoji=$set2; }
       if($set1=='emojiU') { $emojiU=$set2; }
       
        //loop for state values;

        foreach($set2 as $state => $city){
            $state_name= $state;
            if($city == NULL){
                // insert into states if no city is present

                 $sql="INSERT INTO state (country_id,state_name) VALUES ('$country_id','$state')";
                 $ret=$db->query($sql);
            
             }
             else {
                
             foreach($city as $city1 => $city2){
                foreach($city2 as $value1 => $value2){
                    if($value1=='id'){ $id=$value2;}
                    if($value1=='name'){$cityname=$value2;}
                    if($value1=='state_id'){$stateid=$value2;}

                    //insert into city table

                    $sql="INSERT INTO city (id, name, state_id) VALUES ('$id', '$cityname', '$stateid')";
                    $ret=$db->query($sql);
                    //print_r($ret);
                //echo $state_name." => ".$value1." => ".$value2."<br>";    
                }
        }

        $sql="INSERT INTO state (country_id,state_name) VALUES ('$country_id', '$state')";
        $ret=$db->query($sql);
        //print_r($ret);
             }
     
        }
        //echo $key . " => " . $set1 ." => ".$set2. "<br>";
  
    }

    //INSERT INTO COUNTRY TABLE

    
     $sql="INSERT INTO country (country_id, name, native, phone, continent, capital, currency, emoji, emojiU)
           VALUES ('$country_id', '$name', '$native', '$phone', '$continent', '$capital', '$currency', '$emoji', '$emojiU')";

     $ret=$db->query($sql);
    // print_r($ret);
          
}
?>