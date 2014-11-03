<div class="slide" id="slide6">
    <div class = "content-top">
        <div class="panel panel-left">
            <?php
            require('../../vendor/autoload.php');
            $query = $_GET["query"];

            if ($query != ''){
                $test = new nsreinc\models\Test();
                $rows = $test->body($query);

                if ($rows->num_rows > 0) {
                    foreach ($rows as $row) {
                        echo $row['body'] . '<br>';
                    }
                } else {
                    echo 'No results found';
                }
            }
            ?>
        </div>
        <div class="panel panel-center-left">Some stuff here</div>
        <div class="panel panel-center-right">Some stuff here</div>
        <div class="panel panel-right">Some stuff here</div>
    </div>
    <div class="content-main">
        <div class="panel panel-left">Some stuff here</div>
        <div class="panel panel-center-left">Some stuff here</div>
        <div class="panel panel-center-right">Some stuff here</div>
        <div class="panel panel-right">Some stuff here</div>
    </div>

</div>