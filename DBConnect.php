<?php

/**
 * C'est la classe DBConnect qui gère la connexion à la base de données en utilisant le design pattern Singleton.
 */
class DBConnect {

    /**
     * L'instance de la classe DBConnect
     * @var DBConnect|null
     */
    private static $instance = null;

    /**
     *  L'instance de PDO pour interagir avec la base de données
     *
     * @var PDO
     */
    private PDO $pdo;

    /**
     * Constructeur de la classe DBConnect.
     */
    private function __construct()
    {
        $this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);
    }

    /**
     * Récupère l'instance de PDO pour interagir avec la base de données
     *
     * @return PDO
     */
    public function getPDO(): PDO {
        return $this->pdo;
    }

    /**
     * Récupère l'instance de la classe DBConnect, si elle n'existe pas encore, elle est créée
     *
     * @return DBConnect
     */
    public static function getInstance(): DBConnect {
        if (self::$instance === null) {
            self::$instance = new DBConnect();
        }
        return self::$instance;
    }
}