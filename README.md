$this->load->library('formhandler');
		$arr = array(
			'form_post_to'				=>	'#',
			'post_by_ajax'				=>	true,
			'add_css_file'				=>	base_url().'assets/css/formStyle.css',
			'add_js_file'				=>	base_url().'assets/js/formScript.js',
			'client_side_validation'	=>	true,
			'ajax_submit_response'		=>	'function_get_response',
			'form_attributes'			=>	array(
				'name'				=>	'putFile',
				'id'				=>	'putFile',
				'class'				=>	'putFile',
				'enctype'			=>	'multipart/form-data'
			),
			'fields'					=>	array(	
					array(
						'name'          		=> 'newsletter',
						'id'            		=> 'newsletter',
						'value'         		=> 'accept',
						'class'       			=> 'form-control',
						'type'         			=> 'text',
						'fieldCategory'			=> 'input',
						'level'					=> 'Name1',
						'required'				=> 'required',
						'minlength'				=>	5,
						'equalTo'				=>	'newsletter6',
						'validation_message'	=>	'Please enter the field value',
						'minlength_message'		=>	'enter letter 5 atleast',
						'equalTo_message'		=>	'enter same as newsletter6',
						'field_wrapper_start'	=>	'<div class="form-group">',
						'field_wrapper_end'		=>	'</div>'
					),
					array(
						'name'          		=> 'newsletter2',
						'id'            		=> 'newsletter2',
						'value'         		=> 'accept2',
						'class'       			=> 'form-control',
						'type'         			=> 'radio',
						'fieldCategory'			=> 'input',
						'level'					=> 'Name2',
						'required'				=> 'required',
						'validation_message'	=>	'Please enter the field value',
						'field_wrapper_start'	=>	'<div class="form-group form-check">',
						'field_wrapper_end'		=>	'</div>'
					),
					array(
						'name'          		=> 'newsletter4',
						'id'            		=> 'newsletter4',
						'value'         		=> 1,
						'class'       			=> 'form-control',
						'type'         			=> 'dropdown',
						'fieldCategory'			=> 'dropdown',
						'level'					=> 'Name4',
						'options'				=>	array(0=>1,1=>2,2=>3),
						'required'				=> 'required',
						'validation_message'	=>	'Please enter the field value',
						'field_wrapper_start'	=>	'<div class="form-group">',
						'field_wrapper_end'		=>	'</div>'
					),
					array(
						'name'          		=> 'newsletter3',
						'id'            		=> 'newsletter3',
						'value'         		=> 'accept3',
						'class'       			=> 'form-control',
						'type'         			=> 'checkbox',
						'fieldCategory'			=> 'input',
						'level'					=> 'Name3',
						'required'				=> 'required',
						'validation_message'	=>	'Please enter the field value',
						'field_wrapper_start'	=>	'<div class="form-group form-check">',
						'field_wrapper_end'		=>	'</div>'
					),
					array(
						'name'          		=> 'newsletter4',
						'id'            		=> 'newsletter4',
						'value'         		=> 'accept4',
						'class'       			=> 'form-control',
						'type'         			=> 'file',
						'fieldCategory'			=> 'upload',
						'level'					=> 'File',
						'required'				=> 'required',
						'validation_message'	=>	'Please enter the field value',
						'field_wrapper_start'	=>	'<div class="form-group">',
						'field_wrapper_end'		=>	'</div>'
					),
					array(
						'name'          		=> 'newsletter5',
						'id'            		=> 'newsletter5',
						'value'         		=> 'accept5',
						'class'       			=> 'form-control',
						'type'         			=> 'textarea',
						'fieldCategory'			=> 'textarea',
						'level'					=> 'Texts',
						'required'				=> 'required',
						'validation_message'	=>	'Please enter the field value',
						'field_wrapper_start'	=>	'<div class="form-group">',
						'field_wrapper_end'		=>	'</div>'
					),
					array(
						'name'          		=> 'newsletter6',
						'id'            		=> 'newsletter6',
						'value'         		=> 'accept6',
						'class'       			=> 'form-control',
						'type'         			=> 'email',
						'fieldCategory'			=> 'input',
						'level'					=> 'Texts',
						'required'				=> 'required',
						'validation_message'	=>	'Please enter the field value',
						'field_wrapper_start'	=>	'<div class="form-group">',
						'field_wrapper_end'		=>	'</div>'
					)
		  	),
		  	'button'					=>	array(
				array(
					'type'					=>	'submit',
					'name'					=>	'save',
					'id'					=>	'save',
					'class'					=>	'btn btn-primary',
					'value'					=>	'Save',
					'field_wrapper_start'	=>	'',
					'field_wrapper_end'		=>	''
				),
				array(
					'type'					=>	'button',
					'name'					=>	'reset',
					'id'					=>	'reset',
					'class'					=>	'btn btn-primary',
					'value'					=>	'Reset',
					'field_wrapper_start'	=>	'',
					'field_wrapper_end'		=>	''
				)
		  	),
		  	'captcha'					=> true,
		  	're_captcha'				=> true,
		  	're_captcha_sitekey'		=> '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI',
		  	'form_wrapper_start'		=>	'<div class=""><div class="">',
		  	'form_wrapper_end'			=>	'</div></div>',
			'field_wrapper_start'		=>	'<div class="form-group">',
			'field_wrapper_end'			=>	'</div>'
		);
		echo $this->formhandler->renderForm($arr);