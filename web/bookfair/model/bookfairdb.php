<?php

function getbookfair($id,$db){
    
    $stmt = $db->prepare("SELECT b.*, concat_ws(' ', bu.first_name::text, bu.last_name::text) AS primary_user 
        FROM bookfair b INNER JOIN bookfairuser bu 
        ON bu.user_id = b.primary_user_id where bookfair_id =  :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $row = $rows[0];
    
    return $row;
}

function getschools($id,$db){
    
    $stmt = $db->prepare('SELECT s.* FROM school s inner join userschool us on s.school_id = us.school_id
            WHERE user_id = :id');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $rows;
}

function getbookfairdays($id, $db){
    $stmt = $db->prepare('SELECT * FROM bookfairday WHERE bookfair_id = :id
    ORDER BY bookfair_date');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $rows;
    
}


function addbookfairday($id, $date, $sequence, $db){
    $stmt = $db->prepare('INSERT INTO bookfairday(bookfair_id, bookfair_date, sequence_no) 
    VALUES(:bookfairid,:date,:sequence_no);');
    $stmt->bindValue(':bookfairid', $id, PDO::PARAM_INT);
    $stmt->bindValue(':date', $date, PDO::PARAM_STR);
    $stmt->bindValue(':sequence_no', $sequence, PDO::PARAM_INT);
    $stmt->execute();
    
}

function deletebookfairday($id, $db){
    $stmt = $db->prepare('delete from bookfairday where bookfair_day_id= :id');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
}

function updatebookfairinfo($id, $description, $school_id, $start_date, $end_date, $set_up_date, $db) {
    $stmt = $db->prepare('UPDATE bookfair SET description = :description, school_id = :school_id, start_date = :start_date, end_date = :end_date, set_up_date = :set_up_date WHERE bookfair_id
     = :bookfairid');
    $stmt->bindValue(':bookfairid', $id, PDO::PARAM_INT);
    $stmt->bindValue(':description', $description, PDO::PARAM_STR);
    $stmt->bindValue(':school_id', $school_id, PDO::PARAM_INT);
    $stmt->bindValue(':start_date', $start_date, PDO::PARAM_STR);
    $stmt->bindValue(':end_date', $end_date, PDO::PARAM_STR);
    $stmt->bindValue(':set_up_date', $set_up_date, PDO::PARAM_STR);
    $stmt->execute();

}

function getbookfairday($id, $sequence, $db){
    $stmt = $db->prepare("SELECT *, non_standard_total::numeric::float8 AS ns_total,
         report_cash_amount::numeric::float8 AS frcash,  report_credit_amount::numeric::float8 AS frcredit,
          report_total_sales::numeric::float8 AS frtotal
        FROM bookfairday WHERE bookfair_id =  :id and sequence_no = :sequence");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':sequence', $sequence, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $row = $rows[0];
    
    return $row;

}

//check to make sure the date is a valid date
function is_date( $str ) {
    if ($str=="") {
        return false;
    }
    else{
       try {
        $dt = new DateTime( trim($str) );
        }
        catch( Exception $e ) {
            return false;
        }
        $month = $dt->format('m');
        $day = $dt->format('d');
        $year = $dt->format('Y');
        if( checkdate($month, $day, $year) ) {
            return true;
        }
        else {
            return false;
        } 
    }
    
}

?>