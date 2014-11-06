


<div class="slide" id="slide3">
<h2>Property Index</h2>
    <?php
    require('../../../vendor/autoload.php');

    $properties = new nsreinc\models\Property();
    $rows = $properties->all();

    foreach ($rows as $row){
        echo '<div class="property">
            <span class="title">
                <a href="#property-detail" id="property-detail-link" property-id="' .
                $row['id'] . '">Property Title:
            </a></span>'
            . $row['property_title'] . ' <span class="title">Address: </span>'
            . $row['address'] . '</div><br>';
    }

    ?>
</div>