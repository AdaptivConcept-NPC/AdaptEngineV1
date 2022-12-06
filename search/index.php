<?php
session_start();

include('../scripts/php/config.php');
include('../scripts/php/functions.php');

/* if (isset($_GET['process'])) {
    echo "Process: " . $_GET['process'] . "<br>";
}


if (isset($_GET['q'])) {
    echo "Query:" . $_GET['q'] . "<br>";
} */

try {
    $query = "SELECT * FROM `index` ORDER BY id DESC LIMIT 500";

    $result = $db->query($query);

    if (!$result) die("A Fatal Error has occured. Please reload the page, and if the problem persists, please contact the system administrator.");

    $rows = $result->num_rows;

    $html_output_latest = $output_id = $output_title = $output_description = $output_typetopic = $output_keywords = $output_url = $output_urlhash = $output_imageurl = "";

    for ($j = 0; $j < $rows; ++$j) {
        $row = $result->fetch_array(MYSQLI_ASSOC);

        $output_id = htmlspecialchars($row['id']);
        $output_title = htmlspecialchars($row['title']);
        $output_description = htmlspecialchars($row['description']);
        $output_typetopic = htmlspecialchars($row['type_topic']);
        $output_keywords = htmlspecialchars($row['keywords']);
        $output_url = htmlspecialchars($row['url']);
        $output_urlhash = htmlspecialchars($row['url_hash']);
        $output_imageurl = htmlspecialchars($row['image_url']);

        $html_output_latest .= <<<_END
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-lg-4">
                <img src="..." class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-lg-8">
                <div class="card-body">
                    <h5 class="card-title text-wrap truncate"><a href="$output_url" target="_blank">$output_title</a></h5>
                    <p class="card-text">$output_description</p>
                    <p class="card-text"><small class="text-muted">Last updated ? mins ago</small></p>
                </div>
                </div>
            </div>
        </div>
        _END;
    }
} catch (\Throwable $th) {
    //throw $th;
    die("An exception has occurred while processing your request: [ " . $th->getMessage() . " ]");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdaptEngine&trade;_ZA | Curated Research Engine &copy; <?php echo date('Y'); ?></title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
    <!-- The fixed navbar will overlay your other content, unless you add padding to the bottom of the <body>. Tip: By default, the navbar is 50px high.  -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark p-4 shadow">
        <a class="navbar-brand" href="#">AdaptEngine&trade;_ZA | Curated Research Engine</a>
        <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
       </button>-->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav mr-auto justify-content-end">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Sign In <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>

    <!---->
    <nav class="navbar navbar-expand-lg fixed-bottom bg-transparentz p-4 shadow text-right">
        <p class="m-0"><?php echo "Crafted by AdaptivConcept &copy; " . date('Y'); ?></p>
    </nav>

    <div class="container-fluid h-100" style="padding-top: 150px; padding-bottom: 150px;">
        <div class="row">
            <div class="col-8"></div>
            <div class="col-4">
                <h3>Latest Index</h3>
                <?php echo $html_output_latest; ?>
            </div>
        </div>
    </div>
</body>

</html>