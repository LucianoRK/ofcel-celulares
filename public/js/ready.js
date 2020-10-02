function template() {
    jQuery('.scrollbar-inner').scrollbar();
    $('[data-toggle="tooltip"]').tooltip()

    var toggle_sidebar = false,
        toggle_topbar = false,
        nav_open = 0,
        topbar_open = 0;

    if (!toggle_sidebar) {
        $toggle = $('.sidenav-toggler');

        $toggle.click(function() {
            if (nav_open == 1) {
                $('html').removeClass('nav_open');
                $toggle.removeClass('toggled');
                nav_open = 0;
            } else {
                $('html').addClass('nav_open');
                $toggle.addClass('toggled');
                nav_open = 1;
            }
        });
        toggle_sidebar = true;
    }

    if (!toggle_topbar) {
        $topbar = $('.topbar-toggler');

        $topbar.click(function() {
            if (topbar_open == 1) {
                $('html').removeClass('topbar_open');
                $topbar.removeClass('toggled');
                topbar_open = 0;
            } else {
                $('html').addClass('topbar_open');
                $topbar.addClass('toggled');
                topbar_open = 1;
            }
        });
        toggle_topbar = true;
    }

    //select all
    $('[data-select="checkbox"]').change(function() {
        $target = $(this).attr('data-target');
        $($target).prop('checked', $(this).prop("checked"));
    })
}

function mask() {
    $('.maskDate').mask('11/11/1111');
    $('.maskTime').mask('00:00:00');
    $('.maskDateTime').mask('99/99/9999 00:00:00');
    $('.maskCep').mask('99999-999');
    $('.maskTelefone').mask("(99) 9999-9999#").focusout(function(event) {
        if ($(this).val().length == 15) {
            $(this).unmask();
            $(this).mask('(99) 99999-9999');
        } else {
            $(this).unmask();
            $(this).mask('(99) 9999-9999');
        }
    })
}


$(document).ready(function() {
    template()
    mask()
});