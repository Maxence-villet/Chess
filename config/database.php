<?php

class Database {
    private static $server = "docker-project-db-1";
    private static $login = "root";
    private static $password = "mariadb";
    private static $databaseName = "chess";
    private static $charset = "utf8mb4";


    public static function connectToDatabase() {
        try {
            $dsn = "mysql:host=" . self::$server . ";dbname=" . self::$databaseName . ";charset=" . self::$charset;
            $pdo = new PDO($dsn, self::$login, self::$password);
            return $pdo;
        } catch (PDOException $e) {
            die("Connection error: " . $e->getMessage());
        }
    }

    // Static method to execute a query
    public static function executeQuery($query, $parameters = array()) {
        $pdo = self::connectToDatabase();
        $statement = $pdo->prepare($query);
        $statement->execute($parameters);
        return $statement;
    }

    // Static method to convert query results into an HTML table
    public static function queryToTable($query, $parameters = array()) {
        $statement = self::executeQuery($query, $parameters);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $html = "<table border='1'><tr>";
        
        // Table headers (column names)
        if (!empty($results)) {
            $firstRow = $results[0];
            foreach (array_keys($firstRow) as $column) {
                $html .= "<th>" . htmlspecialchars($column) . "</th>";
            }
            $html .= "</tr>";

            // Table data
            foreach ($results as $row) {
                $html .= "<tr>";
                foreach ($row as $value) {
                    $html .= "<td>" . htmlspecialchars($value) . "</td>";
                }
                $html .= "</tr>";
            }
        }
        $html .= "</table>";
        return $html;
    }
}
?>