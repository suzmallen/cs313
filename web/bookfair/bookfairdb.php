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
    $stmt->bindValue('::sequence_no', $sequence, PDO::PARAM_INT);
    $stmt->execute();
    
}

?>