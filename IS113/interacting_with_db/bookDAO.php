<?php
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
}
?>