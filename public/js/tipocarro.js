function hide() {
    var x = document.getElementById("Tipo_de_Viatura").value;
    if (x == "Mota") {
        document.getElementById('mota1').style.display = "initial";
        document.getElementById('mota2').style.display = "initial";
        document.getElementById('carro1').style.display = "none";
        document.getElementById('carro2').style.display = "none";
        document.getElementById("portas").readOnly  = true;
        document.getElementById("fumador").readOnly  = true;
    }
    if (x == "Carro") {
        document.getElementById('carro1').style.display = "initial";
        document.getElementById('carro2').style.display = "initial";
        document.getElementById('mota1').style.display = "none";
        document.getElementById('mota2').style.display = "none";
        document.getElementById("portas").readOnly  = false;
        document.getElementById("fumador").readOnly  = false;
    }
}      