require([
  'jquery',
], function ($) {
  // $(".footer-middle .block .block-title").click(function(e){
  //   $(this).parent().toggleClass('active');
  // });

  $('.form_right .nav-tabs > li > a').click(function(e){
      e.preventDefault();
      var tab_id = $(this).attr('aria-controls');

      $('.form_right .nav-tabs > li > a').removeClass('active');
      $('.form_right .tab-content .tab-pane').removeClass('show');
      $('.form_right .tab-content .tab-pane').removeClass('active');

      $(this).addClass('active');
      $("#"+tab_id).addClass('show');
      $("#"+tab_id).addClass('active');
  });

  $('.footer-middle .block .block-title a').click(function(e){
      e.preventDefault();
      var tab_id = $(this).attr('aria-controls');
      if ($(this).hasClass('active')) {
        $('.footer-middle .block .block-title a').removeClass('active');
        $('.footer-middle .tab-content .tab-pane').removeClass('active show');
      }else{
        $('.footer-middle .block .block-title a').removeClass('active');
        $('.footer-middle .tab-content .tab-pane').removeClass('active show');
        $(this).addClass('active');
        $("#"+tab_id).addClass('active show');
      }
  });

  $(".dropdown > a").click(function(e){
    $(this).toggleClass('active');
    $(this).next().toggleClass('show');
  });
  $(".custom-block .dropdown-menu .aclose").click(function(e){
    e.preventDefault();
    $(this).parent().removeClass('show');
    $(this).parent().prev().removeClass('show');
  });

  $('.faq_content .tab-content .tab-pane .collapse_item .title h3 a').click(function(e){
      e.preventDefault();
      var tab_id = $(this).attr('data-collapse');

      $('.faq_content .tab-content .tab-pane .collapse_item .title h3 a').removeClass('active');
      $('.faq_content .tab-content .tab-pane .collapse_item .collapse-content').removeClass('show');
      $('.faq_content .tab-content .tab-pane .collapse_item .collapse-content').removeClass('active');

      $(this).toggleClass('active');
      $("#"+tab_id).toggleClass('show');
      $("#"+tab_id).toggleClass('active');
  });
  $('.sidebar_faq .category .content ul > li > a').click(function(e){
      e.preventDefault();
      var tab_id = $(this).attr('data-collapse');

      $('.sidebar_faq .category .content ul > li > a').removeClass('active');
      $('.faq_content .tab-content .tab-pane').removeClass('show');
      $('.faq_content .tab-content .tab-pane').removeClass('active');

      $(this).toggleClass('active');
      $("#"+tab_id).toggleClass('show');
      $("#"+tab_id).toggleClass('active');
  });
  $('.sidebar_faq .category .title > a').click(function(e){
      e.preventDefault();

      $(this).toggleClass('active');
      $(this).parent().next().toggleClass('show');
  });
  $(".land .contact_content>.btn_orange").click(function(e){
    e.preventDefault();
    $('#contact').toggleClass('active');
    $('html, body').animate({
      scrollTop: $("#contact").offset().top
    }, 1000);
  });
  $("#cotiza_btn").click(function(e){
    e.preventDefault();
    $('#cotiza_c').toggleClass('active');
    $('html, body').animate({
      scrollTop: $("#cotiza_c").offset().top
    }, 1000);
  });
  $('#cotiza_c .overlay').click(function(e){
    e.preventDefault();
    $('#cotiza_c').toggleClass('active');
  });
  $('#contact .overlay').click(function(e){
    e.preventDefault();
    $('#contact').toggleClass('active');
  });
  $('#contact .form_contact .input-group a').click(function(e){
    e.preventDefault();
    $('#contact .form_contact .text.compress').removeClass('compress');
  });
  $('#contact .form_contact .text .seemore').click(function(e){
    e.preventDefault();
    $('#contact .form_contact .text').addClass('compress');
  });
  // $('.banner_home .form_right .tab-content form .btn_action .btn-primary').click(function(e){
  //   e.preventDefault();
  //   $(this).parent().parent().parent().parent().removeClass('step_one_active');
  //   $(this).parent().parent().parent().parent().addClass('step_two_active');
  //   $('.banner_home .form_right .tab-content p.steps').html('2.Datos contacto <small>2/2</small>');
  // });
  $(".list_sucursales .item .title h3 a").click(function(e){
    e.preventDefault();
    $(this).parent().parent().parent().toggleClass('active');
  });
  $(".list_sucursales .item .pane_content .map_location").mouseover(function(e){
    e.preventDefault();
    var name = $(this).find('h4').text();
    var img_s = $(this).attr('data-img');
    $('.sucursales_content .item .title h3').html(name);
    $('.sucursales_content .item img').attr('src',img_s);
  });
});