/* Particle */
function setParticle() {
    if($('#particles-js').length != 0){
        particlesJS.load('particles-js', 'http://127.0.0.1/luc2017/web/js/particle/particlesjs-config.json');
    }

    if($('#particles-light-js').length != 0){
        particlesJS.load('particles-light-js', 'http://127.0.0.1/luc2017/web/js/particle/particlesjs-config-light.json');
    }

    if($('#particles-forme-js').length != 0){
        particlesJS.load('particles-forme-js', 'http://127.0.0.1/luc2017/web/js/particle/particlesjs-config-contact.json');
    }
}

function navAnimate(elem){
    var url = (elem.attr('data-url') != undefined) ? elem.attr('data-url') : elem.attr('href') ;

    $('.main').removeClass('current');

    setTimeout(function(){
        window.location.href = url;
    }, 450);
}

$(function(){

    /* Animation */
    var controller = new ScrollMagic.Controller();

    if($('.section1').length != 0) {
        new ScrollMagic.Scene({triggerElement: ".section1", duration: $(window).height() + 75 })
            .setTween(TweenMax.fromTo(".section1 .section1LogoLeft", 1, {top: $('.section1').height()}, {top: 0}))
            .addTo(controller)
            .on("progress", function (e) {
                var objTop = $('.section1LogoLeft').offset().top;
                var scrollTop = $(window).scrollTop()
                var menu = $('.menu');

                if ((objTop - scrollTop) < 0) {
                    $('.menu').addClass('current');
                } else {
                    $('.menu').removeClass('current');
                }
            });

        new ScrollMagic.Scene({triggerElement: ".section1", duration:$('.section1').height()})
            .setTween(TweenMax.fromTo(".section1 .section1Right img", 1, {scale:0.8}, {scale:1}))
            .addTo(controller);
    }

    if($('.section3').length != 0) {
        new ScrollMagic.Scene({triggerElement: ".section3", duration: 500})
            .setTween(TweenMax.fromTo(".section3All", 1, {y: 60}, {y: 0}))
            .addTo(controller);

        new ScrollMagic.Scene({triggerElement: ".section3", duration: 800})
            .setTween(TweenMax.fromTo(".section3Nom", 1, {y: -200}, {y: 0}))
            .addTo(controller);

        new ScrollMagic.Scene({triggerElement: ".section3", duration: $('.section3').height()})
            .setTween(TweenMax.fromTo(".section3Competence", 1, {scale: 0.6}, {scale: 1}))
            .addTo(controller);
    }

    /* Ouverture menu */
    $(document).on('click','.menuBtn',function(){
        var btn = $(this);
        var menu = $('.menuContenu');

        if(btn.hasClass('current')){
            btn.removeClass('current');
            menu.removeClass('current');
        }else{
            btn.addClass('current');
            menu.addClass('current');
        }
    });

    /* Position du SVG pinelli */
    if($('.section3Nom').length){
        $('.section3Nom').css({left:($('.section3 .inner h2').offset().left - 62)});
    }

    /* Formulaire de contact */
    $(document).on('focusin','.form-elem',function(){

        var elem = $(this);
        var group = elem.parent('.form-group');

        $.each($('.form-group'), function(key, value) {
            var group = $(value);
            if(group.find('.form-elem').val() == '') group.removeClass('current');
        });

        group.addClass('current');

    });

    $(document).on('focusout','.form-elem',function(){
        $.each($('.form-group'), function(key, value) {
            var group = $(value);
            if(group.find('.form-elem').val() == '') group.removeClass('current');
        });
    });

    /* Soumission du formulaire */
    $(document).on('click','.section5Right button',function(e){
        e.preventDefault();
        var button = $(this);
        var url = $('.section5Right form').attr('action');
        var html = '';

        if(!button.hasClass('currentModule')){

            var fd = new FormData(document.getElementById("contactFormJs"));

            button.prepend('<i class="fa fa-refresh fa-spin"></i>');
            button.addClass('currentModule');

            $.ajax(url,{
                type: 'POST',
                data: fd,
                processData: false,
                contentType: false,
                dataType: 'json',
                cache:false
            })
            .done(function(data){
                button.find('.fa').remove();
                button.removeClass('currentModule');

                /* Supprimer le message si il éxiste déjà */
                if($('.message').length) $('.message').remove();

                /* Afficher le résultat */
                if(data.succes != undefined){
                    html = '<div class="message" id="succes"><span class="messageCouleur"></span><p>';
                    html += data.succes;
                    html += '</p></div>';

                    /* Reset des champs */
                    $('input[name="contactbundle_contact[nom]"]').val('');
                    $('input[name="contactbundle_contact[email]"]').val('');
                    $('textarea[name="contactbundle_contact[contenu]"]').val('');

                    $('.form-group').removeClass('current');
                }
                else{
                    var label = Object.keys(data.error);

                    html = '<div class="message" id="erreur"><span class="messageCouleur"></span><p>';
                    for (var i = 0; i < label.length; i++) {
                        html += data.error[label[i]][0]+'<br>';
                    }
                    html += '</p></div>';
                }

                /* Afficher le contenu des messages */
                $(html).hide().prependTo($('.section5Right')).fadeIn();
            })
            .fail(function(){
                alert('Erreur ajax');
            });

        }

    });

    /* navigation */
    $(document).on('click','.navAnimate',function(e){
        e.preventDefault();

        navAnimate($(this));
    });

    /* Navigation en cliquant sur le menu */
    $(document).on('click','.menu li a',function(e){
        e.preventDefault();

        var elem = $(this);
        var ancre = elem.attr('data-ancre');

        var home = (!$('body').hasClass('noHome')) ? true : false;

        if(home){
            if(ancre == undefined) navAnimate(elem);
            else{
                var offset = $('#'+ancre).offset();
                var top = offset.top;

                $('body, html').stop().animate({scrollTop:top}, 1200);
            }
        }else{
            navAnimate(elem);
        }

        $('.menuBtn, .menuContenu').removeClass('current');
    });

    /* navigation en cliquant sur le logo */
    $(document).on('click','.menuLogo a',function(e){
        e.preventDefault();

        var elem = $(this);
        var home = (!$('body').hasClass('noHome')) ? true : false;

        if(home){
            $('body, html').stop().animate({scrollTop:0}, 1200);
        }else{
            navAnimate(elem);
        }

    });

    if($('.projetsListe').length != 0){
        $('.projetsListe').isotope({
            itemSelector: '.projetListe',
            percentPosition: true,
            filter: '*',
            masonery: {
                columnWidth: '.projetListe'
            }
        });
    }

    /* Changement de catégorie pour la liste des projets */
    $(document).on('click','.projetsListeCategorie p',function(e){
        var lien = $(this);
        var categorie = lien.attr('data-filter');

        $('.projetsListe').isotope({
            filter: categorie,
        });

        $('.projetsListeCategorie p').removeClass('current');
        lien.addClass('current');
    });

    /* Navigation extérieur */
    $(document).on('click','.navExt',function(e){
        e.preventDefault();

        var elem = $(this);
        var url = elem.attr('data-url');

        window.open(url);
    });

});

$(window).scroll(function(){

    var scroll = $(document).scrollTop();
    if(scroll > 10){
        $('.menuBtn, .menuContenu').removeClass('current');
    }

})

$(window).on('load', function() {

    if($('.projetsListe').length != 0){
        $('.projetsListe').isotope({
            itemSelector: '.projetListe',
            percentPosition: true,
            filter: '*',
            masonery: {
                columnWidth: '.projetListe'
            }
        });
    }

    /* Chargement */
    if($('.noLoader').length == 0) {
        if (sessionStorage.getItem('loader') == null) {

            var loaderTime = 3000;
            var fadeTime = 800;
            sessionStorage.setItem('loader', true);
            $('.loaderInner').fadeIn(600);
            new Vivus('loaderSvg', {type: 'oneByOne', duration: 280}).play();

        } else {

            var loaderTime = 1000;
            var fadeTime = 400;
            $('.loaderInnerPage').fadeIn('fast');
            new Vivus('loaderSvgPage', {type: 'oneByOne', duration: 100}).play();

        }

        setTimeout(function () {
            setParticle();
            $('.loader').fadeOut(fadeTime);
        }, loaderTime);
    }else{
        $('.loader').hide();
    }

    /* Zoom sur le titre début de page */
    $('.main').addClass('current');
});

$(window).on('resize',function(){
    /* Position du SVG pinelli */
    if($('.section3Nom').length){
        $('.section3Nom').css({left:($('.section3 .inner h2').offset().left - 62)});
    }
})
