<?php

class Acount {
    private $id;

    private $name;

    private $authenticated;

    public function __construct() {
        $this->id = NULL;
        $this->name = NULL;
        $this->authenticated = FALSE;
    }

    public function __destruct() {

    }

    public function addAccount(string $name, string $password): int {
        
        global $pdo;

        // verify if this account already exist
        if (!is_null($this->getIdFromName($name)))
        {
            throw new Exception('User name not available');
        }

        // insert query 
        // $query = 'INSERT INTO myschema.accounts (acount_name, acount_password) VALUES (:name, password)';
        
        $values = array(':name' => $name, ':password' => $password);

        // execute the query
        try {
            $res = $pdo->prepare($query);
		    $res->execute($values);
        }
        catch (PDOException $e)
        {
            /* If there is a PDO exception, throw a standard exception */
            throw new Exception('Database query error');
        }

        return $pdo->lastInsertId();

    }

    /* Returns the account id having $name as name, or NULL if it's not found */
    public function getIdFromName(string $name): ?int {
        /* Global $pdo object */
        global $pdo;
        
        /* Since this method is public, we check $name again here */
        if (!$this->isNameValid($name))
        {
            throw new Exception('Invalid user name');
        }
        
        /* Initialize the return value. If no account is found, return NULL */
        $id = NULL;
        
        /* Search the ID on the database */
        $query = 'SELECT account_id FROM myschema.accounts WHERE (account_name = :name)';
        $values = array(':name' => $name);
        
        try
        {
            $res = $pdo->prepare($query);
            $res->execute($values);
        }
        catch (PDOException $e)
        {
        /* If there is a PDO exception, throw a standard exception */
        throw new Exception('Database query error');
        }
        
        $row = $res->fetch(PDO::FETCH_ASSOC);
        
        /* There is a result: get it's ID */
        if (is_array($row))
        {
            $id = intval($row['account_id'], 10);
        }
        
        return $id;
    }
}