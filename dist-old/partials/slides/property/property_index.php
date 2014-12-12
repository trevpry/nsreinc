<?php
session_start();
require('../../../vendor/autoload.php');

$page = $_GET['name'];

$properties = new nsreinc\models\Property();
$rows = $properties->findByPropertyType($page, array('sort' => 'desc'));

function showProperties($row, $visibility){
    $image_path = 'images/properties/property-' . $row->id . '.jpeg';
    $admin = '';
    if ($_SESSION['logged_in']){
        $admin = '<div class="admin">
                <div id="edit">Edit</div>
                <div id="delete">Delete</div>
            </div>';
    }

    echo '<div class="property border-bottom ' . $visibility .'" id="' . $row->id . '">

            <div class="property-image"><img src="' . $image_path. '"></div>
                <div class="property-details">
                <p class="property-status"><span class="label">Status: </span><span class="detail">' . $row->status .'</span></p>
                <p class="property-price"><span class="label">Price: </span><span class="detail">'. money_format('%n', $row->listing_price) .'</span></p>
                <p class="property-type"><span class="label">Property Type: </span><span class="detail">'. $row->property_type .'</span></p>
                <p class="property-location"><span class="label">Location: </span><span class="detail">'.
        $row->city
        .'</span></p>

                <ul class="highlights-list"><span class="label">Highlights: </span><span class="detail">'. $row->highlights .'</span></ul>
            </div>'.
        $admin .
        '</div>';
};

setlocale(LC_MONETARY, 'en_US');
?>

<div class="slide-page" id="slide3">

    <?php if ($_SESSION['logged_in']){
        echo
        '<div class="form-add-property">
            <h3 class="add-link">Add new Property</h3> <br>
            <div class="validate-tips"></div>
            <form class="property-form add-property create form-dialog">
                <div><label for="status">Status:</label><input type="text" id="status" name="status"></div>
                <div><label for="listing_price">Price:</label><input type="text" id="listing-price" name="listing_price"></div>
                <div><label for="property-type">Property Type:</label><input type="text" id="property-type" name="property_type" value="' . $page . '"></div>
                <div><label for="city">Location:</label><input type="text" id="city" name="city"></div>
                <div><label for="highlights">Highlights:</label><textarea rows="5" cols="30" id="highlights" name="highlights"></textarea></div>
                <div><label for="image">Image:</label><input type="file" id="image" name="image"></div>
                <div><input type="submit" id="submit"></div>
            </form>

            <form class="property-form edit-property update form-dialog">
                <div><input type="hidden" id="id" name="id"></div>
                <div><label for="status">Status:</label><input type="text" id="status" name="status"></div>
                <div><label for="listing-price">Price:</label><input type="text" id="listing-price" name="listing_price"></div>
                <div><label for="property-type">Property Type:</label><input type="text" id="property-type" name="property_type"></div>
                <div><label for="city">Location:</label><input type="text" id="city" name="city"></div>
                <div><label for="highlights">Highlights:</label><textarea rows="5" cols="30" id="highlights" name="highlights"></textarea></div>
                <div><label for="image">Image:</label><input type="file" id="image" name="image"></div>
                <div><input type="submit" id="submit"></div>
            </form>
        </div>';
    }?>

    <div class="property-list">
    <?php
    //var_dump($rows->fetch_object());
//    while($row = $rows->fetch_object()){
//        //var_dump($row);
//        echo $row->id;
//        echo '<br>';
//    }

//    foreach ($rows as $row){
//        showProperties($row, 'visible');
//    }
    while($row = $rows->fetch_object()){
        showProperties($row, 'visible');
    }

    showProperties(array(
        'id' => 0,
        'status' => '',
        'listing_price' => 0,
        'property_type' => '',
        'location' => '',
        'highlights' => ''
    ), 'hidden');

    ?>
    </div>
</div>