<script type="text/javascript" src="{{ asset('vendor/grids/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/grids/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.'. App::getLocale() .'.min.js') }}"></script>
<script type="text/javascript">
    $('.input-daterange').datepicker({
        todayBtn: "linked",
        format: 'yyyy-mm-dd',
        language: "{{ App::getLocale() }}"
    });
</script>