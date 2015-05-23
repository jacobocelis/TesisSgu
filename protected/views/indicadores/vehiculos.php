<?php
/* @var $this  */
/* @var $data  */
?>
<div class="view">
	<b><?php echo CHtml::encode($data->idgrupo0->idtipo0->tipo); ?>:</b>
	<?php echo '# '.$data->numeroUnidad.' '.$data->idmodelo0->idmarca0->marca.' '.$data->idmodelo0->modelo.' '.$data->anno; ?>
	<br />
</div>
<style>
.list-view div.view {
    background: none repeat scroll 0% 0% rgba(54, 255, 41, 0.19);
}
</style>