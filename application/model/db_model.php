<?php

class DBModel
{
    public $dbHandle;
    // Set up the database source name (DSN)
    private $dsn = 'sqlite:./db/3d-apps.db';

    public function __construct()
    {
        // Then create a connection to a database with the PDO() function
        try {
            // Change connection string for different databases, currently using SQLite
            $this->dbHandle = new \PDO($this->dsn, '', '', array(
                \PDO::ATTR_EMULATE_PREPARES => false,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ));
            // $this->dbHandle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'Database connection created</br></br>';
        } catch (\PDOEXception $e) {
            echo "I'm sorry, I'm afraid I can't connect to the database!";
            // Generate an error message if the connection fails
            print new Exception($e->getMessage());
        }
    }

    public function dropDatabase()
    {
        $db = $this->createDBConnection();
        try {
            $db->exec("DROP TABLE IF EXISTS Model_3D");
            $db->exec("DROP TABLE IF EXISTS SPA_PAGES");
            return "All tables have been dropped!";
        } catch (Exception $e) {
            return $e->getMessage();
        }
        $db = NULL;

        // $this->dbHandle = NULL;
    }

    public function truncateDatabase()
    {
        $this->dropDatabase();
        $this->createTables();
        return "All tables have been truncated";
    }

    public function createTables()
    {
        $commands = array(
            "CREATE TABLE IF NOT EXISTS Model_3D (Id INTEGER PRIMARY KEY AUTOINCREMENT, brand TEXT, x3dModelTitle TEXT, x3dCreationMethod TEXT, modelTitle TEXT, modelSubtitle TEXT, modelDescription TEXT)",
            "CREATE TABLE IF NOT EXISTS SPA_PAGES (Id INTEGER PRIMARY KEY AUTOINCREMENT, page_name TEXT, title TEXT, body TEXT)"
        );
        $db = $this->createDBConnection();

        foreach ($commands as $command) {
            try {
                $db->exec($command);
            } catch (PDOException $e) {
                print new Exception($e->getMessage());
            }
        }

        $db = NULL;

        // $this->dbHandle = NULL;

        return "All tables have been created";
    }

    public function dbInsertData()
    {
        $dbSeed = array(
            "INSERT INTO Model_3D (brand, x3dModelTitle, x3dCreationMethod, modelTitle, modelSubtitle, modelDescription) 
				VALUES ('Coke', 'X3D Coke Model', 'string_2', 'string_3','string_4','string_5'); " .
                "INSERT INTO Model_3D (brand, x3dModelTitle, x3dCreationMethod, modelTitle, modelSubtitle, modelDescription) 
				VALUES ('Sprite', 'X3D Sprite Model', 'string_2', 'string_3','string_4','string_5'); " .
                "INSERT INTO Model_3D (brand, x3dModelTitle, x3dCreationMethod, modelTitle, modelSubtitle, modelDescription) 
				VALUES ('Fanta', 'X3D Fanta Model', 'string_2', 'string_3','string_4','string_5'); " .
                "INSERT INTO Model_3D (brand, x3dModelTitle, x3dCreationMethod, modelTitle, modelSubtitle, modelDescription) 
				VALUES ('Coke Light', 'X3D Coke Light Model', 'string_2', 'string_3','string_4','string_5'); " .
                "INSERT INTO Model_3D (brand, x3dModelTitle, x3dCreationMethod, modelTitle, modelSubtitle, modelDescription) 
				VALUES ('Coke Zero', 'X3D Coke Zero Model', 'string_2', 'string_3','string_4','string_5'); " .
                "INSERT INTO Model_3D (brand, x3dModelTitle, x3dCreationMethod, modelTitle, modelSubtitle, modelDescription) 
				VALUES ('Dr Pepper', 'X3D Dr Pepper Model', 'string_2', 'string_3','string_4','string_5');",
            "INSERT INTO SPA_PAGES (page_name, title, body) 
				VALUES ('statement-of-originality', 'Statement of Originality', 'These web pages are submitted as part requirement for the degree of MSc in Advanced Computer Science at the University of Sussex. They are the product of my own labour except where indicated in the web page content. These web pages or contents may be freely copied and distributed provided the source is acknowledged.');",
            "INSERT INTO SPA_PAGES (page_name, title, body) 
				VALUES ('main', 'Statement of Originality', '');",
            "INSERT INTO SPA_PAGES (page_name, title, body) 
				VALUES ('db-admin', 'Database admin screen', '');",
            "INSERT INTO SPA_PAGES (page_name, title, body) 
				VALUES ('references', 'References', 'No reference to be displayed');",
            "INSERT INTO SPA_PAGES (page_name, title, body) 
				VALUES ('about', 'About', '');"
        );
        try {
            foreach ($dbSeed as $stmt) {
                $this->dbHandle->exec($stmt);
            }

            return "Database {$this->dsn} seeded successfully";
        } catch (PDOEXception $e) {
            print new Exception($e->getMessage());
        }
        $this->dbHandle = NULL;
    }

    public function getSPAPage($pageName)
    {
        $db = new \PDO($this->dsn, '', '', array(
            \PDO::ATTR_EMULATE_PREPARES => false,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ));

        $query = $db->prepare("SELECT * FROM SPA_PAGES WHERE page_name LIKE :pageName");
        $query->execute(['pageName' => $pageName]);

        try {
            return $query->fetch();
        } catch (PDOException $e) {
            print new Exception($e->getMessage());
        }

        $db = NULL;
    }

    private function execCmds($cmds)
    {
        foreach ($cmds as $command) {
            $this->dbHandle->exec($command);
        }
    }

    private function createDBConnection()
    {
        $db = new \PDO($this->dsn, '', '', array(
            \PDO::ATTR_EMULATE_PREPARES => false,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ));

        return $db;
    }
}
