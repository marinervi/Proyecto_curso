<div class="form-group">
<label for="ifoto">Incluya una foto</label>
<div class="drag-drop">
<?= $form->field($model, $nombre)->fileInput(); ?>
<span class="fa-stack fa-2x">
<i class="fa fa-cloud fa-stack-2x bottom pulsating"></i>
<i class="fa fa-circle fa-stack-1x top medium"></i>
<i class="fa fa-arrow-circle-up fa-stack-1x top"></i>
</span><span class="desc">Pulse aquí para añadir archivos</span></div></div>