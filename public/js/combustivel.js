function check1() {
    var checkgasolina = document.getElementById("checkgasolina");
    if (checkgasolina.checked == true) {
        document.getElementById("gasolina").style.color= "#CDA52C";
        document.getElementById("gasolina").style.backgroundColor = "#202020";
        document.getElementById("checkgasolina").checked = false;
        
    }else{
        document.getElementById("gasolina").style.color= "#202020";
        document.getElementById("gasolina").style.backgroundColor = "#CDA52C";
        document.getElementById("checkgasolina").checked = true;
    }
    
}
function check2() {
    var checkgasolina = document.getElementById("checkgasoleo");
    if (checkgasolina.checked == true) {
        document.getElementById("gasoleo").style.color= "#CDA52C";
        document.getElementById("gasoleo").style.backgroundColor = "#202020";
        document.getElementById("checkgasoleo").checked = false;
        
    }else{
        document.getElementById("gasoleo").style.color= "#202020";
        document.getElementById("gasoleo").style.backgroundColor = "#CDA52C";
        document.getElementById("checkgasoleo").checked = true;
    }
    
}
function check3() {
    var checkgasolina = document.getElementById("checkgpl");
    if (checkgasolina.checked == true) {
        document.getElementById("gpl").style.color= "#CDA52C";
        document.getElementById("gpl").style.backgroundColor = "#202020";
        document.getElementById("checkgpl").checked = false;
        
    }else{
        document.getElementById("gpl").style.color= "#202020";
        document.getElementById("gpl").style.backgroundColor = "#CDA52C";
        document.getElementById("checkgpl").checked = true;
    }
    
}
function check4() {
    var checkgasolina = document.getElementById("checkeletrico");
    if (checkgasolina.checked == true) {
        document.getElementById("eletrico").style.color= "#CDA52C";
        document.getElementById("eletrico").style.backgroundColor = "#202020";
        document.getElementById("checkeletrico").checked = false;
        
    }else{
        document.getElementById("eletrico").style.color= "#202020";
        document.getElementById("eletrico").style.backgroundColor = "#CDA52C";
        document.getElementById("checkeletrico").checked = true;
    }
    
}