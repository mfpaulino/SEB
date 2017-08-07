

		<link href="componentes/externos/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="componentes/externos/bootstrap/css/bootstrapValidator.min.css" rel="stylesheet"/>
<form id="phoneForm" class="form-horizontal">
    <div class="form-group">
        <label class="col-xs-3 control-label">Country</label>
        <div class="col-xs-5">
            <select class="form-control" name="countrySelectBox">
                <option value="US">United States</option>
                <option value="BG">Bulgaria</option>
                <option value="BR">Brazil</option>
                <option value="CN">China</option>
                <option value="CZ">Czech Republic</option>
                <option value="DK">Denmark</option>
                <option value="FR">France</option>
                <option value="DE">Germany</option>
                <option value="IN">India</option>
                <option value="MA">Morocco</option>
                <option value="NL">Netherlands</option>
                <option value="PK">Pakistan</option>
                <option value="RO">Romania</option>
                <option value="RU">Russia</option>
                <option value="SK">Slovakia</option>
                <option value="ES">Spain</option>
                <option value="TH">Thailand</option>
                <option value="AE">United Arab Emirates</option>
                <option value="GB">United Kingdom</option>
                <option value="VE">Venezuela</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-3 control-label">Phone number</label>
        <div class="col-xs-5">
            <input type="text" class="form-control" name="phoneNumber" />
        </div>
    </div>
</form>

		<script src="componentes/externos/jquery/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="componentes/externos/bootstrap/js/bootstrap.min.js"></script>
		<script src="componentes/externos/bootstrap/js/bootstrapValidator.min.js"></script>
<script>
$(document).ready(function() {
    $('#phoneForm')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                phoneNumber: {
                    validators: {
                        phone: {
                            country: 'countrySelectBox',
                            message: 'The value is not valid %s phone number'
                        }
                    }
                }
            }
        })
        // Revalidate phone number when changing the country
        .on('change', '[name="countrySelectBox"]', function(e) {
            $('#phoneForm').formValidation('revalidateField', 'phoneNumber');
        });
});
</script>

