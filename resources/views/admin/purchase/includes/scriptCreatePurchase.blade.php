<script>
    $(document).ready(function() {
        $('.add-new').click(function() {
            $('#purchase').modal('show');
            $('#addUserForm').find('input[type="text"], textarea').val('');
            $('#addUserForm').find('select').val('').change();
            $('#addUserForm').find('.repeater').repeater('reset');
        });
    });

</script>
