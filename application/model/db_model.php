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
            // echo 'Database connection created</br></br>';
        } catch (\PDOEXception $e) {
            echo "I'm sorry, I'm afraid I can't connect to the database!";
            // Generate an error message if the connection fails
            print new Exception($e->getMessage());
        }
    }

    public function dropDatabase()
    {
        try {
            $this->dbHandle->exec("DROP TABLE IF EXISTS Model_3D");
            $this->dbHandle->exec("DROP TABLE IF EXISTS SPA_PAGES");
            return "All tables have been dropped!";
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $this->dbHandle = NULL;
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
            "CREATE TABLE IF NOT EXISTS Model_3D (Id INTEGER PRIMARY KEY AUTOINCREMENT, page_name TEXT, brand TEXT, x3dModelTitle TEXT, x3dCreationMethod TEXT, modelTitle TEXT, modelSubtitle TEXT, modelDescription TEXT)",
            "CREATE TABLE IF NOT EXISTS SPA_PAGES (Id INTEGER PRIMARY KEY AUTOINCREMENT, page_name TEXT, title TEXT, body TEXT)"
        );

        foreach ($commands as $command) {
            try {
                $this->dbHandle->exec($command);
            } catch (PDOException $e) {
                print new Exception($e->getMessage());
            }
        }

        $this->dbHandle = NULL;

        return "All tables have been created";
    }

    public function dbInsertData()
    {
        $dbSeed = array(
            "INSERT INTO Model_3D (page_name, brand, x3dModelTitle, x3dCreationMethod, modelTitle, modelSubtitle, modelDescription) 
				VALUES ('coca-cola', 'Coca-Cola', 'X3D Coke Model', 'string_2', 'string_3','string_4','string_5'); " .
                "INSERT INTO Model_3D (page_name, brand, x3dModelTitle, x3dCreationMethod, modelTitle, modelSubtitle, modelDescription) 
				VALUES ('costa', 'Costa', 'X3D Costa Model', 'string_2', 'string_3','string_4','string_5'); " .
                "INSERT INTO Model_3D (page_name, brand, x3dModelTitle, x3dCreationMethod, modelTitle, modelSubtitle, modelDescription) 
				VALUES ('georgia-coffee', 'Georgia Coffee', 'X3D Georgia Coffee Model', 'string_2', 'string_3','string_4','string_5'); ",
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
        $query = $this->dbHandle->prepare("SELECT * FROM SPA_PAGES WHERE page_name LIKE :pageName");
        $query->execute(['pageName' => $pageName]);

        try {
            return $query->fetch();
        } catch (PDOException $e) {
            print new Exception($e->getMessage());
        }

        $this->dbHandle = NULL;
    }

    public function get3DPageData($pageName)
    {
        // Prepare a statement to get all records from the Model_3D table
        $query = $this->dbHandle->prepare("SELECT * FROM Model_3D WHERE page_name LIKE :pageName");
        // Use PDO query() to query the database with the prepared SQL statement
        $query->execute(['pageName' => $pageName]);

        try {
            $result = $query->fetch();
            // var_dump($result);
            return $result;
        } catch (PDOEXception $e) {
            print new Exception($e->getMessage());
        }
        // Close the database connection
        $this->dbHandle = NULL;
    }

    public function getAllFromTable($tableName)
    {
        $query = $this->dbHandle->prepare("SELECT * FROM :tableName");
        $query->execute(['tableName' => $tableName]);

        try {
            $result = $query->fetch();
            if (isset($result)) {
                return json_encode($result, JSON_FORCE_OBJECT);
            }
            return '{}';
        } catch (PDOEXception $e) {
            return new Exception($e->getMessage());
        }
        // Close the database connection
        $this->dbHandle = NULL;
    }

    public function getNavBar()
    {
        try {
            // Prepare a statement to get all records from the Model_3D table
            $sql = 'SELECT * FROM Model_3D';
            // Use PDO query() to query the database with the prepared SQL statement
            $stmt = $this->dbHandle->query($sql);
            // Set up an array to return the results to the view
            $result = null;
            // Set up a variable to index each row of the array
            $i = -0;
            // Use PDO fetch() to retrieve the results from the database using a while loop
            // Use a while loop to loop through the rows	
            while ($data = $stmt->fetch()) {
                $result[$i]['brand'] = $data['brand']; // Not used in the view, instead using the fake dbGetBrand() function above
                $result[$i]['page-name'] = $data['page_name'];
                //increment the row index
                $i++;
            }
            return json_encode($result);
        } catch (PDOEXception $e) {
            print new Exception($e->getMessage());
        }
        // Close the database connection
        $this->dbHandle = NULL;
        // Send the response back to the view
        return '{}';
    }
}
