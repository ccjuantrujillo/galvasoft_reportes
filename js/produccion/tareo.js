jQuery(document).ready(function(){
    $(".cabecera_class").click(function(){
        $('.cabecera_class').css('backgroundColor','#FFFFFF');
        $(this).css('backgroundColor','#66ff33');  
        codigo = $(this).attr("id");
        nomper = $(this).attr("id2");
        coddni = $(this).attr("id3");
        estado = $(this).attr("id4");
        fecha  = $("#fecha").val();
        url    = base_url+"index.php/produccion/tareo/tareoot_detalle";
        dataString1 = "codres="+codigo+'&fecha='+fecha+'&dni='+coddni+'&estado='+estado;
        contenido  = "";
        $.post(url,dataString1,function(data){
            contenido = " <div id='label' style='float:left;height:35px;font-size:13px;font-weight: bold;'>";
            contenido+= "<input type='hidden' name='dni' id='dni' value='"+coddni+"'>";
            contenido+= "<input type='hidden' name='codres' id='codres' value='"+codigo+"'>PERSONA: "+nomper;
           /* if(estado!='C'){*/
                contenido+= "<a href='javascript:;' onclick='agrega_tareo();'></strong><img border='0' src='"+base_url+"img/notes-add.gif'></a>";
        /*   }*/
            contenido+= "</div>";
            $("#detalle").html(data);
            $("#label").html(contenido);
        });
    });
    
    $("#html.HorasH").click(function(){
        $("#tipoexport").val('html');
        $("#frmHorasH").attr("target","_parent");
        $("#frmHorasH").submit();
    });	 
    $("#excel.HorasH").click(function(){
//        $("#tipoexport").val('excel');
//        $("#frmHorasH").attr("target","_parent");        
//        $("#frmHorasH").submit();
        url = base_url +'index.php/produccion/tareo/export_excel/hhporot';
        window.open(url, this.target, 'width=600,height=250,top=150,left=200');         
    });	     
    $("#pdf.HorasH").click(function(){
        $("#tipoexport").val('pdf');
        $("#frmHorasH").attr("target","_blank");
        $("#frmHorasH").submit();
    });	   
    $("#salir.HorasH").click(function(){
        window.close();
    });	    

/* Exportaciones..................... */

    $("#html.ot_listar").click(function(){
        $("#tipoexport").val('');
        $("#frmBusqueda").attr("target","_parent");        
        $("#frmBusqueda").submit();
        
    });	

    $("#excel.ot_listar").click(function(){
       $("#tipoexport").val('excel');
       $("#frmBusqueda").attr("target","_parent");        
       $("#frmBusqueda").submit();
       $("#tipoexport").val('');
    });	   
    	    
    $("#salir.ot_listar").click(function(){
        window.close();
    }); 
    
    
});

function agrega_tareo(){
    nrofilas = $("#txtDetalle").val();
    if(nrofilas==0) {$("#tabla_detalle tr").remove();$("#txtDetalle").val('1');}
    codigo = $("#codres").val();
    coddni = $("#dni").val();
    fecha  = $("#fecha").val();
    n      = $("#tabla_detalle tr").length;
    k      = n+1;
    fila   = "<tr>";
    fila  += "<td style='width:3%;' align='center'>"+k+"</td>";
    fila  += "<td  style='width:10%;' align='left'><input type='text' class='otclass' name='codot["+n+"]' id='codot["+n+"]' style='display:none;'><input type='text' readonly name='ot["+n+"]' id='ot["+n+"]' value='' style='width:70px;'><a href='javascript:;' onclick='agrega_ot("+n+");'><img src='"+base_url+"img/anadir.jpg' border='0' width='15px;' height='15px;'></a></td>";
    fila  += "<td  style='width:23%;' align='left'><input type='text' readonly name='site["+n+"]' id='site["+n+"]' style='width:210px;'></td>";
    fila  += "<td style='width:13%;' align='center'><input type='hidden' name='area_old["+n+"]' id='area_old["+n+"]' style='width:25px;'><select class='comboMedio' name='area["+n+"]' id='area["+n+"]' onclick='javascript:valid_ot(this,"+n+")'></select></td>";
//    fila  += "<td style='width:13%;' align='center'><input type='hidden' name='area_old["+n+"]' id='area_old["+n+"]' style='width:25px;'><select class='comboMedio' name='area["+n+"]' id='area["+n+"]' onclick=''></select></td>";
    fila  += "<td style='width:7%;' align='center'><span class='filatareo'>";
    fila  += "<input type='text' maxlength='5' onkeypress='return numbersonly(this,event,\".\");' name='hora["+n+"]' id='hora["+n+"]'style='width:50px;'>";
    fila  += "<input type='hidden' maxlength='5' name='hora_old["+n+"]' id='hora_old["+n+"]' style='width:50px;' value='0'>";    
    fila  += "</span></td>";
    fila  += "<td style='width:7%;' align='center'><input type='text' maxlength='5' onkeypress='return numbersonly(this,event,\".\");' name='cantidad["+n+"]' id='cantidad["+n+"]' style='width:50px;'></td>";
    fila  += "<td style='width:23%;' align='left'><input type='text' name='descripcion["+n+"]' id='descripcion["+n+"]'style='width:250px;'></td>";
    fila  += "<td style='width:7%;' align='center'>&nbsp;<input type='hidden' name='accion["+n+"]' id='accion["+n+"]' value='N' style='width:20px;'></td>";
    fila  += "</tr>";
    $("#tabla_detalle").append(fila);
    seleccionar_area(n);
}
function seleccionar_area(n){
    a      = "area["+n+"]";
    url    = base_url+"index.php/produccion/tareo/seleccionar_areapro";
    select = document.getElementById(a);
    $.getJSON(url,function(data){
          $.each(data, function(i,item){
            codigo      = i;
            descripcion = item;
            opt         = document.createElement('option');

                texto       = document.createTextNode(descripcion);
                opt.appendChild(texto);
                opt.value = codigo;
                select.appendChild(opt);
          });
    });
}
function agrega_ot(n){
    //url    = base_url+"index.php/produccion/tareo/seleccionar_areapro";
    window.open(base_url+"index.php/ventas/ot/buscar/"+n,"","width=750px,height=430px,noresize=no");
}
function cargar_ot(n,codot,tipo){
    a = "codot["+n+"]";
    b = "ot["+n+"]";
    c = "site["+n+"]";
    document.getElementById(a).value = codot;
    url    = base_url+"index.php/ventas/ot/obtener/"+codot+"/"+tipo;
    $.getJSON(url,function(data){
        nroot = data.NroOt;
        dirot = data.DirOt;
        tipot = data.TipOt;
        document.getElementById(b).value = nroot;
        document.getElementById(c).value = dirot;
        //seleccionar_area(n,tipot);
    });
}
function cargar_ot2(codot,tipo){
    url    = base_url+"index.php/ventas/ot/obtener/"+codot+"/"+tipo;
    if(codot!='' && tipo!=''){
        $.getJSON(url,function(data){
            nroot = data.NroOt;      
            $("#codot").val(codot);        
            $("#ot").val(nroot);
            $("#tipot").val(tipo);
            $("#fecha").val('');
            $("#area").val('000');
            $("#codres").val('000000');
            $("#tipoexport").val('');
            $("#frmBusqueda").attr("target","_top");  
            $("#frmBusqueda").submit();
        }); 
    }
    else{
        $("#codot").val('');        
        $("#ot").val('');  
        $("#tipot").val(tipo);
        $("#area").val('');    
        $("#codres").val('');    
        $("#tipoexport").val('');
        $("#frmBusqueda").attr("target","_top");  
        $("#frmBusqueda").submit();
   
    }
}
function numbersonly(myfield, e, dec) 
{
	var key;
	var keychar;
	if (window.event)	
		key = window.event.keyCode;	
	else if (e)	
		key = e.which;
	else	
		return true;	
	keychar = String.fromCharCode(key);
	// control keys
	//if ((key==13) )	
			//alert("aaaaaaaa");
	
	if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) )	
		return true;
	// numbers  
	if (dec && (keychar == "." || keychar == ","))  
	{ 
		var temp=""+myfield.value;	
		if(temp.indexOf(keychar) > -1) 
			return false;  
	}  
	else if ((("0123456789").indexOf(keychar) > -1))  
		return true;
	// decimal point jump  
	else  
	return false;  
}
function graba_tareo_total(){   
    vacios = $(".filatareo input").val().length;
    datastring = $("#frmDetalle").serialize();
    url        = base_url+"index.php/produccion/tareo/grabar";
    fecha      = $("#fecha").val();
    valida     = true;
    j          = 0;
    $("select").each(function(){
        valor = $(this).val();
        a     = "codot["+j+"]";
        codot = document.getElementById(a).value;
        if(valor=='000' && codot!="") valida =false;
        j++;
    });
    if(valida){
        $.post(url,datastring,function(data){
            obj = $.parseJSON(data);
                $.each(obj, function(index, value) {
                    if(value==0){
                        alert('Las HH para la OT '+index+' no se registraran porque superaron las horas presupuestadas.\n Favor comunicarse con el area Comercial');
                    }
                });
            $("#fecha").val(fecha);
            $("#frmBusqueda").submit();        
        });        
    }
    else{
        alert("Debe ingresar el Area de produccion.");
    }
}

function borrar_detalle(n){
     if(confirm('Esta seguro que desea borrar este registro?')){
        codigo      = $("#codres").val();
        coddni      = $("#dni").val();
        fecha       = $("#fecha").val();
        a           = "area["+n+"]";
        b           = "codot["+n+"]";
        c           = "hora["+n+"]";
        d           = "hora_old["+n+"]";
        aproduccion = document.getElementById(a).value;
        codot       = document.getElementById(b).value;
        hora        = document.getElementById(c).value;
        hora_old    = document.getElementById(d).value;
        datastring  = "codres="+codigo+"&dni="+coddni+"&fecha="+fecha+"&codot="+codot+"&aproduccion="+aproduccion+"&hora="+hora+"&hora_old="+hora_old;
        url         = base_url+"index.php/produccion/tareo/eliminar";
        $.post(url,datastring,function(data){
           $("#fecha").val(fecha);
           $("#frmBusqueda").submit();
        });
    }
}

function valid_ot(obj,index){
    var txt_ot  = "ot["+index+"]";
    var ot      = document.getElementById(txt_ot).value;
    if(ot==''){
        alert("Seleccione la OT");
        return false
    }
    
    var n = ot.search("CC");
    if(n!=0){
        var x = document.getElementById("area["+index+"]");
       // x.remove(8);  
    }else{
        var x = document.getElementById("area["+index+"]");
        //x.remove(9);  
    }
}