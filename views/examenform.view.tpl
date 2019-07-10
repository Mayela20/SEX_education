<h1>{{modeDsc}}</h1>
<section class="row">
<form action="index.php?page=examenform" method="post" class="col-8 col-offset-2">
  {{if hasErrors}}
    <section class="row">
      <ul class="error">
        {{foreach errores}}
          <li>{{this}}</li>
        {{endfor errores}}
      </ul>
    </section>
  {{endif hasErrors}}
  <input type="hidden" name="mode" value="{{mode}}"/>
  <input type="hidden" name="xcfrt" value="{{xcfrt}}" />
  <input type="hidden" name="btnConfirmar" value="Confirmar" />
  {{if showidjuguetes}}
  <fieldset class="row">
    <label class="col-5" for="idjuguetes">Código de Juguetes</label>
    <input type="text" name="idjuguetes" id="idjuguetes" readonly value="{{idjuguetes}}" class="col-7" />
  </fieldset>
  {{endif showidjuguetes}}
  <fieldset class="row">
    <label class="col-5" for="nombrejuguetes">nombre</label>
    <input type="text" name="nombrejuguetes" id="nombrejuguetes" {{readonly}} value="{{nombrejuguetes}}" class="col-7" />
  </fieldset>
  <fieldset class="row">
    <label class="col-5" for="precjuguete">Precio de Venta</label>
    <input type="text" name="precjuguete" id="precjuguete" {{readonly}} value="{{precio}}" class="col-7" />
  </fieldset>
  <fieldset class="row">
    <label class="col-5" for="estadojuguete">Estado</label>
    <select name="estadojuguete" id="estadojuguete" class="col-7" {{selectDisable}} {{readonly}} >
      {{foreach estadojuguetes}}
        <option value="{{cod}}" {{selected}}>{{dsc}}</option>
      {{endfor estadojuguetes}}
    </select>
  </fieldset>
  <fieldset class="row">
    <div class="right">
      {{if showBtnConfirmar}}
      <button type="button" id="btnConfirmar" >Confirmar</button>
      &nbsp;
      {{endif showBtnConfirmar}}
      <button type="button" id="btnCancelar">Cancelar</button>
    </div>
  </fieldset>
  <!--
   <td>{{idmoda}}</td>
    <td>{{dscmoda}}</td>
    <td>{{prcmoda}}</td>
    <td>{{ivamoda}}</td>
    <td>{{estmoda}}</td>
   -->
</form>
</section>
<script>
  $().ready(function(){
    $("#btnCancelar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      location.assign("index.php?page=examenlist");
    });
    $("#btnConfirmar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      /*Aqui deberia hacer validación de datos*/
      document.forms[0].submit();
    });
  });
</script>
