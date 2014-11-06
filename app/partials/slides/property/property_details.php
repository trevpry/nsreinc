
<div class="slide" id="slide7">
    <h2>Property Details <div>EDIT</div></h2>

    <?php
        require('../../../vendor/autoload.php');

        $property_id = $_GET["query"];

        $property = new nsreinc\models\Property();
        $details = $property->find($property_id);

        foreach($details as $key => $value){
            echo $key . ': ' . $value . "<br>";
        }

    ?>
</div>