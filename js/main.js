var ipAdressInput = document.getElementById("ipAdress");
var firstNetmask = document.getElementById("firstNetmask");
var finalNetmask = document.getElementById("finalNetmask");
var tipo = document.getElementById("tipo");
function getIpNetmask() {
    var ipAdress = ipAdressInput.value.split('.');
    if (ipAdress[0] > 0 && ipAdress[0] < 127)
    {
        firstNetmask.value = 8;
        tipo.value="Clase A";
    }
    else if (ipAdress[0] >= 128 && ipAdress[0] < 191)
    {
        firstNetmask.value = 16;
        tipo.value="Clase B";
    }

    else if (ipAdress[0] >= 192 && ipAdress[0] < 223){
        firstNetmask.value = 24;
        tipo.value="Clase C";
    }
    else{
        firstNetmask.value = "No soportado";
    }
    firstNetmask.min=firstNetmask.value;
    finalNetmask.min=firstNetmask.value;
    //el mínimo de la netmask de destino es la netmask por default
}
document.addEventListener("click", getIpNetmask, false);//la función corre al hacer click en cualquier parte de la página

var TxtType = function(el, toRotate, period) {
    this.toRotate = toRotate;
    this.el = el;
    this.loopNum = 0;
    this.period = parseInt(period, 10) || 2000;
    this.txt = '';
    this.tick();
    this.isDeleting = false;
};

TxtType.prototype.tick = function() {
    var i = this.loopNum % this.toRotate.length;
    var fullTxt = this.toRotate[i];

    if (this.isDeleting) {
        this.txt = fullTxt.substring(0, this.txt.length - 1);
    } else {
        this.txt = fullTxt.substring(0, this.txt.length + 1);
    }

    this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

    var that = this;
    var delta = 200 - Math.random() * 100;

    if (this.isDeleting) { delta /= 2; }

    if (!this.isDeleting && this.txt === fullTxt) {
        delta = this.period;
        this.isDeleting = true;
    } else if (this.isDeleting && this.txt === '') {
        this.isDeleting = false;
        this.loopNum++;
        delta = 500;
    }

    setTimeout(function() {
        that.tick();
    }, delta);
};

window.onload = function() {
    var elements = document.getElementsByClassName('typewrite');
    for (var i=0; i<elements.length; i++) {
        var toRotate = elements[i].getAttribute('data-type');
        var period = elements[i].getAttribute('data-period');
        if (toRotate) {
            new TxtType(elements[i], JSON.parse(toRotate), period);
        }
    }
    // INJECT CSS
    var css = document.createElement("style");
    css.type = "text/css";
    css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
    document.body.appendChild(css);
};