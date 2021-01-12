<?php

	include('connect.php');
    $latit  = $_GET['lat'];
    $longi  = $_GET['long'];
	$rad    =$_GET['rad'];
	$dataarray =[];

	$querysearch="SELECT id, name, owner, cp, address, id_souvenir_type, employee, ST_X(ST_Centroid(geom)) AS lng, ST_Y(ST_CENTROID(geom)) As lat, st_distance_sphere(ST_GeomFromText('POINT($latit $longi)', 4326), ST_GeomFromText(concat('POINT(',ST_Y(ST_CENTROID(geom)),' ',ST_X(ST_Centroid(geom)),')'), 4326)) as jarak from souvenir where st_distance_sphere(ST_GeomFromText('POINT($latit $longi)', 4326), ST_GeomFromText(concat('POINT(',ST_Y(ST_CENTROID(geom)),' ',ST_X(ST_Centroid(geom)),')'), 4326)) <= $rad";
	$hasil=mysqli_query($conn,$querysearch);

        while($baris = mysqli_fetch_array($hasil))
            {
                $id=$baris['id'];
                $name=$baris['name'];
                $owner=$baris['owner'];
                $cp=$baris['cp'];
                $address=$baris['address'];
                $id_souvenir_type=$baris['id_souvenir_type'];
                $employee=$baris['employee'];
                $longitude=$baris['lng'];
                $latitude=$baris['lat'];
                $dataarray[]=array(
                    'id'=>$id,
                    'name'=>$name,
                    'owner'=>$owner,
                    'cp'=>$cp, 
                    'address'=>$address,
                    'id_souvenir_type'=>$id_souvenir_type, 
                    'employee'=>$employee,  
                        "latitude"=>$latitude,
                        "longitude"=>$longitude);
            }
        echo json_encode ($dataarray);
?>