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

function updateinitbalance($id, $dayid, $initbalance, $db){
    if ($id==0) {
         $stmt2 = $db->prepare('UPDATE bookfairday SET 
        initial_balance = :initbalance
        WHERE bookfair_day_id = :dayid');
    $stmt2->bindValue(':dayid', $dayid, PDO::PARAM_INT);
    $stmt2->bindValue(':initbalance', $initbalance, PDO::PARAM_STR);
    $stmt2->execute();
    $result=$stmt2->rowCount();
    $stmt2->closeCursor();
    return $result;
        
    }else{
    
     $stmt = $db->prepare('SELECT sequence_no FROM bookfairday
        WHERE bookfair_day_id = :dayid');
    $stmt->bindValue(':dayid', $dayid, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $sequence_no = $rows[0]['sequence_no'];
    
    $nextsequence_no = $sequence_no + 1;
    //echo $sequence_no;
    //echo $nextsequence_no;
     $stmt2 = $db->prepare('UPDATE bookfairday SET 
        initial_balance = :initbalance
        WHERE bookfair_id = :id AND sequence_no = :sequence_no');
    $stmt2->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt2->bindValue(':sequence_no', $nextsequence_no, PDO::PARAM_INT);
    $stmt2->bindValue(':initbalance', $initbalance, PDO::PARAM_STR);
    $stmt2->execute();
    $result=$stmt2->rowCount();
    $stmt2->closeCursor();
    return $result;
    }
    
}


function getdailyfinancialinfo($bookfairdayid, $db){
    $stmt = $db->prepare('SELECT bookfair_date , report_cash_amount::numeric::float8 AS report_cash_amount, 
    report_credit_amount::numeric::float8 AS report_credit_amount,
    report_num_receipts, report_total_sales::numeric::float8 AS report_total_sales, 
    actual_cash::numeric::float8 AS actual_cash, actual_checks::numeric::float8 AS actual_checks, 
    actual_other::numeric::float8 AS actual_other,
    (actual_cash+actual_checks+actual_other)::numeric::float8 AS total_cash, 
    actual_num_receipts, initial_balance::numeric::float8 AS initial_balance, bookfair_day_id,
    complete FROM bookfairday 
    WHERE bookfair_day_id=:id
    ');
$stmt->bindValue(':id', $bookfairdayid, PDO::PARAM_INT);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function updatecomplete($dayid, $db){
    $stmt2 = $db->prepare('UPDATE bookfairday SET 
        complete = true
        WHERE bookfair_day_id = :dayid ');
    $stmt2->bindValue(':dayid', $dayid, PDO::PARAM_INT);
    $stmt2->execute();
    $result=$stmt2->rowCount();
    $stmt2->closeCursor();
    return $result;
    
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