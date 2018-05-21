<?php

namespace App\Controllers;

use App\Models\Project;

class ProjectsController {
  protected $container;

  function __construct($container) {
    $this->container = $container;
  }

  function find($req, $res, $args) {
    $params = $req->getQueryParams();

    $projects = Project::where('employee_id', $params['employee_id'])->get();
    return $res->withJson($projects);
  }

  function update($req, $res, $args) {
    $project_data = $req->getParsedBody();
    $id = $req->getAttribute('id');

    $project = Project::find($id);
    $project->fill($project_data);
    $project->save();
    
    return $res->withJson($project_data);
  }

  function create($req, $res, $args) {
    $project_data = $req->getParsedBody();
    
    $project = Project::create($project_data);

    return $res->withJson($project);
  }

  function delete($req, $res, $args) {
    $id = $req->getAttribute('id');
    Project::destroy($id);

    return $res->withJson(['status' => 'success']);
  }
}