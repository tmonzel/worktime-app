<?php

namespace App\Controllers;

use App\Models\Employee;

class EmployeesController {
  protected $container;

  function __construct($container) {
    $this->container = $container;
  }

  function find($req, $res, $args) {
    $employees = Employee::all();
    return $res->withJson($employees);
  }

  function add() {

  }

  function remove() {

  }
}