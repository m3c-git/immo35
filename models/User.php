<?php

class User
{
    private ? int $id = null;

    

    public function __construct(private string $firstName, private string $lastName, private string $address, private string $phone, private string $email, private ? string $password, private string $role = "USER")
    {

        $this->role = $role;
    }

    /* Le getter de l'attribut id */
    public function getId() : ? int 
    {
        return $this->id;
    }

    /* Le setter de l'attribut id */
    public function setId(int $id) : void
    {
        $this->id = $id;
    }

    /* Le getter de l'attribut firstName */
    public function getFirstName() : string 
    {
        return $this->firstName;
    }

    /* Le setter de l'attribut firstName */
    public function setFirstName(string $firstName) : void
    {
        $this->firstName = $firstName;
    }

    /* Le getter de l'attribut lastName */
    public function getLastName() : string 
    {
        return $this->lastName;
    }

    /* Le setter de l'attribut lastName */
    public function setLastName(string $lastName) : void
    {
        $this->lastName = $lastName;
    }

     /* Le getter de l'attribut email */
    public function getEmail() : string 
    {
        return $this->email;
    }

    /* Le setter de l'attribut email */
    public function setEmail(string $email) : void
    {
        $this->email = $email;
    }

    /* Le getter de l'attribut address */
    public function getAddress() : string 
    {
        return $this->address;
    }

    /* Le setter de l'attribut address */
    public function setAddress(string $address) : void
    {
        $this->email = $address;
    }

    /* Le getter de l'attribut phone */
    public function getPhone() : string 
    {
        return $this->phone;
    }

    /* Le setter de l'attribut phone */
    public function setPhone(string $phone) : void
    {
        $this->phone = $phone;
    }

    /* Le getter de l'attribut password */
    public function getPassword() : ? string 
    {
        return $this->password;
    }

    /* Le setter de l'attribut password */
    public function setPassword(string $password) : void
    {
        $this->password = $password;
    }

    /* Le getter de l'attribut role */
    public function getRole() : string 
    {
        return $this->role;
    }

    /* Le setter de l'attribut role */
    public function setRole(string $role) : void
    {
        $this->role = $role;
    }

    /* Le getter de l'attribut created_at */
   /*  public function getCreatedAt() : string 
    {
        return $this->createdAt;
    } */

    /* Le setter de l'attribut created_at */
    /* public function setCreatedAt(string $createdAt) : void
    {
        $this->createdAt = $createdAt;
    } */
    

}