$(document).ready(function () {


    $(function () {
        var slider = $('.swiper-container-project-slides')[0];


        var scrollHeight = slider.offsetHeight;

        var heightSlider = $('.swiper-container-project-slides')[0].scrollHeight

        console.log('heightSlider', heightSlider)

        console.log('scrollHeight', scrollHeight)
        $('.b-card-plus .b-card-plus__icon').click(function () {
            $('.b-card-plus')
                .attr('data-open', 'off')
                .css('z-index', '1')
            $(this)
                .parent('.b-card-plus')
                .attr('data-open', 'on')
                .css('z-index', '9999')

            var topPosition = $(this).parents('.b-card-plus').offset().top - heightSlider// зачем то находил юра
            var rightPosition = $(this).parents('.b-card-plus').offset().left//для того что бы не выходило справа
            var Position = $(this).parents('.b-card-plus').position();//для нахождения верхней точки
            var positionTop = Position['top'];// верхняя точка
            var height = $(this).parents('.b-card-plus').height()//высота блока
            var botPoint = positionTop+height;// нижняя точка блока
            var offset = heightSlider - botPoint;//насколько вниз уходит блок
            console.log('Position', Position['top'])
            console.log('height', height)
            console.log('offset', offset)
            console.log('botPoint', botPoint)
            console.log('topPosition', topPosition)
            if (offset < 20){

                $(this).parent('.b-card-plus').find('.b-card_pos').css({
                    'position': 'absolute',
                    'bottom': '-20px',
                })


                if (  $(this).parent('.b-card-plus_mul').find('.multiple_plus')) {
                    var new_pos =  offset - 30;
                    console.log('new_pos сук', new_pos)
                    $(this).parent('.b-card-plus_mul').find('.multiple_plus').css({
                        'position': 'absolute',
                        'top':new_pos,
                    })
                }



            }
            // if(offset < 20 ){
            //     var new_pos =  offset - 30;
            //
            //     console.log('new_pos сук', new_pos)
            //     $(this).parent('.b-card-plus_mul').find('.multiple_plus').css({
            //         'position': 'absolute',
            //         'top':new_pos,
            //     })
            //
            // }

            if (rightPosition>1371.5){
                $(this).parent('.b-card-plus').find('.b-card_pos').css({
                    'position': 'absolute',
                    'right': '0px',
                })
                if ( $(this).parent('.b-card-plus_mul')){

                    var topOffset = $(this).parents('.b-card-plus').offset().top;
                    var new_pos = 0 - topPosition;
                    console.log('new_pos', new_pos)
                    $(this).parent('.b-card-plus_mul').find('.multiple_plus').css({
                        'position': 'absolute',
                        'right':'0',
                    })
                }
            }
        })


        var swiperProject = new Swiper('.swiper-container-project-slides',{
            simulateTouch: false,
            shortSwipes: false,
            longSwipes: false,
            navigation: {
                nextEl: '.swiper-container-project-slides .swiper-button-next',
                prevEl: '.swiper-container-project-slides .swiper-button-prev',
            },
            breakpoints: {
                640: {
                    simulateTouch: true,
                    shortSwipes: true,
                    longSwipes: true,
                }
            },

        });
        if (swiperProject.slides.length==1){
            $('.swiper-container-project-slides .swiper-button-next').hide()
            $('.swiper-container-project-slides .swiper-button-prev').hide()
        }
    })

    $('.b-card-plus .close').click(function () {
        $(this).parents('.b-card-plus').attr('data-open', 'off')
    })
    $('.b-map-project .detail_picture').click(function () {
        $('.b-card-plus')
            .attr('data-open', 'off')
            .css('z-index', '1')
    })
    $('#accordion-project-products').on('hide.bs.collapse', function (e) {
        $(e.target)
            .parents('.panel-default')
            .find('.js-accordion-state .fas')
            .removeClass('fa-chevron-up')
            .addClass('fa-chevron-down')
        return true
    });
    $('#accordion-project-products').on('show.bs.collapse', function (e) {
        $(e.target)
            .parents('.panel-default')
            .find('.js-accordion-state .fas')
            .removeClass('fa-chevron-down')
            .addClass('fa-chevron-up')
        return true
    });
    function gotopageId(id, func) {

        var id = $(id),
            offset = id.offset()

        $('body, html').animate({ scrollTop: offset.top-100 }, 1, func);
    }
    gotopageId('#detail_project_block', function () {
        setTimeout(function () {
            $('#white-curtain').hide()
        }, 1000)
    })
    function setNewHeaderProject(){

        var $tpl = $('.js-tpl-wrp .js-tps-header-project').clone()

        $tpl.find('.item-name-cell .title').text($('#pagetitle').text())
        $tpl.find('div.title').css({'font-size':'23px'})
        $tpl.find('.logo a img').attr("src", $('#header .logo a img').attr('src'))
        $('#headerfixed .logo-row').addClass('wproduct').html($tpl.html());

        reloadTopBasket('wish', $('#ajax_basket'), 200, 5000, 'N');

    }
    setNewHeaderProject()

    function scrollToUp(el){
        $(window).scrollTop($(el).offset().top-180)
    }

    $('.js-toggle-text').click(function () {
        console.log('onClick .js-toggle-text>click')
        if($('.js-short-text').css('display')!='none'){
            $(this).text('Свернуть описание');
            $('.js-short-text').hide();
            $('.js-long-text').show();
        }else{
            scrollToUp('#description')

            setTimeout(function(){
                $(this).text('Читать далее');
                $('.js-short-text').show();
                $('.js-long-text').hide();
            }, 30)
        }
    })
    if (screen.width < 768) {
        $( "#heading182169" ).click() ;
    }

})