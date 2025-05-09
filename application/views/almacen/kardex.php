<!DOCTYPE html>
<html>
<head>
    <title><?php echo titulo;?></title> 
    <link rel="stylesheet" href="<?php echo css;?>estilos.css" type="text/css">
    <link rel="stylesheet" href="<?php echo css;?>nav.css" type="text/css">
    <link rel="stylesheet" href="<?php echo css;?>theme.css" type="text/css">
    <link rel="stylesheet" href="<?php echo css;?>calendario/calendar-win2k-2.css" type="text/css" media="all" title="win2k-cold-1"/>	    

    <script type="text/javascript" src="<?php echo js;?>constants.js"></script> 
    <script type="text/javascript" src="<?php echo js;?>calendario/calendar.js"></script>
    <script type="text/javascript" src="<?php echo js;?>calendario/calendar-es.js"></script>
    <script type="text/javascript" src="<?php echo js;?>calendario/calendar-setup.js"></script>
    <script type="text/javascript" src="<?php echo js;?>jquery.js"></script>
    <script type="text/javascript" src="<?php echo js;?>produccion/tareo_rpt.js"></script>
    <script type="text/javascript" src="<?php echo js;?>almacen/producto.js"></script>
</head>
<body>
    <div id="container">
        <div class="header">KARDEX</div>
        <div class="case_top2">
           <form method="post" id="frmBusqueda">
                <table width="98%" cellspacing="3" cellpadding="3" border="0" style="margin-top:5px;">
                    <tbody>
                        <tr>
                           
                      
                            </td>
                            <td align="left" width="25%">FECHA INI.:
                                <span style="width:500px;border:0px solid #000;" id="Fecha1">
                                    <input  name="fecha_ini" id="fecha_ini" title="Fecha" value="<?php echo $fecha_ini;?>" type="text" readonly="readonly" style='width:80px;' >
                                     <!--  onClick="popUpCalendar(this, frmBusqueda.fecha_ini, 'mm/dd/yyyy');"-->
                                     <img src="<?php echo img;?>calendario.png" name="Calendario1" id="Calendario1" width="25"  border="0" id="Image1" onMouseOver="this.style.cursor='pointer'" title="Calendario" >
                                     <script type="text/javascript">
                                        Calendar.setup({
                                                inputField     :    "fecha_ini",      // id del campo de texto
                                                ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                button         :    "Calendario1",   // el id del bot?n que lanzar? el calendario
                                                onUpdate       :    function(){
                                                   $('#tipoexport').val('');
                                                   //$("#frmBusqueda").submit();
                                                }
                                        });
                                        </script>
                                </span>
                                
                                
                                
                                <font color="white">......................</font>
                                FECHA FIN:
                                <span style="width:500px;border:0px solid #000;" id="Fecha1" >
                                    <input  name="fecha_fin" id="fecha_fin" title="Fecha" value="<?php echo $fecha_fin;?>" type="text" readonly="readonly" style='width:80px;'>
                                    <img src="<?php echo img;?>calendario.png" name="Calendario2" id="Calendario2" width="25"  border="0" id="Image1" onMouseOver="this.style.cursor='pointer'" title="Calendario" ALIGN=BASELINE>
                                    <script type="text/javascript">
                                            Calendar.setup({
                                                    inputField     :    "fecha_fin",      // id del campo de texto
                                                    ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                    button         :    "Calendario2",   // el id del bot?n que lanzar? el calendario
                                                    onUpdate       :    function(){
                                                       $('#tipoexport').val('');
                                                   //    $("#frmBusqueda").submit();
                                                    }
                                            });
                                    </script>
                                </span>
                                
                            </td>
                            <td align="left" width="25%">OT:
                                <input type="hidden" name="tipot" id="tipot" style="width: 100px;" class="cajaPequena" value="<?php echo $tipot;?>">
                                <input type="hidden" name="codot" id="codot" style="width: 100px;" class="cajaPequena" value="">
                                <input type="text" name="ot" id="ot" style="width: 70px;"   class="cajaPequena" value="<?php echo $ot;?>">
                                <img src="<?php echo img;?>ver.png" name="ver" id="ver" width="16" height="16" border="0" id="ver" onMouseOver="this.style.cursor='pointer'" onclick="agrega_ot('');" title="Buscar OT">
                                
                                
                            </td> 
                        </tr>
                        <tr>
                          
                            <td  align="left">
                                <div style="float:left;width:100%;text-align: left;">T. MATERIAL:<?php echo $tipomaterial;?>  ...  T. MOVIMIENTO:<?php echo $tipomovimiento;?></div>
                              <input type="hidden" name="tipoexport" id="tipoexport" style="width: 70px;"  readonly="readonly" class="cajaPequena" value="<?php echo $tipoexport;?>">
                              
                      
                                     </td>
                                     
                                     <td><div style="float:left;width:100%;text-align: left;">PRODUCTO:<?php echo $filtroproducto;?> ... MONEDA:<?php echo $selmoneda;?></div>
                           </td>
                        </tr>                                                         
                    </tbody>
                </table>
            </form> 
        </div> 
	<div class="case_botones">
            <ul class="lista_botones"><li id="salir" class="control_pesos">Salir</li></ul>            
            <ul class="lista_botones"><li id="excel0" class="kardex_xls">Ver Excel</li></ul>
            
        <!--   <ul class="lista_botones"><li id="pdf" class="control_pesos">Ver Pdf</li></ul>-->
            <ul class="lista_botones"><li id="html" class="control_pesos">Ver Html</li></ul>  
	</div> 
        <div style = "float: left; width: 100%;height: 600px;border:1px solid #000;">
            <!--div style = "float: left; height:50px; width: 99%;border:1px solid #000;">
                <table border='1' style='width:100%;'>
                    <tr align='center' style="height:50px;">
                        <td style='width:7%;'><div>FECHA<br>REQ.</div></td>
                        <td style='width:3%;'><div>SERIE<br>REQ.</div></td>                
                        <td style='width:7%;'><div>NUMERO<br>REQ.</div></td>
                        <td style='width:9%;'><div>TIPO</div></td>
                        <td style='width:34%;'><div>DESCRIPCION</div></td>
                        <td style='width:8%;'><div>CANTIDAD</div></td>
                        <td style='width:5%;'><div>UNIDAD</div></td>
                        <td style='width:9%;'><div>PESO</div></td>
                        <td style='width:9%;'><div>O.C.</div></td>
                        <td style='width:9%;'><div>ATENCION</div></td>
                    </tr>
                </table>
            </div-->
            
            <div style = "float: left; height: 100%;width:100%;overflow: auto;border:1px solid #000;">
                <table heigth="50%" border="1" id="tabla_cabecera">
                
                    <tr align="center" style="height:50px;font:12px; font:arial;color:#fff;background:#8AA8F3;">
                        <td style="width:3%;"><div>FECHA</div></td>
                        <td style='width:7%;'><div>COD. ALM.</div></td>
                        <td style='width:7%;'><div>COD. MAT.</div></td>
                        <td style="width:3%;">CODPRO.</div></td>
                        <td style="width:25%;">PRODUCTO</div></td>
                        <td style="width:3%;">TIP. MOV.</div></td>
                        <td style='width:9%;'><div>DOC. REF.</div></td>
                        <td style='width:9%;'><div>NUM. REF.</div></td>
                       
                   <!--     <td style='width:5%;'><div>MO</div></td>
                        <td style='width:9%;'><div>TC.</div></td>-->
                        <td style='width:8%;'><div>PREC.</div></td>
                        <td style='width:8%;'><div>CANT O/C.</div></td>
                        <td style='width:8%;'><div>CANT.</div></td>
                        <td style='width:8%;'><div>PREC.TOTAL.</div></td>
                    <!--    <td style='width:8%;'><div>DOC. REF.</div></td>-->
                        <td style='width:8%;'><div>REQUIS.</div></td>
                        <td style='width:8%;'><div>NUMERO</div></td>
                        <td style='width:8%;'><div>O/C</div></td>
                      <!--  <td style='width:9%;'><div>FEC. FACT.</div></td>-->
                       
                        <td style="width:7%;"><div>OT</div></td>
                  
                    </tr>
                    <?php echo $fila;?>
                    <?php
                    if($fila==''){
                        ?>
                        <tr><td colspan="29" align="center">::: NO EXISTEN REGISTROS :::</td></tr>    
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>	
    </div>
</body>
</html>





