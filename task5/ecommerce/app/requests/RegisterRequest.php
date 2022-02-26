<?php

namespace app\requests;

use app\database\models\User;

class RegisterRequest
{
    private $password;
    private $password_confirmation;
    private $email;
    private $phone;

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

    /**
     * Get the value of password_confirmatoin
     */
    public function getPassword_confirmation()
    {
        return $this->password_confirmation;
    }

    /**
     * Set the value of password_confirmatoin
     *
     * @return  self
     */
    public function setPassword_confirmation($password_confirmation)
    {
        $this->password_confirmation = $password_confirmation;

        return $this;
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
     * Get the value of phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    public function passwordValidation(): array
    {
        $errors = [];
        # password  required 
        if (empty($this->password)) 
        {
            $errors['pasword-required'] = "Password Is Required";
        }
        // password confirmation required
        if (empty($this->password_confirmation)) 
        {
            $errors['password_confirmation-required'] = "Password confrimation Is Required";
        }
        # no validation errors
        if (empty($errors)) 
        {
            #,regex 
            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/', $this->password)) {
                $errors['pasword-regex'] = "Password Minimum eight and maximum 20 characters, at least one uppercase letter, one lowercase letter, one number and one special character";
            }

            if (empty($errors)) 
            {
                # confirmed
                if ($this->password != $this->password_confirmation) 
                {
                    $errors['pasword-confirmed'] = "Password dosen't match password confirmation";
                }
            }
        }
        return $errors;
    }


    public function emailValidaiton()
    {
        # // required , regex , unique
        $errors = [];
        if (empty($this->email)) {
            $errors['email-required'] = "Email Is Required";
        }
        if (empty($errors)) 
        {
            if (!preg_match('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/', $this->email)) {
                $errors['email-regex'] = "Email Is Invalid";
            }
            if (empty($errors)) 
            {
                $user = new User;
                $user->setEmail($this->email);
                $result = $user->getUserByEmail();
                if ($result->num_rows == 1) {
                    $errors['email-unique'] = "Email Already Exists";
                }
            }
        }

        return $errors;
    }

    public function phoneValidation()
    {
        #// required , regex , unique

        $errors = [];
        if (empty($this->phone)) 
        {
            $errors['phone-required'] = "Phone Is Required";
        }

        if (empty($errors)) 
        {
            if (!preg_match('/01[0-2,5]{1}[0-9]{8}$/', $this->phone)) 
            {
                $errors['phone-regex'] = "Phone Is Invalid";
            }

            if (empty($errors)) 
            {
                $user = new User;
                $user->setPhone($this->phone);
                $result = $user->getUserByPhone();
                if ($result->num_rows == 1) 
                {
                    $errors['phone-unique'] = "Phone Already Exists";
                }
            }
        }

        return $errors;
    }
}
