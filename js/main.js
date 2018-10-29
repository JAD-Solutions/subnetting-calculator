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