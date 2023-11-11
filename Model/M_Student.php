<?php

include_once 'E_Student.php';


class M_Student
{
  private $db;

  public function __construct()
  {
    $this->db = new mysqli('localhost', 'root', '', 'student_manager');
    $this->db->set_charset('utf8');
    if ($this->db->connect_errno) {
      die('Lỗi kết nối database');
    }
  }

  public function getAll()
  {
    $sql = "SELECT * FROM students";
    $result = $this->db->query($sql);
    $data = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $student = new Student($row['id'], $row['name'], $row['age'], $row['university']);
        array_push($data, $student);
      }
    }
    return $data;
  }

  public function getById($id)
  {
    $sql = "SELECT * FROM students WHERE id = $id";
    $result = $this->db->query($sql);
    $student = null;
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $student = new Student($row['id'], $row['name'], $row['age'], $row['university']);
      }
    }
    return $student;
  }


  public function add($student)
  {
    $id = $student->getId();
    $name = $student->getName();
    $age = $student->getAge();
    $university = $student->getUniversity();
    $sql = "INSERT INTO students (id, name, age, university) VALUES ($id, '$name', $age, '$university')";
    $result = $this->db->query($sql);
    return $result;
  }

  public function update($student)
  {
    $id = $student->getId();
    $name = $student->getName();
    $age = $student->getAge();
    $university = $student->getUniversity();
    $sql = "UPDATE students SET name = '$name', age = $age, university = '$university' WHERE id = $id";
    $result = $this->db->query($sql);
    return $result;
  }

  public function delete($id)
  {
    $sql = "DELETE FROM students WHERE id = $id";
    $result = $this->db->query($sql);
    return $result;
  }

  public function search($text, $key)
  {
    $sql = "SELECT * FROM students WHERE $key LIKE '%$text%'";
    $result = $this->db->query($sql);
    $data = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $student = new Student($row['id'], $row['name'], $row['age'], $row['university']);
        array_push($data, $student);
      }
    }
    return $data;
  }
}
