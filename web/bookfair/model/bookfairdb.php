<?php

function getbookfair($id,$db){
    //echo "id:".$id;
    $stmt = $db->prepare("SELECT b.*, concat_ws(' ', bu.first_name::text, bu.last_name::text) AS primary_user 
        FROM bookfair b LEFT OUTER JOIN bookfairuser bu 
        ON bu.user_id = b.primary_user_id where b.bookfair_id =  :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($rows);
    $row = $rows[0];
    
    return $row;
}


function getallschools($db) {
    
    $stmt = $db->prepare("SELECT * from school");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    return $rows;
}


function addnewbookfair($description, $school_id, $user_id, $start_date, $end_date, $set_up_date, $db){
    $stmt = $db->prepare('INSERT INTO bookfair (description, school_id, primary_user_id, start_date,
    end_date, set_up_date) VALUES (:description, :school_id, :userid, :start_date, :end_date, :set_up_date) ');
    $stmt->bindValue(':userid', $user_id, PDO::PARAM_INT);
    $stmt->bindValue(':description', $description, PDO::PARAM_STR);
    $stmt->bindValue(':school_id', $school_id, PDO::PARAM_INT);
    $stmt->bindValue(':start_date', $start_date, PDO::PARAM_STR);
    $stmt->bindValue(':end_date', $end_date, PDO::PARAM_STR);
    $stmt->bindValue(':set_up_date', $set_up_date, PDO::PARAM_STR);
    $stmt->execute();
    $result=$stmt->rowCount();
    $stmt->closeCursor();
    return $result;
    
}



function getuserbookfairs($id,$db){
    
    $stmt = $db->prepare("SELECT b.*, concat_ws(' ', bu.first_name::text, bu.last_name::text) AS current_user,
        s.school_name
        FROM bookfairuser bu INNER JOIN userschool us on bu.user_id=us.user_id INNER JOIN bookfair b 
        ON b.school_id = us.school_id INNER JOIN school s on s.school_id = b.school_id WHERE bu.user_id =  :id
        ORDER BY s.school_name, b.bookfair_id ");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    return $rows;
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

function countbookfairdays($id, $db){
    $stmt2 = $db->prepare('SELECT Count(*) as num_days FROM bookfairday WHERE bookfair_id=:id');
    $stmt2->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt2->execute();
    $row = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    $daycount= $row[0]['num_days'];
    return $daycount;
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
          report_total_sales::numeric::float8 AS frtotal,
          initial_balance::numeric::float8 AS initial_balance
        FROM bookfairday WHERE bookfair_id =  :id and sequence_no = :sequence");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':sequence', $sequence, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $row = $rows[0];
    
    return $row;

}

function insert_user($first_name,$last_name,$username,$password,$db)
        {  
    $query = 'INSERT INTO bookfairuser(user_name, first_name, last_name, password)
            VALUES (:username, :firstname, :lastname, :password)' ;

    $statement=$db->prepare($query);
    $statement->bindValue(':username',$username);
    $statement->bindValue(':firstname',$first_name);
    $statement->bindValue(':lastname',$last_name);
    $statement->bindValue(':password',$password);
    $statement->execute();
    $result=$statement->rowCount();
    $statement->closeCursor();
    return $result;
}

function adduserschool($userid, $schoolid, $db){
    
    $query = 'INSERT INTO userschool(user_id, school_id, active)
            VALUES (:userid, :schoolid, true)' ;

    $statement=$db->prepare($query);
    $statement->bindValue(':userid',$userid);
    $statement->bindValue(':schoolid',$schoolid);
    $statement->execute();
    $result=$statement->rowCount();
    $statement->closeCursor();
    return $result;
    
    
}

function  removeuserschool($userid, $schoolid, $db){
    $query = 'DELETE FROM userschool WHERE user_id= :userid
        AND school_id =:schoolid' ;

    $statement=$db->prepare($query);
    $statement->bindValue(':userid',$userid);
    $statement->bindValue(':schoolid',$schoolid);
    $statement->execute();
    $result=$statement->rowCount();
    $statement->closeCursor();
    return $result;
}


function login_user($login,$db){
    $query = 'SELECT * FROM bookfairuser
              WHERE user_name = :login';    
    $statement = $db->prepare($query);
    $statement->bindValue(':login', $login);
    $statement->execute();    
    $data = $statement->fetch();
    $statement->closeCursor();    
    
    return $data;
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