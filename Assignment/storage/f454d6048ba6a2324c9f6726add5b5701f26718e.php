<?php $__env->startSection('title', 'Fpoly - Homepage'); ?>
<?php $__env->startSection('content'); ?>
	<h2 id="demo"></h2>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
	<script>
		$('#demo').text('Nội dung bài học')
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\php2\lesson4-mvc\views/home/homepage.blade.php ENDPATH**/ ?>