<script type="text/javascript" src="complementos/js/similares3.js"></script>

<form id="enviar" name="enviar" method="post" />

<input type="hidden" id="eIdAuto" name="eIdAuto" value="<?php echo $eIdAuto ?>" />
<input type="hidden" id="vpagina" name="vpagina" value="1" />

<!--parametros volver-->

<input type="hidden" id="rCategoria" name="rCategoria" value="<?php echo isset($_REQUEST["eCategoria"])? $_REQUEST["eCategoria"]: '';?>" />
<input type="hidden" id="rMarca" name="rMarca" value="<?php echo isset($_REQUEST["eMarca"])? $_REQUEST["eMarca"]: '';?>" />
<input type="hidden" id="rModelo" name="rModelo" value="<?php echo isset($_REQUEST["eModelo"])? $_REQUEST["eModelo"]: '';?>" />
<input type="hidden" id="rAno" name="rAno" value="<?php echo isset($_REQUEST["eAno"])? $_REQUEST["eAno"]: '';?>" />
<input type="hidden" id="rPrecio" name="rPrecio" value="<?php echo isset($_REQUEST["ePrecio"])? $_REQUEST["ePrecio"]: '';?>" />
<input type="hidden" id="rCombustible" name="rCombustible" value="<?php echo isset($_REQUEST["eCombustible"])? $_REQUEST["eCombustible"]: '';?>" />
<input type="hidden" id="rTransmision" name="rTransmision" value="<?php echo isset($_REQUEST["eTransmision"])? $_REQUEST["eTransmision"]: '';?>" />
<input type="hidden" id="rSucursal" name="rSucursal" value="<?php echo isset($_REQUEST["eSucursal"])? $_REQUEST["eSucursal"]: '';?>" />

<!--fin parametros volver-->


</form>			

