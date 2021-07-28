<?php

function setError($message)
{

    $_SESSION['errors'] = [];
    $_SESSION['errors'][] = $message;
}
function showError()
{
    if (isset($_SESSION['errors'])) {
        $errors = $_SESSION['errors'];
        $_SESSION['errors'] = [];
        if (count($errors)) {
            foreach ($errors as $e) {
                echo "<div class='alert alert-danger'>$e</div>";
            }
        }
    }
}
function setMsg($message)
{

    $_SESSION['msg'] = [];
    $_SESSION['msg'][] = $message;
}

function showMsg()
{
    if (isset($_SESSION['msg'])) {
        $message = $_SESSION['msg'];
        $_SESSION['msg'] = [];
        if (count($message)) {
            foreach ($message as $e) {
                echo "<div class='alert alert-success'>$e</div>";
            }
        }
    }
}


function hasError()
{
    if (isset($_SESSION['errors'])) {
        $errors = $_SESSION['errors'];
        if (count($errors)) {
            return true;
        } else {
            return false;
        }
    }
}
function go($path)
{
    header("Location:$path");
}
function slug($str)
{
    return uniqid() . '-' . str_replace(' ', '-', $str);
}


function paginateCategory($record_per_page = 5)
{
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 2;
    }
    if ($page <= 0) {
        $page = 2;
    }
    //1 =0,2
    //2 =2,2
    //3 =4,2
    $start = ($page - 1) * $record_per_page;
    $limit = "$start,$record_per_page";
    $sql = "select * from category order by id desc limit $limit";
    $data = getAll($sql);
    echo json_encode($data);
}

function paginateProduct($record_per_page = 5)
{
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 2;
    }
    if ($page <= 0) {
        $page = 2;
    }
    //1 =0,2
    //2 =2,2
    //3 =4,2
    $start = ($page - 1) * $record_per_page;
    $limit = "$start,$record_per_page";
    $sql = "select * from product ";
    if (isset($_GET['search']) and !empty($_GET['search'])) {
        $search = $_GET['search'];
        $sql .= "where name like '%$search%' ";
    }
    $sql .= "order by id desc limit $limit";


    $data = getAll($sql);
    echo json_encode($data);
}