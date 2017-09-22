<?php
/*
 * file1.php.php
 *
 * Copyright 2017 Cap Paulino <cciexinfor1@CCIEX-56>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 *
 *
 */

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo TITULO;?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="../componentes/externos/bower_components/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="../componentes/externos/bower_components/bootstrap/dist/css/bootstrapValidator.min.css" />
	<link rel="stylesheet" href="../componentes/externos/bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="../componentes/externos/bower_components/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="../componentes/externos/dist/css/AdminLTE.css">
	<link rel="stylesheet" href="../componentes/externos/dist/css/skins/skin-green.css">
	<link rel="stylesheet" href="../componentes/internos/css/siaudi.css">
    <link href="bootstrap-fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="bootstrap-fileinput/themes/explorer/theme.css" media="all" rel="stylesheet" type="text/css"/>
</head>

<body>


<div class="container kv-main">
	<!-- some CSS styling changes and overrides -->
<style>
.kv-avatar .krajee-default.file-preview-frame,.kv-avatar .krajee-default.file-preview-frame:hover {
    margin: 0;
    padding: 0;
    border: none;
    box-shadow: none;
    text-align: center;
}
.kv-avatar .file-input {
    display: table-cell;
    max-width: 220px;
}
.kv-reqd {
    color: red;
    font-family: monospace;
    font-weight: normal;
}
</style>

<!-- markup -->
<!-- note: your server code `avatar_upload.php` will receive `$_FILES['avatar']` on form submission -->
<!-- the avatar markup -->
<div id="kv-avatar-errors-2" class="center-block" style="width:800px;display:none"></div>
	<div class="page-header">
		<h1>Bootstrap File Input Example
		<small><a href="https://github.com/kartik-v/bootstrap-fileinput-samples"><i
		class="glyphicon glyphicon-download"></i> Download Sample Files</a></small>
		</h1>
	</div>
	<form class="form form-vertical" action="/avatar_upload.php" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="col-sm-4">
				<div class="kv-avatar center-block text-center" style="width:200px">
					<input id="avatar-2" name="avatar-2" type="file" class="file-loading" required>
				</div>
			</div>
			<div class="col-sm-8">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="email">Email Address<span class="kv-reqd">*</span></label>
							<input type="email" class="form-control" id="email" name="email" required>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="pwd">Password<span class="kv-reqd">*</span></label>
							<input type="password" class="form-control" id="pwd" name="pwd" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="fname">First Name</label>
							<input type="text" class="form-control" id="fname" name="fname" required>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="lname">Last Name</label>
							<input type="text" class="form-control" id="lname" name="lname" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<hr>
					<div class="text-right">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>




<form enctype="multipart/form-data">
<input id="kv-explorer" type="file" multiple>
<br>
<input id="file-0a" class="file" type="file" multiple data-min-file-count="1">
<br>
<button type="submit" class="btn btn-primary">Submit</button>
<button type="reset" class="btn btn-default">Reset</button>
</form>
<hr>
    <form enctype="multipart/form-data">
        <label for="file-0b">Test invalid input type</label>
        <input id="file-0b" name="file-0b" class="file" type="text" multiple data-min-file-count="1">
        <script>
            $(document).on('ready', function () {
                $("#file-0b").fileinput();
            });
        </script>
    </form>
    <hr>
    <form enctype="multipart/form-data">
        <input id="file-0c" class="file" type="file" multiple data-min-file-count="3">
        <hr>
        <div class="form-group">
            <input id="file-0d" class="file" type="file">
        </div>
        <hr>
        <div class="form-group">
            <input id="file-1" type="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="2">
        </div>
        <hr>
        <div class="form-group">
            <input id="file-2" type="file" class="file" readonly data-show-upload="false">
        </div>
        <hr>
        <div class="form-group">
            <label>Preview File Icon</label>
            <input id="file-3" type="file" multiple>
        </div>
        <hr>
        <div class="form-group">
            <input id="file-4" type="file" class="file" data-upload-url="#">
        </div>
        <hr>
        <div class="form-group">
            <button class="btn btn-warning" type="button">Disable Test</button>
            <button class="btn btn-info" type="reset">Refresh Test</button>
            <button class="btn btn-primary">Submit</button>
            <button class="btn btn-default" type="reset">Reset</button>
        </div>
        <hr>
        <div class="form-group">
            <input type="file" class="file" id="test-upload" multiple>
            <div id="errorBlock" class="help-block"></div>
        </div>
        <hr>
        <div class="form-group">
            <input id="file-5" class="file" type="file" multiple data-preview-file-type="any" data-upload-url="#">
        </div>
    </form>


    <hr>
    <h4>Multi Language Inputs</h4>
    <form enctype="multipart/form-data">
        <label>French Input</label>
        <input id="file-fr" name="file-fr[]" type="file" multiple>
        <hr style="border: 2px dotted">
        <label>Spanish Input</label>
        <input id="file-es" name="file-es[]" type="file" multiple>
    </form>
    <hr>
    <br>
</div>
</body>


	<script src="../componentes/externos/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="../componentes/externos/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="../componentes/externos/bower_components/bootstrap/dist/js/bootstrapValidator.min.js"></script>
	<script src="../componentes/externos/dist/js/adminlte.min.js"></script>
    <script src="bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>
    <script src="bootstrap-fileinput/js/locales/pt-BR.js" type="text/javascript"></script>
    <script src="bootstrap-fileinput/themes/explorer/theme.js" type="text/javascript"></script>
    <script src="bootstrap-fileinput/js/plugins/sortable.js" type="text/javascript"></script>
<!-- the fileinput plugin initialization -->
<script>
var btnCust = '<button type="button" class="btn btn-default" title="Add picture tags" ' +
    'onclick="alert(\'Call your custom code here.\')">' +
    '<i class="glyphicon glyphicon-tag"></i>' +
    '</button>';
$("#avatar-2").fileinput({
    overwriteInitial: true,
    maxFileSize: 1500,
    showClose: false,
    showCaption: false,
    showBrowse: false,
    browseOnZoneClick: true,
    removeLabel: '',
    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
    removeTitle: 'Cancel or reset changes',
    elErrorContainer: '#kv-avatar-errors-2',
    msgErrorClass: 'alert alert-block alert-danger',
    defaultPreviewContent: '<img src="../tmp/bootstrap-fileinput/img/default_avatar_male.jpg" alt="Your Avatar" style="width:160px"><h6 class="text-muted">Click to select</h6>',
    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
    allowedFileExtensions: ["jpg", "png", "gif"]
});
</script>
	<script>
    $(document).on('ready', function() {
        $("#input-24").fileinput({
            initialPreview: [
                '../componentes/externos/dist/img/avatar1.png',
                '../componentes/externos/dist/img/avatar2.png'
            ],
            initialPreviewAsData: true,
            initialPreviewConfig: [
                {caption: "Moon.jpg", size: 930321, width: "120px", key: 1},
                {caption: "Earth.jpg", size: 1218822, width: "120px", key: 2}
            ],
            deleteUrl: "/site/file-delete",
            overwriteInitial: false,
            maxFileSize: 100,
            initialCaption: "The Moon and the Earth"
        });
    });
    </script>

    <script>
    $(document).on('ready', function() {
        $("#input-44").fileinput({
            uploadUrl: '/file-upload-batch/2',
            maxFilePreviewSize: 10240
        });
    });
    </script>
</body>

</html>
