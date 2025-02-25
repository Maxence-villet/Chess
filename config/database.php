<?php
class Database {
    // Attributs statiques pour la connexion
    private static $server = "127.0.0.1";
    private static $username = "root";
    private static $password = "";
    private static $name = "SIO2D-d5-testrequetes";
    private static $charset = "utf8";

    // Méthode statique pour la connexion
    public static function connectionDB() {
        try {
            $pdo = new PDO(
                "mysql:host=" . self::$server . ";dbname=" . self::$$name . ";charset=" . self::$charset,
                self::$username,
                self::$password
            );
            return $pdo;
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    // Méthode statique pour exécuter une requête
    public static function executRequest($request, $params = array()) {
        $pdo = self::connectionDB();
        $statment = $pdo->prepare($request);
        $statment->execute($params);
        return $statment;
    }

    // Méthode statique pour convertir le résultat en tableau HTML
    public static function requeteVersTable($request, $params = array()) {
        $statment = self::executerRequete($request, $params);
        $results = $statment->fetchAll(PDO::FETCH_ASSOC);
        $html = "<table border='1'><tr>";
        
        // En-têtes du tableau (noms des colonnes)
        if (!empty($results)) {
            $firtsRow = $results[0];
            foreach (array_keys($firtsRow) as $column) {
                $html .= "<th>" . htmlspecialchars($column) . "</th>";
            }
            $html .= "</tr>";

            // Données du tableau
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