<project-list>
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th style="width: 20%">Time</th>
        <th>Options</th>
      </tr>
    </thead>
    <tbody>
      <tr each={ opts.list }>
        <td>{ id }</td>
        <td>{ name }</td>
        <td>{ seconds }</td>
        <td>
          <button type="button" class="btn btn-{ isRunning ? 'danger' : 'primary' }" onclick={ toggleTimer }>
            { isRunning ? "Stop" : "Start" }
          </button>
          <button type="button" class="btn btn-danger" onclick={ deleteProject }>X</button>
        </td>
      </tr>
    </tbody>
  </table>

  <script>
    this.runningItem = null;

    deleteProject(e) {
      let item = e.item;
      let url = "http://localhost:8080/api/projects/" + item.id;
      let scope = this;

      $.ajax({
        url: url,
        method: 'DELETE'
      }).done(function(response) {
        let index = scope.parent.projects.indexOf(item);
        
        if(index != -1) {
          scope.parent.projects.splice(index, 1);
          scope.update();
        }
      });
    }

    updateProject(id, data) {
      let url = "http://localhost:8080/api/projects/" + id;
      let scope = this;

      $.ajax({
        url: url,
        method: 'PUT',
        data: data
      }).done(function(response) {
        
      });
    }

    start(item) {
      var scope = this;

      if(this.runningItem) {
        this.stop(this.runningItem);
      }

      item.isRunning = true;
      item.interval = setInterval(function() {
        item.seconds = Math.round((item.seconds + 0.01) * 100) / 100;
        scope.update();
      }, 10);
      this.runningItem = item;
    }

    stop(item) {
      if(item.isRunning) {
        item.isRunning = false;
        clearInterval(item.interval);
        this.runningItem = null;

        this.updateProject(item.id, { seconds: item.seconds });
      }
    }

    toggleTimer(e) {
      let item = e.item;
      
      if(item.isRunning) {
        this.stop(item);
      } else {
        this.start(item);
      }
    }
  </script>

  <style>
    .btn.active {

    }
  </style>
</project-list>