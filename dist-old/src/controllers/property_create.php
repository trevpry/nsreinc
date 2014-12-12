<?php namespace nsreinc;
session_start();

require('../../vendor/autoload.php');

use nsreinc\models\Property;

if ($_SESSION['logged_in']){
    $upload_dir = '../../images/properties/';
    $uploaded = 'false';
    $image_file = $upload_dir . 'property-2.jpeg';

    $property = new Property();
    $property->create($_POST);
    $status = $property->save();
    $property_data = $property->get_property_data();

//echo $property_data;

    if ($status == 'success'){
        if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . 'property-' . $property_data['id'] . '.jpeg')){
            $uploaded = 'true';
        }
    }

//echo json_encode($uploaded);
    echo json_encode(array('saved' => $status, 'imageUploaded' => $uploaded, 'propertyData' => $property_data));
} else {
    echo json_encode(array('error' => 'User not logged in'));
}

