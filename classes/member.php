<?php

/**
 * Class Member
 * this creates a member which has first, last, age, gender, phone, email,
 *                                 state, seeking, bio
 * @author Elric Barkey
 * @version 1.0
 */
class Member
{
    //my instance variables
    private $_fname;
    private $_lname;
    private $_age;
    private $_gender;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;


    /**
     *
     */
    public function __construct($fname, $lname, $age, $gender, $phone)
    {
        $this->setFname($fname);
        $this->setLname($lname);
        $this->setAge($age);
        $this->setGender($gender);
        $this->setPhone($phone);

    }

    /**
     * @return first name
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * set first name
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * @return last name
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * set last name
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * @return age
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * set age
     */
    public function setAge($age)
    {
        $this->_age = $age;
    }

    /**
     * @return gender
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * set gender
     */
    public function setGender($gender)
    {
        $this->_gender = $gender;
    }

    /**
     * @return phone number
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * set phone number
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return email
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * set email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return state
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * set the chosen state
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * @return get seeking gender
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /**
     * set selected gender
     */
    public function setSeeking($seeking)
    {
        $this->_seeking = $seeking;
    }

    /**
     * @return bio
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * @param set bio
     */
    public function setBio($bio)
    {
        $this->_bio = $bio;
    }

    /**
     * toString returns a string representation
     * of an order object
     * @return string
     */
    public function __toString()
    {
        return $this->getFname() . " " . $this->getLname() . " " . $this->getAge();
    }

}