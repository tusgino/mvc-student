<?php
class Student
{
  private $id;
  private $name;
  private $age;
  private $university;

  public function __construct($id, $name, $age, $university)
  {
    $this->id = $id;
    $this->name = $name;
    $this->age = $age;
    $this->university = $university;
  }

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    return $this->id = $id;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    return $this->name = $name;
  }

  public function getAge()
  {
    return $this->age;
  }

  public function setAge($age)
  {
    return $this->age = $age;
  }

  public function getUniversity()
  {
    return $this->university;
  }

  public function setUniversity($address)
  {
    return $this->university = $address;
  }
}
