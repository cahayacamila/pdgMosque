<?php

	include('connect.php');
    $latit = $_GET['lat'];
    $longi = $_GET['lng'];
    $rad=$_GET['rad'];
    
	$dataarray=[];
	$querysearch="SELECT id, name, address, open, close, ticket, id_type, ST_X(ST_Centroid(geom)) AS lng, ST_Y(ST_CENTROID(geom)) As lat,  
    st_distance_sphere(ST_GeomFromText('POINT($latit $longi)', 4326),  
   ST_GeomFromText(concat('POINT(',ST_Y(ST_CENTROID(geom)),' ',ST_X(ST_Centroid(geom)),')'), 4326)) as jarak 
    from tourism where st_distance_sphere(ST_GeomFromText('POINT($latit $longi)', 4326), 
    ST_GeomFromText(concat('POINT(',ST_Y(ST_CENTROID(geom)),' ',ST_X(ST_Centroid(geom)),')'), 4326)) <=$rad ";

    // $querysearch="SELECT id, name, address, open, close, ticket, id_type, ST_X(ST_Centroid(geom)) AS long, ST_Y(ST_CENTROID(geom)) As lat, 
    // st_distance_sphere(ST_GeomFromText('POINT($latit $longi)', 4326), 
    // ST_GeomFromText(concat('POINT(',ST_Y(ST_CENTROID(geom)),' ',ST_X(ST_Centroid(geom)),')'), 4326)) as jarak 
    // from tourism where st_distance_sphere(ST_GeomFromText('POINT($latit $longi)', 4326), 
    // ST_GeomFromText(concat('POINT(',ST_Y(ST_CENTROID(geom)),' ',ST_X(ST_Centroid(geom)),')'), 4326)) <=$rad ";
    //echo $querysearch;
	$hasil=mysqli_query($conn,$querysearch);
    while($baris = mysqli_fetch_array($hasil))
        {
                $id=$baris['id'];
                $name=$baris['name'];
                $address=$baris['address'];
                $open=$baris['open'];
                $close=$baris['close'];
                $ticket=$baris['ticket'];
                $id_type=$baris['id_type'];
                $latitude=$baris['lat'];
                $longitude=$baris['lng'];
                $dataarray[]=array('id'=>$id,'name'=>$name,'address'=>$address,'open'=>$open, 'close'=>$close,'ticket'=>$ticket, 'id_type'=>$id_type, "latitude"=>$latitude,"longitude"=>$longitude);
        }
            echo json_encode ($dataarray);
?>