<?php

use App\Controllers\EmployeesController;
use App\Controllers\ProjectsController;

// Api routings
$app->group('/api', function() {

  // employees resource routes
  $this->get('/employees', EmployeesController::class . ':find');

  // projects resource routes
  $this->get('/projects', ProjectsController::class . ':find');
  $this->post('/projects', ProjectsController::class . ':create');
  $this->put('/projects/{id}', ProjectsController::class . ':update');
  $this->delete('/projects/{id}', ProjectsController::class . ':delete');
});