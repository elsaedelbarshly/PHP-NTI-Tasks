<?php 
namespace app\requests;
use app\database\models\User;

class LoginRequest 
{
    private $email;
    private $password;
    public function emailValidaiton()
    {
        # // required , regex 
        $errors = [];
        if (empty($this->email))
        {
            $errors['email-required'] = "Email Is Required";
        }
        if (empty($errors)) 
        {
            if (!preg_match('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/', $this->email)) 
            {
                $errors['email-regex'] = "Email Is Invalid";
            }
        }

        return $errors;
    }

    public function passwordValidaiton()
    {
        $errors = [];
        # password  required 
        if (empty($this->password)) 
        {
            $errors['pasword-required'] = "Password Is Required";
        }
        return $errors;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}