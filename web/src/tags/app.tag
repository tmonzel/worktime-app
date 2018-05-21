<app>
  <div class="container">
    <h1 class="my-5">Current projects</h1>
    <form class="mb-4">
      <div class="form-row">
        <div class="col mb-4">
          <select ref="employeesField" class="form-control" onchange={ onChangeEmployee }>
            <option each={ employees } value={ id }>{ first_name }</option>
          </select>
        </div>
      </div>

      <div class="form-row">
        <div class="col">
          <input ref="projectNameField" type="text" class="form-control" placeholder="Enter project name">
        </div>
        <div class="col-auto">
          <button type="button" class="btn btn-primary" onclick={ addProject }>Add project</button>
        </div>
      </div>
    </form>

    <project-list list={ projects }></project-list>
  </div>

  <script>
    import './project-list.tag';

    this.projects = []
    this.employees = [];

    addProject() {
      let nameField = this.refs.projectNameField;
      let employeeField = this.refs.employeesField;
      let scope = this;
      
      $.ajax({
        url: 'http://localhost:8080/api/projects',
        method: 'POST',
        data: { 
          employee_id: employeeField.value, 
          name: nameField.value, 
          seconds: 0.0 
        }
      }).done(function(response) {
        nameField.value = '';
        scope.projects.push(response);
        scope.update();
      });
    }

    populateProjects(data) {
      this.projects = data;
      this.update();
    }

    changeEmployee(id) {      
      $.ajax({
        url: 'http://localhost:8080/api/projects?employee_id=' + id
      }).done(this.populateProjects);
    }

    onChangeEmployee(e) {
      this.changeEmployee(e.target.value);
    }

    populateEmployees(data) {
      this.employees = data;
      this.update();

      this.changeEmployee(this.refs.employeesField.value);
    }

    this.on('mount', function() {
      $.ajax({
        url: 'http://localhost:8080/api/employees',
        method: 'GET'
      }).done(this.populateEmployees);
    });
  </script>
</app>