$(document).ready(function() {
    $(document).on('pjax:end', function() {
            setTimeout(function() {
                $('.opened').addClass('open').addClass('manual');
            }, 500);

            setTimeout(function() {
                $('.box:not(.opened)').addClass('open');
            }, 1000);

            setTimeout(function() {
                $('#restart').addClass('show');
            }, 1500);
        });

        $('.open-box').on('click', function() {
        let boxId = $(this).data('box-id');

        $('#' + boxId).find('input.box-opened').val(1);

        $('#riddle-form').submit();
    });
});
