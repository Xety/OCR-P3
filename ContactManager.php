<?php
class ContactManager {

    /**
     * Instance de connexion à la base de données
     *
     * @var PDO
     */
    private PDO $db;

    /**
     * Constructeur de la classe ContactManager, il initialise la connexion à la base de données
     */
    public function __construct() {
        $this->db = DBConnect::getInstance()->getPDO();
    }

    /**
     * Récupère tous les contacts de la base de données
     *
     * @return Contact[] Un tableau d'objets Contact
     */
    public function findAll(): array {
        $query = $this->db->prepare("SELECT * FROM contact");
        $query->execute();

        // Pour chaque ligne de résultat, créer un objet Contact et l'ajouter à la liste des contacts
        $contacts = [];
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $contacts[] = Contact::fromData($row);
        }

        return $contacts;
    }

    /**
     * Récupère un contact par son ID
     *
     * @param int $id L'ID du contact
     * @return Contact|null L'objet Contact ou null si non trouvé
     */
    public function findById(int $id): ?Contact {
        $query = $this->db->prepare("SELECT * FROM contact WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }
        return Contact::fromData($data);
    }

    /**
     * Crée un nouveau contact
     *
     * @param string $name Le nom du contact
     * @param string $email L'email du contact
     * @param string $phoneNumber Le numéro de téléphone du contact
     *
     * @return Contact L'objet Contact créé
     */
    public function create(string $name, string $email, string $phoneNumber): Contact {
        $query = $this->db->prepare("INSERT INTO contact (name, email, phone_number) VALUES (:name, :email, :phone_number)");
        $query->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone_number' => $phoneNumber
        ]);

        // Récupère l'ID du contact nouvellement créé
        $contactId = $this->db->lastInsertId();

        return new Contact((int)$contactId, $name, $email, $phoneNumber);
    }

    /**
     * Met à jour un contact existant
     *
     * @param Contact $contact L'objet Contact à mettre à jour
     *
     * @return bool True si la mise à jour a réussi, false sinon
     */
    public function update(Contact $contact): bool {
        $query = $this->db->prepare("UPDATE contact SET name = :name, email = :email, phone_number = :phone_number WHERE id = :id");
        $query->execute([
            ':name' => $contact->getName(),
            ':email' => $contact->getEmail(),
            ':phone_number' => $contact->getPhoneNumber(),
            ':id' => $contact->getId()
        ]);

        return $query->rowCount() === 1;
    }

    /**
     * Supprime un contact
     *
     * @param int $id L'ID du contact à supprimer
     *
     * @return bool True si la suppression a réussi, false sinon
     */
    public function delete(int $id): bool {
        $query = $this->db->prepare("DELETE FROM contact WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);

        return $query->execute();
    }
}