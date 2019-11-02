<?php
include_once "connMgr.php";
Class BookDAO{
    public function retrievedBook($isbn13){
        # 1.establishing the connection
        # 1.1 Data source name(DSN): database type, host, database name, port
        # 1.2 Create a PDO object: specify DSN, username, and password
        $dsn = "msql:host=localhost;dbname=week11;port=3306";
        $pdo = new PDO($dsn,"root","");

        # 2. prepare the statement object
        # 2.1 a PDO statement object allows you to communicate with a database
        $sql = "select * from book where isbn13 = :isbn13"; # :isbn13 is a place holder

        $stmt = $pdo->prepare($sql);

        # 3.specify return data format
        # 3.1 PDO::FETCH_ASSOC : each matching DB record is retrieved as an associated array with colomn name as keys
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        # 4. substitute values for the placeholders
        $stmt->bindParam(":isbn13",$isbn13,PDO::PARAM_STR);

        #5. send the query to the servername
        $stmt->execute();

        # 6. process the data
        # fetch each matching row as an associative array, retrieve the value using the column 
        if($row = $stmt->fetch()){
            $result = new Book($row['title'],$row["isbn13"],$row['price'])
        }

        #7. free up resourses
        $stmt->closeCursor();
        $pdo = null;
        
        return $result

    }

    public function retrieveAll(){
        $sql = 'SELECT * FROM book ORDER BY isbn13 DESC';
        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = array();

        while($row = $stmt->fetch()){
            $result[] = new Book($row['title'],$row['isbn13'],$row['price'])

        }
        return $result;
    }

    public function add($book){
        $sql = 'INSERT IGNORE INTO book(title,isbn13,price) values (:title,:isbn13,:price)';
        $connMgr = new ConnectionManager();
        $conn = $connMgr->getconnection();

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':title',$book->title,PDO::PARAM_STR);
        $stmt->bindParam(':isbn13',$book->isbn13,PDO::PARAM_STR);
        $stmt->bindParam(':price',$book->price,PDO::PARAM_STR);

        $isAddOK = FALSE;

        if ($stmt->execute()){
            $isAddOK = TRUE;
        }

        return $isAddOK;
    }

    public function update($isbn13,$price){
        $sql = 'UPDATE book SET price = :price where isbn13 =  :isbn13';
        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql)

        $stmt->bindParam(':isbn13',$isbn13,PDO::PARAM_STR);
        $stmt->bindParam(":price",$price,PDO::PARAM_STR);

        $isUpdataOK = FALSE;
        if($stmt->execute()){
            $isUpdateOK = TRUE;
        }
        return $isUpdateOK;
    }

    public function remove($isbn13){
        $sql = 'DELETE FROM book WHERE isbn13 = :isbn13';
        $connMgr = new ConnectionManager();
        $conn = $conMgr->getConnected();
        $stmt->bindParam(':isbn13',$isbn13,PDO:PARAM_STR);
        $isRemoveOk = False;
        if ($stmt->execute()) {
            $isRemoveOk = True;
        }

        return $isRemoveOk;
    }

    public function removeAll(){
        $sql = 'TRUNCATE TABLE book';
        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();
        
        $stmt = $conn->prepare($sql);
        $stmt = execute();
        $count = $stmt->rowCount();

        return $count;
    }
}
?>