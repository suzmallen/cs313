<?php
$id = 3;

$stmt = $db->prepare('SElect s.school_name, b.description as fair_description, start_date, end_date, 
    set_up_date, t.description as fair_type 
    FROM bookfair b INNER JOIN school s on s.school_id = b.school_id
    INNER JOIN type t on b.fair_type = t.type_id
    WHERE b.bookfair_id = :id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$fairs = $stmt->fetchAll(PDO::FETCH_ASSOC);
$fair= $fairs[0];


?>
<h3><?php echo $fair['fair_description']; ?></h3>

<h4>Information:</h4>

<p>School Name: <?php echo $fair['school_name']; ?></p>

<p>Fair Start: <?php echo $fair['start_date']; ?></p>
<p>Fair End: <?php echo $fair['end_date']; ?></p>
<p>Set Up Date: <?php echo $fair['set_up_date']; ?></p>
<p>Fair Type: <?php echo $fair['fair_type']; ?></p>