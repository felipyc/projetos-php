
function mudaSenha(algarismo){

    var senha = document.getElementById('input_password');

    if(senha.value == ''){
        senha.value = algarismo;
    }else{
        if( senha.value < 99999 && algarismo != 10 ){
            senha.value = (senha.value*10)+algarismo;
        }else{
            if( algarismo == 10 ){
                senha.value = '';
            }
        }
    }
}