<?php

$path = "../databases/database.sqlite";

//$path = "/home/tevaearai/Documents/HEIG-VD/BA5/STI/Projet1Git/STI_projet1/site/databases/database.sqlite";

/*
try {
    $db = new PDO('sqlite:../databases/database.sqlite');
} catch(PDOException $e) {
    echo $e->getMessage();
}
*/

class DB extends SQLite3 {
    function __construct()  {
        $this->open('../databases/database.sqlite');
    }
 }

$db = new DB();

if(!$db) {
    echo $db->lastErrorMsg();
}
/* else {
    echo "Opened database successfully\n";
}
*/
/*

 $sql =<<<EOF
    CREATE TABLE COMPANY
    (ID INT PRIMARY KEY     NOT NULL,
    NAME           TEXT    NOT NULL,
    AGE            INT     NOT NULL,
    ADDRESS        CHAR(50),
    SALARY         REAL);
EOF;

$ret = $db->exec($sql);

if(!$ret){
 echo $db->lastErrorMsg();
} else {
 echo "Table created successfully\n";
}

$sql =<<<EOF
INSERT INTO COMPANY (ID,NAME,AGE,ADDRESS,SALARY)
VALUES (1, 'Paul', 32, 'California', 20000.00 );

INSERT INTO COMPANY (ID,NAME,AGE,ADDRESS,SALARY)
VALUES (2, 'Allen', 25, 'Texas', 15000.00 );

INSERT INTO COMPANY (ID,NAME,AGE,ADDRESS,SALARY)
VALUES (3, 'Teddy', 23, 'Norway', 20000.00 );

INSERT INTO COMPANY (ID,NAME,AGE,ADDRESS,SALARY)
VALUES (4, 'Mark', 25, 'Rich-Mond ', 65000.00 );
EOF;

$ret = $db->exec($sql);
if(!$ret) {
echo $db->lastErrorMsg();
} else {
echo "Records created successfully\n";
}
*/
$username = $_POST['username'];
$password = $_POST['password'];

$sql =<<<EOF
SELECT * from ACCOUNT
WHERE USERNAME = "$username";
EOF;

$ret = $db->query($sql);

$row = $ret->fetchArray(SQLITE3_ASSOC);

$usr = $row['USERNAME'];
$pwd = $row['PASSWORD'];

if (!$usr) {
    echo 'Invalid login';
} else if ($password != $pwd) {
    echo 'fuk';
} else {
    //donner une session valide
    header("Location: welcome.php");
}

/*
$ret = $db->query($sql);
while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
    echo "USENAME = ". $row['USERNAME'] . "\n";
    echo "PASSWORD = ". $row['PASSWORD'] ."\n";
    echo "VALIDITY = ". $row['VALIDITY'] ."\n";
    echo "STATUS = ".$row['STATUS'] ."\n\n";
}

*/

$db->close();

?>