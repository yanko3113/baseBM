<script type="text/javascript">
	var dropZone = {};
	var getFiles = {
		c_nosotros_1: <?php echo $this->Js->object($c_nosotros_1); ?>,
		c_nosotros_2: <?php echo $this->Js->object($c_nosotros_2); ?>
	};
	function bindDZ(tag, limit) {
	   var dropzoneOptions = {
 	  	previewTemplate: document.querySelector('#template-container-nosotros_2').innerHTML,
      paramName: "file",
      maxFilesize: 100, // MB
      addRemoveLinks: true,
      dictDefaultMessage: 'Arrastre los archivos aqui',
     	acceptedFiles: "image/jpg,image/jpeg,image/png",
      url: "<?php echo $this->Html->url(array('controller'=>'admins','action'=>'upload_slider')); ?>",
      addRemoveLinks: true,
      uploadMultiple: true,
      maxFiles: limit,
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
        this.on("sendingmultiple", function(file, xhr, formData) { 
					$.each(file, function(i, row) {
 						formData.append("files["+i+"]", row.upload.uuid);
					});
 					formData.append("id", tag);
				});
 				this.on("complete", function(file) {
          $(".dz-remove").html("<div><span class='fa fa-trash text-danger' style='font-size: 1.5em'></span></div>");
        });
      	this.on("removedfile", function(file) {
      			removeMaterial(file.upload.uuid);
      	});
				this.on('addedfile', function(file) {
						console.log( $(file.previewElement).find(".dz-details img") );
				    var ext = file.name.split('.').pop();
				    if (ext == "pdf") {
				        $(file.previewElement).find(".dz-details img").attr("src", "<?php echo Router::url('/images'); ?>/extensions/file.png");
				    } else if (ext.indexOf("doc") != -1) {
				        $(file.previewElement).find(".dz-details img").attr("src", "<?php echo Router::url('/images'); ?>/extensions/file.png");
				    } else if (ext.indexOf("xls") != -1) {
				        $(file.previewElement).find(".dz-details img").attr("src", "<?php echo Router::url('/images'); ?>/extensions/file.png");
				    } else {
					    	$(file.previewElement).find(".dz-details img").attr("src", "<?php echo Router::url('/images'); ?>/extensions/file.png");
				    }
						$(".dz[tag="+tag+"] .dz-preview:last .dz-link").attr('dz-uuid', file.upload.uuid);
				    rebindLink();
				});
	    },
		};
	  dropZone[tag] = new Dropzone(".dz[tag="+tag+"]", dropzoneOptions);
	  if(typeof getFiles[tag][0] !== undefined) {
			$.each(getFiles[tag], function(i, slider) {
				var file = {
					name: slider.Slider.name,
					size: slider.Slider.size,
					type: slider.Slider.ext,
					upload: {
						uuid: slider.Slider.uuid
					},
    			status: Dropzone.ADDED,
    			accepted: true,
				};

				dropZone[tag].displayExistingFile(file,"<?php echo Router::url('/upload'); ?>/"+slider.Slider.file);
				dropZone[tag].options.maxFiles = dropZone[tag].options.maxFiles - 1;
				$(".dz[tag="+tag+"] .dz-preview:last .dz-link").attr('dz-uuid', slider.Slider.uuid);
				$(".dz[tag="+tag+"] .dz-preview:last .dz-link").attr('dz-link', slider.Slider.link);
      });

      rebindLink();
	  }
	}

	function removeMaterial(uuid) {
		$.ajax({
			url: '<?php echo $this->Html->url(array('controller'=>'admins','action'=>'delete_slider')); ?>',
			type: 'GET',
			dataType: 'json',
			data: {uuid: uuid},
		}).done(function(data) {
			console.log("success");
		});
		
	}

	window.addEventListener('load',function() {
		bindDZ('c_nosotros_1',5);
		bindDZ('c_nosotros_2',4);
	});

	function rebindLink() {
		$(".dz-link").unbind().click(function() {
			var link = $(this).attr('dz-link') || "";
			var input = prompt("Ingrese un link", link);
			if(!input || input == "")
				return;
			$(this).attr('dz-link', input);

			var uuid = $(this).attr('dz-uuid');
			$.ajax({
				url: '<?php echo $this->Html->url(array('controller'=>'admins','action'=>'edit_slider')); ?>',
				type: 'POST',
				dataType: 'json',
				data: {
					Slider: {
						uuid: uuid,
						link: input
					}
				},
			})
			.done(function() {
				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		});
	}
</script>	