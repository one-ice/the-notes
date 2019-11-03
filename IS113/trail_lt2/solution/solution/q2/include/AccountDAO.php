<?php

require_once 'common.php';

class AccountDAO {

  // This method checks to see if an account with $username exists in the database 'account' table.
  // If it exists, it returns an Account object.
  // Else, it returns null.
  public function retrieve($username) {
    // skeleton SQL
    $sql = "SELECT * FROM account where username = :username";

    $connMgr = new ConnectionManager();
    $conn = $connMgr->getConnection();

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

    while($row = $stmt->fetch()) {
        return new Account( $row['id'], $row['fullname'], $row['username'], $row['password_hash'] );
    }

    $stmt = null;
    $conn = null;

    return null;
  }

  // This method authenticates the account given username & password (from user form - in plain text).
  // Returns true if username & password_hash combination is correct.
  // Otherwise, returns false.
  // Please make use of retrieve() method above.
  public function authenticate($username, $password) {

    $account = $this->retrieve($username);
    // No account with $username was found in Database.
    // Return false.
    if(!$account) {
      return false;
    }

    // Account with $username is found.
    // Now, do authentication.
    $password_hash = $account->getPassword_hash();
    if( password_verify($password, $password_hash) ) {
      // password is correct
      return true;
    }

    return false;
  }

  // Question 2 - Part B
  // [TODO] Code here to reset the user's password.
  // Input 1: Account ID (database table Account ID, integer)
  // Input 2: New Password (string)
  public function reset_password($id, $new_password) {
    $sql = 'UPDATE Account SET password_hash = :new_password WHERE id = :id';

    $connMgr = new ConnectionManager();
    $conn = $connMgr->getConnection();

    $stmt = $conn->prepare($sql);
    
    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
    $stmt->bindParam(':new_password', $password_hash, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $status = $stmt->execute();
    $stmt = null;
    $conn = null;

    return $status;
  }

}

?>
