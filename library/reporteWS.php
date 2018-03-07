<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jspdf.debug.js"></script>
<script type="text/javascript" src="../js/html2canvas.js"></script>
<script type="text/javascript">
	function imprimir() {
		html2canvas(document.getElementById('Todo'), {
        onrendered: function (canvas) {
        	var img = canvas.toDataURL("iamge/PNG");
	        var doc = new jsPDF();
	        doc.addImage(img, 'PNG', 1, 1);
	        doc.save('Prueba2.pdf');
        }
      });
	};
</script>
<head>
  <title>Pedido</title>
</head>
<body>
<div id="Todo" style="width: 57%">
<hr />
<div class="container">
  <table style="width: 100%">
    <tr>
      <td><img src="../assets/img/contadorvirtual-logo.PNG" style="width: 250px; height: 195px"><br>Aqui va a ir la imagen de la empresa</td>
      <td style="text-align: center;">
        <h3>Contador Virtual S.A. de C.V.</h3>
        <p>Avenida Hidalgo 18 y 19 #1899 Col. Residencias C.P. 83448</p>
        <p>San Luis R&iacute;o Colorado, Sonora, M&eacute;xico</p>
        <p><a href="http://www.tucontadorvirtual.com">www.tucontadorvirtual.com</a></p>
        <h4>Correo elecctr&oacute;nico:</h4>
        <p>ventas@tucontadorvirtual.com</p>
      </td>
      <td><h4>Recibo</h4><br><p>Fecha: 2018-03-03</p></td>
    </tr>
  </table>
</div>
<br>
<div class="container">          
  <table style="width: 100%">
    <thead>
      <tr>
        <th>Nombre del producto</th>
        <th>Cantidad de productos comprados</th>
        <th>Precio unitario</th>
        <th>Costo + IVA</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Facturación web</td>
        <td> 5 </td>
        <td>$5.00</td>
        <td>$5.80</td>
      </tr>
      <tr>
        <td>Nómina plus</td>
        <td> 2 </td>
        <td>$7,900.00</td>
        <td>$18,328.00</td>
      </tr>
      <tr>
        <td>Nómina pro</td>
        <td> 1 </td>
        <td>$5,500.00</td>
        <td>$6,380.00</td>
      </tr>
      <tr>
      	<td><br></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td>Total:</td>
        <td></td>
        <td>$24,713.80</td>
      </tr>
    </tbody>
  </table>
</div>
</div>
<a href="javascript:imprimir()">Descargar</a>
</body>