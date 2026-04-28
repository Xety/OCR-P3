<?php

class Command {

    /**
     * Instance de ContactManager pour gérer les contacts.
     *
     * @var ContactManager
     */
    private ContactManager $manager;

    /**
     * Le constructeur de la classe.
     */
    public function __construct()
    {
        $this->manager = new ContactManager();
    }

     /**
      * Affiche l'aide pour les commandes disponibles.
      *
      * @return void
      */
     public function help(): void {
        echo "help : Affiche cette aide\n";
        echo "list : Liste les contacts\n";
        echo "create : Crée un contact\n";
        echo "detail {id} : Affiche les détails d'un contact\n";
        echo "delete {id} : Supprime un contact\n";
        echo "modify : Modifie un contact\n";
        echo "quit : Quitte le programme\n";
        echo "\n";
    }

    /**
     * Affiche la liste de tous les contacts.
     *
     * @return void
     */
    public function list(): void {
        $contacts = $this->manager->findAll();
        if (empty($contacts)) {
            echo "Aucun contact trouvé.\n";
            return;
        }

        foreach ($contacts as $contact) {
            echo $contact;
        }
    }

    /**
     * Affiche les détails d'un contact.
     *
     * @param int $id L'ID du contact.
     *
     * @return void
     */
    public function detail(int $id): void {
        $contact = $this->manager->findById($id);
        if (!$contact) {
            echo "Contact avec l'ID $id non trouvé.\n";
            return;
        }

        echo $contact;
    }

    /**
     * Crée un nouveau contact.
     *
     * @param string $name Le nom du contact.
     * @param string $email L'email du contact.
     * @param string $phoneNumber Le numéro de téléphone du contact.
     *
     * @return void
     */
    public function create(string $name, string $email, string $phoneNumber): void {
        $contact = $this->manager->create($name, $email, $phoneNumber);

        echo "Contact créé : " . $contact;
    }

    /**
     * Supprime un contact.
     *
     * @param int $id L'ID du contact à supprimer.
     *
     * @return void
     */
    public function delete(int $id): void {
        $contact = $this->manager->findById($id);
        if (!$contact) {
            echo "Contact avec l'ID $id non trouvé.\n";
            return;
        }

        if ($this->manager->delete($id)) {
            echo "Contact avec l'ID $id supprimé.\n";
            return;
        }

        echo "Échec de la suppression du contact avec l'ID $id.\n";
    }

    /**
     * Modifie un contact existant.
     *
     * @param int $id L'ID du contact à modifier.
     * @param string $name Le nouveau nom du contact.
     * @param string $email Le nouvel email du contact.
     * @param string $phoneNumber Le nouveau numéro de téléphone du contact.
     *
     * @return void
     */
    public function modify(int $id, string $name, string $email, string $phoneNumber): void {
        $contact = $this->manager->findById($id);
        if (!$contact) {
            echo "Contact avec l'ID $id non trouvé.\n";
            return;
        }

        $contact->setName($name);
        $contact->setEmail($email);
        $contact->setPhoneNumber($phoneNumber);

        if ($this->manager->update($contact)) {
            echo "Contact avec l'ID $id modifié.\n";
            return;
        }

        echo "Échec de la modification du contact avec l'ID $id.\n";
    }
}