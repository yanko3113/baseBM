<?php
	// print_r($options); die();
	echo $this->Form->create($options['model'], array(
		'type' => 'file',
		'inputDefaults' => array(
			'class' => 'form-control',
			'div' => false,
		)
	)); 
	if(!empty($this->data[$options['model']]['id'])) {
		echo $this->Form->input('id', array('type'=>'hidden'));
	}
	$hasid = false;
?>
<div class="card">
	<?php if(!empty($options['title'])): ?>
		<div class="card-header d-flex">
			<div class="flex">
				<h4 class="card-title"><?php echo $options['title']; ?></h4>
			</div>
		</div>
	<?php endif; ?>
	<div class="card-body">
		<div class="row">
			<div class="col-3" style="<?php echo count($options['groups'])<=1 ? 'display: none': ''; ?>">
				<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
				<?php 
					foreach($options['groups'] as $i => $group): 
						if(empty($group['title'])) continue;
				?>
						<a class="nav-link <?php echo $i==0 ? 'active' : ''; ?>" id="v-pills-<?php echo $i; ?>-tab" data-toggle="pill" href="#v-pills-<?php echo $i; ?>" role="tab" aria-controls="v-pills-<?php echo $i; ?>" aria-selected="<?php echo $i==0 ? 'true' : 'false'; ?>"><?php echo __($group['title']); ?></a>
				<?php
					endforeach; 
				?>
				</div>
			</div>
			<div class="<?php echo count($options['groups'])<=1 ? 'col-12': 'col-9'; ?>">
				<div class="tab-content">
				<?php
					foreach($options['groups'] as $i => $group): 
				?>
					<div class="tab-pane fade <?php echo $i==0 ? 'show active' : ''; ?>" id="v-pills-<?php echo $i; ?>" role="tabpanel" aria-labelledby="v-pills-<?php echo $i; ?>-tab">
						<div class="row">
				<?php 
					foreach($group['items'] as $item => $data): 
						if(is_array($data)) {
							if(!empty($data['only_su']) && !$this->Nav->isSu())
								continue; 
							if(!empty($data['restrict_me'])) {
								if($this->action == 'me')
									continue;
							}
							$opt = $data;
							$label = $item;
							if(!empty($opt['type']) && $opt['type'] == 'checkbox') {
								$opt['label'] = array(
									'class' => 'custom-control-label',
								);
								$opt['class'] = 'custom-control-input';
								$opt += array('before'=>'<div class="col-md-'.(!empty($opt['cols']) ? $opt['cols'] : 12).' mt-2"><div class="form-group"><div class="custom-control custom-checkbox">','after'=>'</div></div></div>','error'=>false);
							}
							if(!empty($opt['type']) && $opt['type'] == 'datepicker') {
								$opt['type'] = 'text';
								$opt['class'] = !empty($opt['class']) ? $opt['class']." form-control datepicker" : "form-control datepicker";
								$opt += array('before'=>'<div class="col-md-'.$cols.' mt-2">','after'=>'</div>','error'=>false);
							}
						} else {
							$opt = array('label'=>array('class' => 'control-label'));
							$label = $data;
						}
						$cols = !empty($opt['cols']) ? $opt['cols'] : 6;
						if(!empty($opt['cols'])) unset($opt['cols']);
						if(!empty($opt['html'])) {
							$before = '<div class="col-md-'.$cols.' mt-2">';
							$after = '</div>';
						} else {
							$opt += array('before'=>'<div class="col-md-'.$cols.' mt-2">','after'=>'</div>','error'=>false);
						}
						if(!empty($opt['img_default'])) {
							$html = '<br /><img src="'.$opt['img_default'].'" style="padding: 5px;border: 2px #a5a5a5 dashed;max-width: 50%;">';
							if(!empty($opt['img_delete_url']))
								$html .= '<div class="clear mt-2"></div><a class="btn btn-danger" href="'.$opt['img_delete_url'].'"><i class="ion-trash-b"></i>  '.__('Eliminar').'</a>';
								$opt+= array('between'=>$html);
							}
							if(!empty($opt['default'])) {
								$opt+= array('between'=>'<br /><span>'.$opt['default'].'</span>');
							}
							if($label=='id') $hasid = true;
							if(!empty($opt['type']) && $opt['type'] == 'upload') {
								$opt['label'] = !empty($opt['label']) ? $opt['label'] : 'Subir Archivo';
								$before = '<div class="col-md-'.$cols.' mt-2">';
								$before .= '<label for="'.$options['model'].'_'.$item.'">'.$opt['label'].'</label>';
								$before .= $this->Form->input($label, array('id'=>'file_'.$options['model'].'_'.$item,'type'=>'hidden'));
								$after = '</div>';
								$opt['html'] = '<div class="dropzone" id="'.$options['model'].'_'.$item.'"></div>';
						?>
						<script type="text/javascript">
							var fileDz_<?php echo $options['model'].'_'.$item; ?>;
							window.addEventListener('load',function() {
							   var dropzoneOptions<?php echo $options['model'].'_'.$item; ?> = {
							        paramName: "file",
							        maxFilesize: 20, // MB
							        addRemoveLinks: true,
							        dictDefaultMessage: 'Arrastre los archivos aqui',
							        acceptedFiles: "image/jpg,image/jpeg,image/png",
							        dictRemoveFile: "Eliminar",
							        url: "<?php echo $this->Html->url($opt['url']); ?>",
							        init: function () {
							            this.on("maxfilesexceeded", function (file) {
							                this.removeFile(file);
							            });
							            this.on("success", function(file, response) {
							            	var data = JSON.parse(response);
							            	if(data.status=='ok') {
							            		$("#file_<?php echo $options['model'].'_'.$item; ?>").val(data.file);
							            	} else {
							            		this.removeFile(file);
							            	}
							            });
							        },

							    };
							    fileDz_<?php echo $options['model'].'_'.$item; ?> = new Dropzone("#<?php echo $options['model'].'_'.$item; ?>", dropzoneOptions<?php echo $options['model'].'_'.$item; ?>);
							    <?php if(!empty($this->data[$options['model']][$label])): ?>
							    	fileDz_<?php echo $options['model'].'_'.$item; ?>.displayExistingFile({ name: '<?php echo $this->data[$options['model']][$label]; ?>', size: 0},'<?php echo $this->webroot.'upload/'.$this->data[$options['model']][$label]; ?>',null,null,true);
							    	fileDz_<?php echo $options['model'].'_'.$item; ?>.options.maxFiles = fileDz_<?php echo $options['model'].'_'.$item; ?>.options.maxFiles - 1;
							    <?php endif; ?>
							});
						</script>
						<?php
							}
							if(!empty($opt['type']) && $opt['type'] == 'multi_upload') {
								$opt['label'] = !empty($opt['label']) ? $opt['label'] : 'Subir Archivo';
								$before = '<div class="col-md-'.$cols.' mt-2">';
								$before .= '<label for="'.$options['model'].'_'.$item.'">'.$opt['label'].'</label><div tag="'.$options['model'].'_'.$item.'"></div>';
								$after = '</div>';
								$opt['html'] = '<div class="dz" id="'.$options['model'].'_'.$item.'"><h1>Arrastre Aqui sus archivos</h1></div>';
						?>
						<script type="text/javascript">
							var multiFileDz_<?php echo $options['model'].'_'.$item; ?>;
							window.addEventListener('load',function() {
								let excludeFile = false;

								var dropzoneOptions<?php echo $options['model'].'_'.$item; ?> = {
									previewTemplate: document.querySelector('#template-container').innerHTML,
									paramName: "file",
									maxFilesize: 100, // MB
									addRemoveLinks: true,
									dictDefaultMessage: 'Arrastre los archivos aqui',
									acceptedFiles: "image/jpg,image/jpeg,image/png",
									url: "<?php echo $this->Html->url(array('controller'=>'admins','action'=>'multi_file_upload',$opt['model'])); ?>",
									addRemoveLinks: true,
									uploadMultiple: true,
									<?php echo !empty($opt['max_files']) ? "maxFiles: {$opt['max_files']}, " : null; ?>
									dictDefaultMessage: "<strong>Drop files here or click to upload. </strong>",
									init: function () {
										this.on("maxfilesexceeded", function (file) {
											this.removeFile(file);
										});
										this.on("success", function(file, response) {
											var data = JSON.parse(response);
											if(data.status=='ok') {
												// $("#file_").val(data.file);
											} else {
												this.removeFile(file);
											}
										});
										this.on("complete", function(file) {
											$(".dz-remove").html("<div><span class='fa fa-trash text-danger' style='font-size: 1.5em'></span></div>");
										});
										this.on("removedfile", function(file) {
											$.ajax({
												url: '<?php echo $this->Html->url(array('controller'=>'admins','action'=>'multi_upload_delete', $opt['model'])); ?>',
												type: 'GET',
												dataType: 'json',
												data: {uuid: file.upload.uuid},
											}).done(function(data) {
												$("input.upload-"+file.upload.uuid).remove();
												console.log("success");
											});
										});
										this.on('addedfile', function(file) {
								          // if(!excludeFile) {

								          	console.log(file);
								          	if(typeof file.upload.id != 'undefined') {
								          		$(".dz#<?=$options['model'].'_'.$item?>").append('<input class="upload-'+file.upload.uuid+'" type="hidden" name="data[<?=$opt['model']?>]['+file.upload.uuid+'][id]" value="'+file.upload.id+'" />');
								          	}
								          	if(typeof file.upload.order != 'undefined') {
								          		$(".dz#<?=$options['model'].'_'.$item?>").append('<input class="order upload-'+file.upload.uuid+'" type="hidden" name="data[<?=$opt['model']?>]['+file.upload.uuid+'][order]" value="'+file.upload.order+'" />');
								          	} else {
								          		var index = $(".dz#<?=$options['model'].'_'.$item?>").find('.dz-preview').length;
								            	$(".dz#<?=$options['model'].'_'.$item?>").append('<input class="order upload-'+file.upload.uuid+'" type="hidden" name="data[<?=$opt['model']?>]['+file.upload.uuid+'][order]" value="'+index+'" />');

								          	}
								          	$(".dz#<?=$options['model'].'_'.$item?>").find('.dz-preview:last .dz-link').attr('dz-uuid', file.upload.uuid);
								            $(".dz#<?=$options['model'].'_'.$item?>").append('<input class="upload-'+file.upload.uuid+'" type="hidden" name="data[<?=$opt['model']?>]['+file.upload.uuid+'][name]" value="'+file.name+'" />');
								            $(".dz#<?=$options['model'].'_'.$item?>").append('<input class="upload-'+file.upload.uuid+'" type="hidden" name="data[<?=$opt['model']?>]['+file.upload.uuid+'][uuid]" value="'+file.upload.uuid+'" />');
								          // }

								          	<?php echo $options['model'].'_'.$item; ?>_rebindLink();
										});
									},
								};
							    multiFileDz_<?php echo $options['model'].'_'.$item; ?> = new Dropzone("#<?php echo $options['model'].'_'.$item; ?>", dropzoneOptions<?php echo $options['model'].'_'.$item; ?>);
							    excludeFile = true;
							    <?php 
							    	if(!empty($this->data[$opt['model']])): 
							    		foreach($this->data[$opt['model']] as $i => $file):
							    ?>
							    multiFileDz_<?php echo $options['model'].'_'.$item; ?>.displayExistingFile({ upload: { id: '<?php echo $file['id']; ?>', order: <?php echo !empty($file['order']) ? $file['order'] : $i; ?>, uuid:'<?php echo $file['uuid']; ?>' }, name: '<?php echo $file['name']; ?>', size: 0},'<?php echo $this->webroot."img/upload/{$opt['model']}/".$file['name']; ?>',null,null,true);
							    <?php if(!empty($opt['max_files'])): ?>
								multiFileDz_<?php echo $options['model'].'_'.$item; ?>.options.maxFiles = multiFileDz_<?php echo $options['model'].'_'.$item; ?>.options.maxFiles - 1;
							    <?php endif; ?>
							    <?php 
							    		endforeach;
									endif; 
								?>
								excludeFile = false;
							});

							function <?php echo $options['model'].'_'.$item; ?>_rebindLink() {
								$(".dz-link").unbind().click(function() {
									var uuid = $(this).attr('dz-uuid');
									var order = $('input.upload-'+uuid+'.order').val() || "";
									var input = prompt("Ingrese un Orden", order);
									if(!input || input == "")
										return;
									$(this).attr('dz-order', input);
									$('input.upload-'+uuid+'.order').val(input);
								});
							}
						</script>
						<?php
							}
						if(!empty($opt['type']) && $opt['type'] == 'textarea') {
							$opt['id'] = $options['model'].'_'.$item;
						?>
						<script type="text/javascript">
							window.addEventListener('load', function() {
								$("#<?php echo $options['model'].'_'.$item; ?>").froalaEditor({
									enter: $.FroalaEditor.ENTER_P,
									placeholderText: null,
									language: 'es',
									height: <?php echo !empty($opt['height']) ? $opt['height'] : 300; ?>,
									// initOnClick: true,
									toolbarButtons: [ 'bold', 'italic', 'underline','|','fontSize','getPDF','|','align', '|', 'insertImage', 'insertLink', 'insertFile', 'quote', 'insertTable', 'insertVideo', 'html' ],
									videoInsertButtons: ['videoByURL'],
									videoAllowedProviders: ['youtube', 'vimeo'],
							        // Set the file upload parameter.
							        fileUploadParam: 'file',
						 
							        // Set the file upload URL.
							        fileUploadURL: '<?php echo $this->Html->url(array('controller'=>'admins','action'=>'upload_attachment')); ?>',
						 
							        // Additional upload params.
							        fileUploadParams: {id: 'my_editor'},
						 
							        // Set request type.
							        fileUploadMethod: 'POST',
						 
							        // Set max file size to 20MB.
							        fileMaxSize: 20 * 1024 * 1024,
						 
							        // Allow to upload any file.
							        fileAllowedTypes: ['*'],
									
									imageUploadURL: '<?php echo $this->Html->url(array('controller'=>'admins','action'=>'upload_attachment')); ?>',
							        imageUploadParams: {
							          id: 'file'
							        }
								})
						        .on('froalaEditor.file.error', function (e, editor, error, response) {
						          // Bad link.
						          if (error.code == 1) {  }
						 
						          // No link in upload response.
						          else if (error.code == 2) {  }
						 
						          // Error during file upload.
						          else if (error.code == 3) {  }
						 
						          // Parsing response failed.
						          else if (error.code == 4) {  }
						 
						          // File too text-large.
						          else if (error.code == 5) {  }
						 
						          // Invalid file type.
						          else if (error.code == 6) {  }
						 
						          // File can be uploaded only to same domain in IE 8 and IE 9.
						          else if (error.code == 7) {  }
						 
						          // Response contains the original server response to the request if available.
						        });
							});
						</script>
						<?php
						}
						if(!empty($opt['type']) && $opt['type'] == 'simple_textarea') {
							$opt['type'] = 'textarea';
						}
						if(!empty($opt['type']) && $opt['type'] == 'tokenfield') {
							$opt['type'] = 'text';
							$opt['class'] = 'form-control tokenfield';
						?>

						<?
						}
						echo !empty($opt['html']) ? $before.$opt['html'].$after : $this->Form->input($label, $opt);
					endforeach; 
				?>
			</div>
		</div>
	<?php endforeach; ?>
	</div>
</div>
</div>
<hr />
<?php echo !$hasid ? $this->Form->input('id') : ''; ?>
<?php echo $this->Form->end(array('div'=>array('class'=>'text-center'),'label'=>!empty($options['end']) ? __($options['end']) : __('Guardar Cambios'),'class'=>'btn btn-primary waves-primary')); ?>
<script type="text/javascript">
	window.addEventListener('load',function() {
		$("input.tokenfield").tokenfield({
			delimiter: [',',' ',';']
		});
	});
</script>
</div>
</div>

<section id="template-container" style="display: none;">
	<div class="dz-preview dz-file-preview">
	  <div class="dz-details">
	    <img data-dz-thumbnail />
	    <div class="dz-filename"><span data-dz-name></span></div>
	    <div class="dz-size" data-dz-size></div>
	  </div>
	  <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
	  <div class="dz-success-mark"><span>OK</span></div>
	  <div class="dz-error-mark"><span>ERROR</span></div>
	  <div class="dz-error-message"><span data-dz-errormessage></span></div>
	  <a class="dz-link" href="javascript:undefined;">
	  	<div>
	  		<span class="fa fa-sort" style="font-size: 1.5em" aria-hidden="true"></span>
	  	</div>
	  </a>

	</div>
</section>
