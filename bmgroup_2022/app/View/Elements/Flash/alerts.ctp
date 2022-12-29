<script type="text/javascript">
	window.addEventListener('load',function() {
		quantumAlert({
			title: "<?php echo $message; ?>",
			message: "",
			type: "<?php echo !empty($class) ? $class : 'done'; ?>",
			timeout: 10
		});
	});
</script>