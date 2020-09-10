<script src="{{'https://cdn.queensherainfotech.com/adminltev2/bower_components/jquery/dist/jquery.min.js'}}"></script>
<script src="{{'https://cdn.queensherainfotech.com/adminltev2/bower_components/bootstrap/dist/js/bootstrap.min.js'}}"></script>
<script src="{{'https://cdn.queensherainfotech.com/adminltev2/bower_components/PACE/pace.min.js'}}"></script>
<script src="{{'https://cdn.queensherainfotech.com/adminltev2/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'}}"></script>
<script src="{{'https://cdn.queensherainfotech.com/adminltev2/bower_components/fastclick/lib/fastclick.js'}}"></script>
<script src="{{'https://cdn.queensherainfotech.com/adminltev2/dist/js/adminlte.js'}}"></script>
<script src="{{'https://cdn.queensherainfotech.com/adminltev2/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'}}"></script>
<script src="{{'https://cdn.queensherainfotech.com/adminltev2/plugins/timepicker/bootstrap-timepicker.min.js'}}"></script>
<script src="{{'https://cdn.queensherainfotech.com/adminltev2/bower_components/datatables.net/js/jquery.dataTables.min.js'}}"></script>
<script src="{{'https://cdn.queensherainfotech.com/adminltev2/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'}}"></script>
<script src="{{'https://cdn.queensherainfotech.com/adminltev2/bower_components/select2/dist/js/select2.full.min.js'}}"></script>
<script src="{{'https://cdn.queensherainfotech.com/adminltev2/plugins/input-mask/jquery.inputmask.js'}}"></script>
<script src="{{'https://cdn.queensherainfotech.com/adminltev2/plugins/input-mask/jquery.inputmask.date.extensions.js'}}"></script>
<script src="{{'https://cdn.queensherainfotech.com/adminltev2/plugins/input-mask/jquery.inputmask.extensions.js'}}"></script>
<script>
    $(function () {
        $('.select2').select2();
        $('#estbdate').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
        $('#dob').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
        $('#admission_date').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
        $('#startdate').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
        $('#enddate').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
        $('#edate').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
        $('#hdate').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
        $('#complaintdate').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
        $('#postaldate').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
        $('#visitdate').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
        $('#joiningdate').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
        $('#date').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
        $('#leavingdate').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
        $('#dateofpassing').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
        $('#retirementdate').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
    });
    $('#mobile').keypress(function (e) {
        var length = jQuery(this).val().length;
        if(length > 9) {
            return false;
        } else if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        } else if((length == 0) && (e.which == 48)) {
            return false;
        }
    });
    $('#aadhar').keypress(function (e) {
        var length = jQuery(this).val().length;
        if(length > 11) {
            return false;
        } else if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        } else if((length == 0) && (e.which == 48)) {
            return false;
        }
    });
</script>