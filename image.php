<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Image = file_get_contents($_FILES['Image']['tmp_name']);
    $database = new Database();
    $query = "INSERT INTO test (
        Id,
        Image
        ) VALUES (
        :Id,
        :Image
        )
    ;";
    $database->query($query);
    $database->bind(':Id', 1);
    $database->bind(':Image', $Image);
    $database->execute();
}
?>

<div class="imgs">
    <?php
    $database = new Database();
    $query = "SELECT * FROM test ;";
    $database->query($query);
    $rows = $database->resultset();
    foreach ($rows as $row) {
        echo '<img src="data:image/jpeg;base64,'.base64_encode($row->Image).'"/>';
    }

    ?>
</div>
