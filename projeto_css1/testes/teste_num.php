<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

  <script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>  <!-- Without defer -->
  <script src="componentes/externos/bootstrap/plugins/bootstrap-checkbox/dist/js/bootstrap-checkbox.min.js" defer></script>
</head>
<body>
  <div class="form-horizontal">
    <div class="form-group">
        <div class="col-sm-3">
            <input type="checkbox">
        </div>
    </div>
    </div>
    <script>
    $(function() {
      $(':checkbox').checkboxpicker();
    });
    </script>
</body>
</html>