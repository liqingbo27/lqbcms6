/*
 * @Author: 莫卓才
 * @eMail: handsome.mo@foxmail.com
 * @Descripttion: 描述
 * @version: 1.0.0
 * @Date: 2019-11-08 09:25:20
 * @LastEditors: 莫卓才
 * @LastEditTime: 2020-07-03 09:39:00
 */
// 手机端轮播图
var swiper = new Swiper('.swiper-container', {
  slidesPerView: 1,
  spaceBetween: 90,
  autoplay: {
    delay: 3000,//1秒切换一次
    disableOnInteraction: false,
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  breakpoints: {
    1000: {  //当屏幕宽度大于等于1280
      slidesPerView: 1,
      spaceBetween: 90
    }
  }
});

$(function () {
  //手机端添菜单栏添加二级图标
  var ul = $('.menu-list ul').children('li').prevObject[0];
  var li = ul.children;
  for (var item of li) {
    var nav_list = item.querySelector('.nav_list');
    var a = item.querySelector('a');
    if (nav_list) {
      a.setAttribute('class', 'hide');
    }
  }
  //手机端菜单
  $('.click-sidebar').click(function () {
    $('.mask2').fadeIn();
    $('.right').animate({ 'left': 0 }, 200);
    $('.sidebar').animate({ 'left': 0 }, 200);
    $('.mobile-logo').animate({ 'left': 0 }, 200);
  });
  $('.mask2').click(function () {
    $('.mask2').fadeOut();
    $('.mobile-logo').animate({ 'left': -$('.mobile-logo').width() * 2 }, 200);
    $('.right').animate({ 'left': -$('.right').width() * 2 }, 200);
    $('.sidebar').animate({ 'left': -$('.sidebar').width() }, 200);
  });
  $('.close-btn').click(function () {
    $('.mask2').fadeOut();
    $('.mobile-logo').animate({ 'left': -$('.mobile-logo').width() * 2 }, 200);
    $('.right').animate({ 'left': -$('.right').width() * 2 }, 200);
    $('.sidebar').animate({ 'left': -$('.sidebar').width() }, 200);
  });
  //二级菜单
  $('.menu-list li').click(function () {
    var nav_list = $(this).find('.nav_list');
    var a = $(this).children()[0];
    if (nav_list.length > 0) {
      a.className.indexOf('hide') !== -1
        ? a.setAttribute('class', 'show')
        : a.setAttribute('class', 'hide');
      nav_list.slideToggle();
    }
  })
  $('.submit_btn').click(function () {
    var nickname = $('input[name=nickname]').val();
    var phone = $('input[name=phone]').val();
    var content = $('textarea[name=content]').val();
    var verify = $('input[name=code]').val();

    if (/^\s*$/g.test(nickname)) {
      layer.msg("姓名不能为空");
      return false
    }
    if (!(/^1(3|4|5|6|7|8|9)\d{9}$/.test(phone))) {
      layer.msg("手机号码有误，请重填");
      return false
    }
    if (/^\s*$/g.test(content)) {
      layer.msg("备注不能为空");
      return false
    }
    if (/^\s*$/g.test(verify)) {
      layer.msg("验证码不能为空");
      return false
    }
    $.ajax({
      url: '/about/contact',
      type: 'POST',
      data: {
        nickname: nickname,
        phone: phone,
        content: content,
        verify: verify
      },
      dataType: 'json',
      success: function (res) {
        res.code == 1 ? layer.msg(res.msg) : layer.msg(res.msg);
      }
    })
  })
  // 英文端菜单宽度
  $('.nav .nav_list').each(function () {
    var _this = $(this);
    var parent = _this.parent();
    _this.css('minWidth', parent.width());
  })
})