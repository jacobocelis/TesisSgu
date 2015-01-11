<?php
/* @var $this  */
/* @var $data  */
?>
<div class="view">
	<b><?php echo CHtml::encode($data->idvehiculo0->idgrupo0->idtipo0->tipo); ?>:</b>
	<?php echo '# '.$data->idvehiculo0->numeroUnidad.' '.$data->idvehiculo0->idmodelo0->idmarca0->marca.' '.$data->idvehiculo0->idmodelo0->modelo.' '.$data->idvehiculo0->anno; ?>
	<br />
</div>
<style>
.list-view div.view {
    background: none repeat scroll 0% 0% rgba(54, 255, 41, 0.19);
}
</style>