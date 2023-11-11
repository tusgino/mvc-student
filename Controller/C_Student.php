<?php
include_once '../Model/M_Student.php';

class C_Student
{
  private $model;

  public function __construct()
  {
    $this->model = new M_Student();
  }

  public function getAll()
  {
    if (isset($_GET['searchText'])) {
      $searchText = $_GET['searchText'];
      $searchKey = $_GET['searchKey'];
      $students = $this->model->search($searchText, $searchKey);
      include_once '../View/StudentList.html';
      return;
    }
    $students = $this->model->getAll();
    include_once '../View/StudentList.html';
  }

  public function getStudentDelete()
  {
    if (isset($_GET['searchText'])) {
      $searchText = $_GET['searchText'];
      $searchKey = $_GET['searchKey'];
      $students = $this->model->search($searchText, $searchKey);
      include_once '../View/DeleteStudent.html';
      return;
    }
    $students = $this->model->getAll();
    include_once '../View/DeleteStudent.html';
  }

  public function getById($id)
  {
    $student = $this->model->getById($id);
    include_once '../View/StudentDetail.html';
  }

  public function checkIDExist($id)
  {
    $student = $this->model->getById($id);
    if ($student == null) {
      return false;
    }
    return true;
  }

  public function addStudent()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $id = $_POST['id'];
      if ($this->checkIDExist($id)) {
        echo "ID đã tồn tại";
        return;
      }
      $name = $_POST['name'];
      $age = $_POST['age'];
      $university = $_POST['university'];
      $student = new Student($id, $name, $age, $university);
      $this->model->add($student);
      header('Location: index.php?action=getAll');
    } else {
      include_once '../View/AddStudent.html';
    }
  }

  public function delete($id)
  {
    echo $id;
    $this->model->delete($id);
    header('Location: ../Controller/C_Student.php?action=getAll');
  }

  public function update($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $name = $_POST['name'];
      $age = $_POST['age'];
      $university = $_POST['university'];
      $student = new Student($id, $name, $age, $university);
      $this->model->update($student);
      header('Location: ../Controller/C_Student.php?action=getAll');
    } else {
      $student = $this->model->getById($id);
      include_once '../View/AddStudent.html';
    }
  }
}


$controller = new C_Student();

if (isset($_GET['action'])) {
  $action = $_GET['action'];
  switch ($action) {
    case 'getAll':
      $controller->getAll();
      break;
    case 'getById':
      $id = $_GET['id'];
      if (!isset($id)) die('Lỗi không có id');
      $controller->getById($id);
      break;
    case 'addStudent':
      $controller->addStudent();
      break;
    case 'deleteStudent':
      $controller->getStudentDelete();
      break;
    case 'deleteById':
      if (!isset($_GET['id'])) die('Lỗi không có id');
      echo $_GET['id'];
      $controller->delete($_GET['id']);
      break;
    case 'updateById':
      if (!isset($_GET['id'])) die('Lỗi không có id');
      $controller->update($_GET['id']);
      break;
    default:
      echo "Action không tồn tại";
      break;
  }
} else {
  $controller->getAll();
}
