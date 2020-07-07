function PhoneMask(phone){  
	if(integerMask(phone)==false){
		event.returnValue = false;
	}       
	return formatField(phone, '(00)00000-0000', event);
}

function CPFMask(cpf){
	if(integerMask(cpf)==false){
		event.returnValue = false;
	}       
	return formatField(cpf, '000.000.000-00', event);
}

function ValidatesCPF(Objcpf){
    if(Objcpf.value.length > 0){
        var cpf = Objcpf.value;
        exp = /\.|\-/g
        cpf = cpf.toString().replace( exp, "" );
        var typedDigit = eval(cpf.charAt(9)+cpf.charAt(10));
        var sum1=0, sum2=0;
        var vle =11;

        for(i=0;i<9;i++){
                sum1+=eval(cpf.charAt(i)*(vle-1));
                sum2+=eval(cpf.charAt(i)*vle);
                vle--;
        }       
        sum1 = (((sum1*10)%11)==10 ? 0:((sum1*10)%11));
        sum2=(((sum2+(2*sum1))*10)%11);

        var generatedDigit=(sum1*10)+sum2;
        
		if(Objcpf.value.length < 14){
			alert('CPF deve conter 11 dígitos.');
			Objcpf.blur();
		}else{
			if(generatedDigit!=typedDigit){       
				alert('CPF Invalido!');
				Objcpf.blur();
			}
		}       
    }    
}

function ValidatesEmail(Objemail){
    if(Objemail.value.length > 0){
		var user = Objemail.value.substring(0, Objemail.value.indexOf("@"));
		var domain = Objemail.value.substring(Objemail.value.indexOf("@")+ 1, Objemail.value.length);

        if ((usuario.length >=1) &&
		(dominio.length >=3) && 
		(usuario.search("@")==-1) && 
		(dominio.search("@")==-1) &&
		(usuario.search(" ")==-1) && 
		(dominio.search(" ")==-1) &&
		(dominio.search(".")!=-1) &&      
		(dominio.indexOf(".") >=1)&& 
		(dominio.lastIndexOf(".") < dominio.length - 1)){
				
		} else {
			alert('E-mail invalido!');
			Objemail.blur();
		}   
    }    
}

function integerMask(){
    if (event.keyCode < 48 || event.keyCode > 57){
            event.returnValue = false;
            return false;
    }
    return true;
}

function charMask(){
    var caract = new RegExp(/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/i);
    var caract = caract.test(String.fromCharCode(event.keyCode));
    if(!caract){
         event.returnValue = false;
         return false;
    }
    return true;
}

function formatField(field, Mask, event) { 
        var maskBoolean; 

        var Digitato = event.keyCode;
        exp = /\-|\.|\/|\(|\)| /g
        onlyNumber = field.value.toString().replace( exp, "" ); 

        var positionField = 0;    
        var NewValueField = "";
        var MaskLenght = onlyNumber.length;; 

        if (Digitato != 8) { // backspace 
                for(i=0; i<= MaskLenght; i++) { 
                        maskBoolean  = ((Mask.charAt(i) == "-") || (Mask.charAt(i) == ".")
                                                                || (Mask.charAt(i) == "/")) 
                        maskBoolean  = maskBoolean || ((Mask.charAt(i) == "(") 
                                                                || (Mask.charAt(i) == ")") || (Mask.charAt(i) == " ")) 
                        if (maskBoolean) { 
                                NewValueField += Mask.charAt(i); 
                                  MaskLenght++;
                        }else { 
                                NewValueField += onlyNumber.charAt(positionField); 
                                positionField++; 
                          }              
                  }      
                field.value = NewValueField;
                  return true; 
        } else { 
                return true; 
        }
}