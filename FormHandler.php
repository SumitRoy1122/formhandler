<?php 
/*
Author : Sumit Roy
Name : Create Form & Handle
Description : Create Form or Fields And Handle Client Side Validations
*/

class FormHandler
{
	function __Construct()
	{
		$CI = &get_instance();
		if(!function_exists('form_open'))
		{
			//$CI = &get_instance();
			$CI->load->helper('form');
		}

		if(!function_exists('create_captcha'))
		{
			//$CI = &get_instance();
			$CI->load->helper('captcha');
		}

		if(!function_exists('base_url'))
		{
			//$CI = &get_instance();
			$CI->load->helper('url');
		}
		if(!class_exists('session'))
		{
			$CI->load->library('session');
		}
		
		
		if(!is_dir(getcwd().'/FormHandler/captcha/'.str_replace('.','',$_SERVER["REMOTE_ADDR"])))
		{
			mkdir(getcwd().'/FormHandler/captcha/'.str_replace('.','',$_SERVER["REMOTE_ADDR"]),0777);
		}
		$this->customCaptchaField();
	}

	function test()
	{
		echo 'this is test';
	}

	function inputField($param)
	{
		return form_input($param);
	}

	function dropdownField($param)
	{
		return form_dropdown($param['name'], $param['options'], $param['value'], $param['attributes']);
	}

	function submitField($param)
	{
		return form_submit($param['name'], $param['value'],$param['attributes']);
	}

	function buttonField($param)
	{
		return form_button($param,$param['value']);
	}

	function textAreaField($param)
	{
		return form_textarea($param['attributes'],$param['value']);
	}

	function fileUploadField($param)
	{
		return form_upload($param['attributes'],$param['value']);
	}
	function customCaptchaField()
	{
		$CI = &get_instance();
		$string1 = 	   "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZSumitriTA";
		$string2 = 	   "1234567890";
		$string =  	   $string1.$string2;
		$string =  	   str_shuffle($string);
		$random_text = substr($string,0,8); 
		$CI->session->set_userdata('captcha',$random_text);
		$im = imagecreate(150, 20); 
		imagecolorallocate($im, 255, 255, 255); // background white
		$text_color = imagecolorallocate($im, 0, 0, 0); // text color black
		imagestring($im, 3, 5, 5, $random_text, $text_color); // append string to image
		if(is_dir(getcwd().'/FormHandler/captcha/'.str_replace('.','',$_SERVER["REMOTE_ADDR"])))
		{
			imagepng($im,getcwd().'/FormHandler/captcha/'.str_replace('.','',$_SERVER["REMOTE_ADDR"]).'/captcha.png');
		}
		
		imagedestroy($im);
		//print_r($CI->session);
	}

	function renderForm($param)
	{
		$this->checkMinjsExist($param);
		$str = '';
		if(!empty($param['add_css_file']))
		{
			$str.='<link href="'.$param['add_css_file'].'" rel="stylesheet"/>';
		}
		$str.=$param['form_wrapper_start'];
		$str.= form_open($param['form_post_to'], $param['form_attributes']);
		if(!empty($param))
		{
			foreach($param['fields'] as $key => $paramDta)
			{
				if($paramDta['fieldCategory'] == 'input')
				{
					$data = array(
						'name'		=> $paramDta['name'],
						'id'		=> $paramDta['id'],
						'value'		=> $paramDta['value'],
						'class'		=> $paramDta['class'],
						'type'		=> $paramDta['type'],
						//'required'	=> $paramDta['required']
					);
					if(isset($paramDta['readonly']))
					{
						$data['readonly'] = $paramDta['readonly'];
					}

					if(isset($paramDta['disabled']))
					{
						$data['disabled'] = $paramDta['disabled'];
					}

					if(isset($paramDta['required']))
					{
						$data['required'] = $paramDta['required'];
					}

					if($paramDta['type'] != 'radio' || $paramDta['type'] != 'checkbox')
					{
						$str.= $paramDta['field_wrapper_start'];
						$str.= '<label for="input'.$paramDta['name'].'">'.$paramDta['level'].'</label>';
						$str.= $this->inputField($data);
						$str.= '<small id="'.$paramDta['name'].'help" class="form-text text-muted"></small>';
						$str.= $paramDta['field_wrapper_end'];
					}else{
						$str.= $paramDta['field_wrapper_start'];
						$str.= $this->inputField($data);
						$str.= '<label for="input'.$paramDta['name'].'">'.$paramDta['level'].'</label>';
						//echo '<small id="'.$paramDta['name'].'help" class="form-text text-muted"></small>';
						$str.= $paramDta['field_wrapper_end'];
					}
				}

				if($paramDta['fieldCategory'] == 'dropdown')
				{
					$data = array(
						'name'			=> $paramDta['name'],
						'attributes'	=>	array(
								'id'	=> $paramDta['id'],
								'class'	=> $paramDta['class']
							),
						'options'		=>	$paramDta['options'],
						'value'			=>	$paramDta['value'],
						//'required'		=> $paramDta['required']
					);
					if(isset($paramDta['disabled']))
					{
						$data['disabled'] = $paramDta['disabled'];
					}
					if(isset($paramDta['required']))
					{
						$data['required'] = $paramDta['required'];
					}
					$str.= $paramDta['field_wrapper_start'];
					$str.= '<label for="input'.$paramDta['name'].'">'.$paramDta['level'].'</label>';
					$str.= $this->dropdownField($data);
					$str.= '<small id="'.$paramDta['name'].'help" class="form-text text-muted"></small>';
					$str.= $paramDta['field_wrapper_end'];
				}

				if($paramDta['fieldCategory'] == 'textarea')
				{
					$data = array(
						'value'			=> $paramDta['value'],
						'attributes'	=>	array(
								'id'	=> $paramDta['id'],
								'class'	=> $paramDta['class'],
								'name'	=> $paramDta['name'],
								//'required'	=> $paramDta['required']
							)
					);
					if(isset($paramDta['disabled']))
					{
						$data['disabled'] = $paramDta['disabled'];
					}
					if(isset($paramDta['readonly']))
					{
						$data['readonly'] = $paramDta['readonly'];
					}
					if(isset($paramDta['required']))
					{
						$data['required'] = $paramDta['required'];
					}
					$str.= $paramDta['field_wrapper_start'];
					$str.= '<label for="input'.$paramDta['name'].'">'.$paramDta['level'].'</label>';
					$str.= $this->textAreaField($data);
					$str.= '<small id="'.$paramDta['name'].'help" class="form-text text-muted"></small>';
					$str.= $paramDta['field_wrapper_end'];
				}

				if($paramDta['fieldCategory'] == 'upload')
				{
					$data = array(
						'value'			=> $paramDta['value'],
						'attributes'	=>	array(
								'id'	=> $paramDta['id'],
								'class'	=> $paramDta['class'],
								'name'	=> $paramDta['name'],
								//'required'	=> $paramDta['required']
							)
					);
					if(isset($paramDta['required']))
					{
						$data['required'] = $paramDta['required'];
					}
					$str.= $paramDta['field_wrapper_start'];
					$str.= '<label for="input'.$paramDta['name'].'">'.$paramDta['level'].'</label>';
					$str.= $this->fileUploadField($data);
					$str.= '<small id="'.$paramDta['name'].'help" class="form-text text-muted"></small>';
					$str.= $paramDta['field_wrapper_end'];
				}
			}

			if($param['captcha'])
			{
				$data = array(
						'name'		=> 'captchaCode',
						'id'		=> 'captchaCode',
						'value'		=> '',
						'class'		=> 'form-control',
						'type'		=> 'text',
						'required'	=> $paramDta['required']
					);

					if(isset($paramDta['required']))
					{
						$data['required'] = $paramDta['required'];
					}

					$str.= $param['field_wrapper_start'];
					$str.= '<img src="'.base_url().'/FormHandler/captcha/'.str_replace('.','',$_SERVER["REMOTE_ADDR"]).'/captcha.png"/>';
					$str.= $param['field_wrapper_end'];
					$str.= $param['field_wrapper_start'];
					$str.= '<label for="inputCaptcha">Put Captcha Code</label>';
					$str.= $this->inputField($data);
					$str.= '<small id="captchahelp" class="form-text text-muted"></small>';
					$str.= $param['field_wrapper_end'];
			}

			if($param['re_captcha'])
			{
				$str.=	'<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
				$str.= $param['field_wrapper_start'];
				//$str.= '<label for="inputCaptcha">Are You Human</label>';
				$str.= '<div class="g-recaptcha" data-sitekey="'.$param['re_captcha_sitekey'].'"></div>';
				$str.= '<small id="captchahelp" class="form-text text-muted"></small>';
				$str.= $param['field_wrapper_end'];
			}

			if(isset($param['button']))
			{
				foreach($param['button'] as $buttonkey => $buttonVal)
				{
					if($buttonVal['type'] == 'submit')
					{
							$data = array(
							'name'			=> $buttonVal['name'],
							'value'			=> $buttonVal['value'],
							'attributes'	=>	array(
									'id'	=> $buttonVal['id'],
									'class'	=> $buttonVal['class']
								)
						);
						$str.= $buttonVal['field_wrapper_start'];
						$str.= $this->submitField($data);
						$str.= $buttonVal['field_wrapper_end'];
					}

					if($buttonVal['type'] == 'button')
					{
						$data = array(
							'name'		=> $buttonVal['name'],
							'id'		=> $buttonVal['id'],
							'class'		=> $buttonVal['class'],
							'value'		=> $buttonVal['value']
						);
						$str.= $buttonVal['field_wrapper_start'];
						$str.= $this->buttonField($data);
						$str.= $buttonVal['field_wrapper_end'];
					}
				}
			}
		}
		$str.= form_close();
		$str.=$param['form_wrapper_end'];
		if(!empty($param['add_js_file']))
		{
			$str.='<script src="'.$param['add_js_file'].'"></script>';
		}
		if($param['client_side_validation'] || $param['post_by_ajax'])
		{
			//$str.='<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>';
			include_once 'script.js.php';
			include_once 'style.css.php';
		}
		return $str;
	}

	

	function checkMinjsExist($param)
	{
		if($param['client_side_validation'] || $param['post_by_ajax'])
		{
			echo '<script>';
			echo 'if(!window.jQuery){';
				//echo 'var script = document.createElement("script");';
				//echo 'script.type = "text/javascript";';
				//echo 'script.src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js";';
				//echo 'document.getElementsByTagName("head")[0].appendChild(script);';
				echo 'alert("Load the js to enable validation or ajax submission")';
			echo '}';
			echo '</script>';
		}
	}


}