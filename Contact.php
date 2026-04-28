<?php

class Contact {

    /**
     * ID du contact
     *
     * @var int|null
     */
    private ?int $id;

    /**
     * Nom du contact
     *
     * @var string|null
     */
    private ?string $name;

    /**
     * Email du contact
     *
     * @var string|null
     */
    private ?string $email;

    /**
     * Numéro de téléphone du contact
     *
     * @var string|null
     */
    private ?string $phoneNumber;

    /**
     * Constructeur de la classe Contact
     *
     * @param int|null $id L'ID du contact (peut être null pour les nouveaux contacts)
     * @param string|null $name Le nom du contact
     * @param string|null $email L'email du contact
     * @param string|null $phoneNumber Le numéro de téléphone du contact
     */
    public function __construct(?int $id = null, ?string $name  = null, ?string $email  = null, ?string $phoneNumber = null) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * Crée un objet Contact à partir d'un tableau de données (généralement une ligne de la base de données)
     *
     * @param array $data Un tableau associatif contenant les données du contact
     *
     * @return Contact Un objet Contact créé à partir des données fournies
     */
    public static function fromData(array $data): Contact {
        return new Contact(
            $data['id'],
            $data['name'],
            $data['email'],
            $data['phone_number']
        );
    }

    /**
     * Récupère l'ID du contact
     *
     * @return int|null L'ID du contact ou null si non défini
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * Récupère le nom du contact
     *
     * @return string|null Le nom du contact ou null si non défini
     */
    public function getName(): ?string {
        return $this->name;
    }

    /**
     * Récupère l'email du contact
     *
     * @return string|null L'email du contact ou null si non défini
     */
    public function getEmail(): ?string {
        return $this->email;
    }

    /**
     * Récupère le numéro de téléphone du contact
     *
     * @return string|null Le numéro de téléphone du contact ou null si non défini
     */
    public function getPhoneNumber(): ?string {
        return $this->phoneNumber;
    }

    /**
     * Définit le nom du contact
     *
     * @param string $name Le nom du contact
     */
    public function setName(string $name): void {
        $this->name = $name;
    }

    /**
     * Définit l'email du contact
     *
     * @param string $email L'email du contact
     */
    public function setEmail(string $email): void {
        $this->email = $email;
    }

    /**
     * Définit le numéro de téléphone du contact
     *
     * @param string $phoneNumber Le numéro de téléphone du contact
     */
    public function setPhoneNumber(string $phoneNumber): void {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * Retourne une représentation sous forme de chaîne de caractères du contact
     *
     * @return string Une chaîne de caractères représentant le contact
     */
    public function __toString(): string {
        return "{$this->id}, {$this->name}, {$this->email}, {$this->phoneNumber} \n";
    }
}