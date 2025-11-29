<?php

namespace App\Contact;

//la classe Contact stocke les informations d'un seul contact (id, name, email, phone number)
class Contact {

    public function __construct(private $id, private $name, private $email, private $phone_number) {
    }

    public function getId() : ?int {
        return $this->id;
    }

    public function getName() : ?string {
        return $this->name;
    }

    public function setName(?string $name) : void {
        $this->name = $name;
    }

    //Renvoi des informations d'un contact
    public function __toString() : string {
        return $this->id . ',' . $this->name . ',' . $this->email . ',' . $this->phone_number;
    }

}
?>
