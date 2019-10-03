function checkRadio(name) {
    if(name == "pf"){
        console.log("Choice: ", name);

        document.getElementById('LabelNameRazao').innerText ="Primeiro Nome";
        document.getElementById('InputNameRazao').placeholder ="Primeiro Nome";

        document.getElementById('LabelSobrenomeFantasia').innerText ="Sobrenome";
        document.getElementById('InputSobrenomeFantasia').placeholder ="Sobrenome";

        document.getElementById('LabelCPF').innerText ="CPF";
        document.getElementById('InputCPF').placeholder ="CPF";

        document.getElementById('LabelRG').innerText ="RG";
        document.getElementById('InputRG').placeholder ="RG";

        document.getElementById('LabelBirthDate').innerText ="Data Nascimento";

        document.getElementById("sexo").style.visibility = "visible";

        document.getElementById("div_marital_status").style.visibility = "visible";


    } else if (name == "pj"){
        console.log("Choice: ", name);


        document.getElementById('LabelNameRazao').innerText ="Razão Social";
        document.getElementById('InputNameRazao').placeholder ="Razão Social";

        document.getElementById('LabelSobrenomeFantasia').innerText ="Nome Fantasia";
        document.getElementById('InputSobrenomeFantasia').placeholder ="Nome Fantasia";

        document.getElementById('LabelCPF').innerText ="CNPJ";
        document.getElementById('InputCPF').placeholder ="CNPJ";

        document.getElementById('LabelRG').innerText ="IE - Inscrição Estadual";
        document.getElementById('InputRG').placeholder ="IE - Inscrição Estadual";

        document.getElementById('LabelBirthDate').innerText ="Data Fundação";

        document.getElementById("sexo").style.visibility = "hidden";

        document.getElementById("div_marital_status").style.visibility = "hidden";



    }
}