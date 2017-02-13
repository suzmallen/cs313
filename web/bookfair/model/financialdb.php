<?php
function updatecoins($id, $quarters, $dimes, $nickels, $pennies, $db){

    $stmt = $db->prepare('UPDATE bookfairday SET 
    quarter_count = :quarters, 
    dime_count = :dimes, 
    nickel_count = :nickels, 
    penny_count = :pennies
    WHERE bookfair_day_id
     = :id');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':quarters', $quarters, PDO::PARAM_INT);
    $stmt->bindValue(':dimes', $dimes, PDO::PARAM_INT);
    $stmt->bindValue(':nickels', $nickels, PDO::PARAM_INT);
    $stmt->bindValue(':pennies', $pennies, PDO::PARAM_INT);
    var_dump($stmt);
    var_dump($_POST);
    $stmt->execute();

}

function updatebills($id, $ones, $fives, $tens, $twenties, $fifties, $nstotal, $db)
{
    $stmt = $db->prepare('UPDATE bookfairday SET 
    one_count = :ones, 
    five_count = :fives, 
    ten_count = :tens, 
    twenty_count = :twenties, 
    fifty_count = :fifties, 
    non_standard_total = :nstotal
    WHERE bookfair_day_id
     = :id');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':ones', $ones, PDO::PARAM_INT);
    $stmt->bindValue(':fives', $fives, PDO::PARAM_INT);
    $stmt->bindValue(':tens', $tens, PDO::PARAM_INT);
    $stmt->bindValue(':twenties', $twenties, PDO::PARAM_INT);
    $stmt->bindValue(':fifties', $fifties, PDO::PARAM_INT);
    $stmt->bindValue(':nstotal', $nstotal, PDO::PARAM_STR);
    var_dump($stmt);
    var_dump($_POST);
    $stmt->execute();
    
}

function updateactualcash($id,$total,$db)
{
    $stmt = $db->prepare('UPDATE bookfairday SET 
        actual_cash = :total
    WHERE bookfair_day_id
     = :id');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':total', $total, PDO::PARAM_STR);
    $stmt->execute();
    
}

function updateactualchecks($id,$db)
{    
    $stmt = $db->prepare('UPDATE bookfairday SET 
        actual_checks = (SELECT SUM(amount) FROM bookfairchecks WHERE bookfair_day_id = :id)
    WHERE bookfair_day_id
     = :id');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

function getdaychecks($id,$db)
{
     $stmt = $db->prepare('SELECT bookfair_day_id, checkno, amount::numeric::float8 AS amount FROM bookfairchecks 
     WHERE bookfair_day_id = :id');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $rows;
}

function adddaychecks($id, $checkno, $amount, $db){
    $stmt = $db->prepare('INSERT INTO bookfairchecks(bookfair_day_id, checkno, amount) 
    VALUES(:id,:checkno,:amount)');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':checkno', $checkno, PDO::PARAM_INT);
    $stmt->bindValue(':amount', $amount, PDO::PARAM_STR);
    $stmt->execute();
    
}

 function updateregnumbers($id,$totcash,$totcredit,$totreceipts,$tottotal, $db){
     
    $stmt = $db->prepare('UPDATE bookfairday SET 
       report_cash_amount = :totcash, report_credit_amount = :totcredit,
       report_num_receipts = :totreceipts, report_total_sales = :tottotal 
       WHERE bookfair_day_id = :id');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':totcash', $totcash, PDO::PARAM_STR);
     $stmt->bindValue(':totcredit', $totcredit, PDO::PARAM_STR);
     $stmt->bindValue(':totreceipts', $totreceipts, PDO::PARAM_STR);
     $stmt->bindValue(':tottotal', $tottotal, PDO::PARAM_INT);
    $stmt->execute();
     
 }
?>