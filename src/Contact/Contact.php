<?php

namespace App\Contact;

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

    public function __toString() : string {
        return $this->id . ',' . $this->name . ',' . $this->email . ',' . $this->phone_number;
    }

}
?>
