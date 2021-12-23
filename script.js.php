<?php
if($param['client_side_validation'])
{
	echo '<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>';
	$fields = $param['fields'];
	$arrRule = array();
	foreach ($fields as $key => $value) {
		if(isset($value['required']) && !empty($value['required']))
		{
			$arrRule['rules'][$value['name']]['required'] = true; 
		}
		if(isset($value['minlength']) && !empty($value['minlength']))
		{
			$arrRule['rules'][$value['name']]['minlength'] = $value['minlength']; 
		}
		if(isset($value['type']) && $value['type'] == 'email')
		{
			$arrRule['rules'][$value['name']]['email'] = true; 
		}
		if(isset($value['equalTo']) && !empty($value['equalTo']))
		{
			$arrRule['rules'][$value['name']]['equalTo'] = '#'.$value['equalTo']; 
		}
		if(isset($value['validation_message']) && !empty($value['validation_message']))
		{
			$arrRule['messages'][$value['name']]['required'] = $value['validation_message']; 
		}
		if(isset($value['minlength_message']) && !empty($value['minlength_message']))
		{
			$arrRule['messages'][$value['name']]['minlength'] = $value['minlength_message']; 
		}
		if(isset($value['equalTo_message']) && !empty($value['equalTo_message']))
		{
			$arrRule['messages'][$value['name']]['equalTo'] = $value['equalTo_message']; 
		}
	}


?>
	<script type="text/javascript">
		$(document).ready(function() {
			var supportJson = JSON.parse('<?php echo json_encode($arrRule)?>');
			<?php if($param['post_by_ajax']){?>
				supportJson.submitHandler = function(form){
					var formData = $('#<?php echo $param['form_attributes']['id']?>').serialize();
					$.post('<?php echo $param['form_post_to']?>',formData,function(response){
						<?php echo $param['ajax_submit_response']?>(response);
					})
				}
		<?php }?>
			$("#<?php echo $param['form_attributes']['id']?>").validate(
					supportJson
				);
		});
	</script>
<?php }?>

<?php 
if($param['post_by_ajax'] && !$param['client_side_validation']){?>
<script type="text/javascript">
	$(document).ready(function() {
		$('#<?php echo $param['form_attributes']['id']?>').submit(function(e){
			e.preventDefault();
			var formData = $(this).serialize();
			$.post('<?php echo $param['form_post_to']?>',formData,function(response){
				console.log(response);
			})
		})
	});
</script>
<?php }?>