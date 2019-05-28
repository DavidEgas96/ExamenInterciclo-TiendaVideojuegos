validarCamposObligatorios();
validarCedula();
validarnombre();
validarApellido();
validarEdad();
validarCorreo();




function validarCamposObligatorios(formulario){
	var cont = 0;
    		
		


	for (var i =0; i < formulario.length-2; i++){
		var elemento = formulario.elements[i];
		
		if(elemento.value == null || elemento.value == ''){
			
			elemento.style.border = "2px solid red";
			
		}else{
            elemento.style.border = "2px solid green";
        }
	}
	
	

	
		
		if(validarCedula()  == true){
			cont++
        } else{
			return false;
		}
    
		
		if(validarnombre()  == true){
			cont++
		}else {
			return false;
		}
    
			
			
		if(validarApellido()  == true){
			cont++
		}else {
			return false;
		}
   
		
		if(validarEdad()  == true){
			cont++
		}else {
			return false;
		}
 
		if(validarCorreo()  == true){
			cont++
		}else {
			return false;
		}
    alert(cont);
    
		
		if (cont == 5){
            alert('todo correcto');
			return true; 
		}else{return false }
		
		
		return false;
	
	
}


function validarCedula(){
	
		var numero = document.getElementById('cedula').value.trim();
        var total = 0;
        var longitud = numero.length;
        var checkLongitud = longitud - 1;
		
		

        if (numero != '' && longitud == 10){
          for(var i = 0; i < checkLongitud; i++){
			  
            if (i%2 == 0) {
				
              var aux = numero.charAt(i) * 2;
			   
              if (aux > 9)
				aux -= 9;
				total += aux;
				
            } else {
              total += parseInt(numero.charAt(i)); // parseInt o concatenará en lugar de sumar
            
			}
          }

          total = total % 10 ? 10 - total % 10 : 0;
		  
          if (numero.charAt(longitud-1) == total) {
                // alert ('corecto');
			
            //document.getElementById('salida').innerHTML = 'Cedula Válida';
                 
			return true;
          }else{
			 alert ('cedula incorrecta');
           // document.getElementById('salida').innerHTML = 'Cedula Inválida';
			return false;
          }
        }else{
             alert ('ingrese 10 numeros');
			//document.getElementById('salida').innerHTML = 'debe ingresar 10 numeros ';
      
			return false;
			
		  }

	
}

function validarnombre(){
	
	var valor = document.getElementById('nombre').value.trim();
	
	
	for(var i = 0; i < valor.length; i++){
		
		
		var texto = valor[i] / valor[i];

		if (texto == 1  ){
              alert ('no ingrese numeros');
			//document.getElementById('salida1').innerHTML = 'no ingrese numeros';
			return false;
			breack;
		}else if(valor.length < 3 ) {
             alert ('nombre incorrecto');
		//document.getElementById('salida1').innerHTML = 'nombre incorrecto';
			return false;
			breack;
		}
		else{
           // alert ('correcto');
			//document.getElementById('salida1').innerHTML = 'Nombre correcto';
			return true;
		}
	}
}

function validarApellido(){
	
	var valor = document.getElementById('apellido').value.trim();
	
	
	for(var i = 0; i < valor.length; i++){
		
		
		var texto = valor[i] / valor[i];

		if (texto == 1  ){
             alert('no ingrese numeros');
			//document.getElementById('salida2').innerHTML = 'no ingrese numeros';
			return false;
			breack;
		}else if(valor.length < 3 ) {
            alert('apellido incorrecto');
		//document.getElementById('salida2').innerHTML = 'Apellido incorrecto';
		return false;
			breack;
		}
		else{
			//document.getElementById('salida2').innerHTML = 'Apellido correcto';
			return true;
		}
	}
	
}

function validarEdad(){
	
	var valor = document.getElementById('edad').value;
	var texto = valor / valor;
	
	if (texto == 1 && valor.length < 3  ){
        
       
		//document.getElementById('salida3').innerHTML = 'Edad correcta';
		return true;
		
		
	}else {
         alert ('edad incorrecta');
		//document.getElementById('salida3').innerHTML = 'Edad incorrecta';
		return false;
	}
	
}

function validarCorreo(){
	var cadena = document.getElementById('correo').value;
	var cont = 0;
	for(var i = 0; i < cadena.length; i++){
		if(cadena[i] == '@'){
			cont++;
					}
		
		if (cadena[i] == '.' && cont == 1){
			if(cadena[i+1] == 'c'){
                
                //alert('esta bn');
				//document.getElementById('salida4').innerHTML = 'Correo valido';
				return true;
			}else{
				 alert('verificar correo');
				//document.getElementById('salida4').innerHTML = 'Verificar correo1';
				return false;
			}
		}
		
	}
	alert('verificar correo');
	//document.getElementById('salida4').innerHTML = 'Verificar correo2';
	return false;
}

 