<?php
    session_start();
    $bulk = new MongoDB\Driver\BulkWrite;
    include '../connect/db.inc.php';
    date_default_timezone_set("Asia/Kolkata");
    $id = $_POST["id"];
    $bidder = $_POST["bidder"];
    $bid = $_POST["bid"];
    
    $filterbid = ['itemid' => new MongoDB\BSON\ObjectId($id)];
    $options = ['sort' => ['bidamt' => 1]];
    try{
        $querybid = new MongoDB\Driver\Query($filterbid, $options);
        $bids = $manager->executeQuery($dbbids, $querybid);

        $cursorArray = $bids->toArray();
        if(isset($cursorArray[0])) {
            $prebid = $cursorArray[0]->bidamt;
            echo $prebid;
            if ((int)$prebid < (int)$bid){
                $newbid = [
                    '_id' => new MongoDB\BSON\ObjectId,
                    'itemid' => new MongoDB\BSON\ObjectId($id),
                    'bidder' => $bidder,
                    'bidamt' => $bid,
                    'date' =>  date("Y-m-d"),
                    'time' => date("h:i:sa")
                ];
            
            
                    $bulk->insert($newbid);
                    $result = $manager->executeBulkWrite($dbbids, $bulk);
                    header('Location: ../views/itemdetails.php?id='.$id.'');
            } else {
                $_SESSION["message"] = "Bid Should be greater than last bid";
                header('Location: ../views/itemdetails.php?id='.$id.'');
            }
        } else if($bid > 0) {
            $newbid = [
                '_id' => new MongoDB\BSON\ObjectId,
                'itemid' => new MongoDB\BSON\ObjectId($id),
                'bidder' => $bidder,
                'bidamt' => $bid,
                'date' =>  date("Y-m-d"),
                'time' => date("h:i:sa")
            ];
        
            $bulk->insert($newbid);
            $result = $manager->executeBulkWrite($dbbids, $bulk);
            header('Location: ../views/itemdetails.php?id='.$id.'');
        } else {
            $_SESSION["message"] = "Bid Should be greater than 0";
            header('Location: ../views/itemdetails.php?id='.$id.'');
        }
    }
    catch(MongoDB\Driver\Exception\Exception $e) {
        die("Error".$e);
    }
?>