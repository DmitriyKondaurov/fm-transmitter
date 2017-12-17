$(document).ready(function() {
    //ТАБ меню
    $('ul#primary-menu li:nth-child(1)').addClass('active'); //активируем первый  таб в меню

    (function($) {
        $(function() {
            $('ul#primary-menu').on('click', 'li:not(.active)', function() {
                $(this)
                //активируем нажатый ТАБ
                    .addClass('active').siblings().removeClass('active');
                // активируем контент, соответствующий нажатому ТАБУ
                    $('div.tabs__content').removeClass('active').eq($(this).index()).addClass('active');
            });
        });
    })(jQuery);
});
