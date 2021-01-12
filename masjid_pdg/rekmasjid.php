<?php
  include('connect.php');
    $lay	  = $_GET['lay'];
    $hasilx  = explode(',',$lay);
    $dumb   = count($hasilx);
    $dataarray = [];
      // var_dump($hasilx);
      for($i=0;$i<$dumb;$i++)
      {      
        if($hasilx[$i]=="check_r"){
          $querysearch= "Select distinct worship_place.name as worship_place_name, restaurant.name as restaurant_name, st_x(st_centroid(worship_place.geom)) as lng, st_y(st_centroid(worship_place.geom)) as lat,
          st_distance_sphere(
            ST_GeomFromText(concat
              ('POINT(
                ',ST_Y(ST_CENTROID(worship_place.geom)),' 
                ',ST_X(ST_Centroid(worship_place.geom)),')'), 4326),
            ST_GeomFromText(concat
              ('POINT(
                ',ST_Y(ST_CENTROID(restaurant.geom)),' 
                ',ST_X(ST_Centroid(restaurant.geom)),')'), 4326)) as jarak 
          from worship_place,detail_worship_place, angkot, detail_restaurant, restaurant where 
          worship_place.id = detail_worship_place.id_worship_place and
          detail_worship_place.id_angkot = angkot.id and
          angkot.id = detail_restaurant.id_angkot and
          detail_restaurant.id_restaurant = restaurant.id order by jarak ASC limit 100";
          $hasil=mysqli_query($conn, $querysearch);
          while($row = mysqli_fetch_array($hasil))
            {
              $worship_name=$row['worship_place_name'];
              $rest_name=$row['restaurant_name'];
              $jarak=$row['jarak'];
              $longitude=$row['lng'];
              $latitude=$row['lat'];
              $dataarray[]=array(
                  'worship_place_name'=>$worship_name,
                  'restaurant_name'=>$rest_name,
                  'jarak'=>$jarak,
                  'longitude'=>$longitude,
                  'latitude'=>$latitude
              );
            }
        } elseif($hasilx[$i]=="check_t"){
          $querysearch = "Select distinct worship_place.name as worship_place_name, tourism.name as tourism_name,
          st_x(st_centroid(worship_place.geom)) as lng, st_y(st_centroid(worship_place.geom)) as lat, 
          st_distance_sphere(
            ST_GeomFromText(concat
              ('POINT(
                      ',ST_Y(ST_CENTROID(worship_place.geom)),' 
                      ',ST_X(ST_Centroid(worship_place.geom)),')'), 4326),
            ST_GeomFromText(concat
              ('POINT(
                      ',ST_Y(ST_CENTROID(tourism.geom)),' 
                      ',ST_X(ST_Centroid(tourism.geom)),')'), 4326)) as jarak 
            from worship_place, detail_worship_place, angkot, detail_tourism, tourism where
            detail_worship_place.id_worship_place=worship_place.id and
            angkot.id=detail_worship_place.id_angkot and
            detail_tourism.id_angkot=angkot.id and
            detail_tourism.id_tourism=tourism.id order by jarak ASC limit 35";                  
            $hasil=mysqli_query($conn, $querysearch);
            while($row = mysqli_fetch_array($hasil))
              {
                $worship_name=$row['worship_place_name'];
                $tourism_name=$row['tourism_name'];
                $jarak=$row['jarak'];
                $longitude=$row['lng'];
                $latitude=$row['lat'];
                $dataarray[]=array(
                    'worship_place_name'=>$worship_name,
                    'restaurant_name'=>$tourism_name,
                    'jarak'=>$jarak,
                    'longitude'=>$longitude,
                    'latitude'=>$latitude
                );
              }
        } elseif($hasilx[$i]=="check_s"){
          $querysearch = "Select distinct worship_place.name as worship_place_name, souvenir.name as souvenir_name, 
          st_x(st_centroid(worship_place.geom)) as lng, st_y(st_centroid(worship_place.geom)) as lat,
          st_distance_sphere(
            ST_GeomFromText(concat
              ('POINT(
                      ',ST_Y(ST_CENTROID(worship_place.geom)),' 
                      ',ST_X(ST_Centroid(worship_place.geom)),')'), 4326),
            ST_GeomFromText(concat
              ('POINT(
                      ',ST_Y(ST_CENTROID(souvenir.geom)),' 
                      ',ST_X(ST_Centroid(souvenir.geom)),')'), 4326)) as jarak 
            from worship_place, detail_worship_place, angkot, detail_souvenir, souvenir where
            detail_worship_place.id_worship_place=worship_place.id and
            angkot.id=detail_worship_place.id_angkot and
            detail_souvenir.id_angkot=angkot.id and
            detail_souvenir.id_souvenir=souvenir.id order by jarak ASC limit 55"; 
            $hasil=mysqli_query($conn, $querysearch);
            while($row = mysqli_fetch_array($hasil))
            {
              $worship_name=$row['worship_place_name'];
              $souvenir_name=$row['souvenir_name'];
              $jarak=$row['jarak'];
              $longitude=$row['lng'];
              $latitude=$row['lat'];
              $dataarray[]=array(
                    'worship_place_name'=>$worship_name,
                    'restaurant_name'=>$souvenir_name,
                    'jarak'=>$jarak,
                    'longitude'=>$longitude,
                    'latitude'=>$latitude
              );
            }
        } else if($hasilx[$i]=="check_h"){
          $querysearch = "Select distinct worship_place.name as worship_place_name, hotel.name as hotel_name, 
          st_x(st_centroid(worship_place.geom)) as lng, st_y(st_centroid(worship_place.geom)) as lat,
          st_distance_sphere(
            ST_GeomFromText(concat
              ('POINT(
                ',ST_Y(ST_CENTROID(worship_place.geom)),' 
                ',ST_X(ST_Centroid(worship_place.geom)),')'), 4326),
            ST_GeomFromText(concat
              ('POINT(
                ',ST_Y(ST_CENTROID(hotel.geom)),' 
                ',ST_X(ST_Centroid(hotel.geom)),')'), 4326)) as jarak 
            from worship_place, detail_worship_place, angkot, detail_hotel, hotel where
            detail_worship_place.id_worship_place=worship_place.id and
            angkot.id=detail_worship_place.id_angkot and
            detail_hotel.id_angkot=angkot.id and
            detail_hotel.id_hotel=hotel.id order by jarak ASC limit 50";
            $hasil=mysqli_query($conn, $querysearch);
            while($row = mysqli_fetch_array($hasil))
              {
                $worship_name=$row['worship_place_name'];
                $hotel_name=$row['hotel_name'];
                $jarak=$row['jarak'];
                $longitude=$row['lng'];
                $latitude=$row['lat'];
                $dataarray[]=array(
                    'worship_place_name'=>$worship_name,
                    'restaurant_name'=>$hotel_name,
                    'jarak'=>$jarak,
                    'longitude'=>$longitude,
                    'latitude'=>$latitude
                    );
              }
          }
      }
        echo json_encode ($dataarray);
?>