import $ from 'jquery';

const sliders = ["#image1", "#image2", "#image3", "#image4", "#image5"];
let sliderAtual = 0;
let sliderMaximo = 4;
const time = 10000;

$(function() {
  $(sliders[sliderAtual]).fadeTo(0, 1);
  setInterval(changeSliders, time);

  function changeSliders() {
    $(sliders[sliderAtual]).fadeOut(1000);
    sliderAtual++;
    if (sliderAtual > sliderMaximo) {
      sliderAtual = 0;
    }
    $(sliders[sliderAtual]).fadeIn(1000);
  }
});
