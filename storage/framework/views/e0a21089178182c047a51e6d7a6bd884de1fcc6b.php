<li class="nav-item dropdown no-arrow mx-1 clickpopups">
  <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">        
    <i class="fas fa-bell fa-fw"></i>         
    <span class="badge badge-danger badge-counter" id="total_notify_count"><?php echo e(isset($data_array)?count($data_array).'+':''); ?></span>
  </a>
</li>

<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in navfonts" aria-labelledby="alertsDropdown">
  <h6 class="dropdown-header">Notifications</h6>

  <?php if(isset($data_array) && !empty($data_array)): ?>
  <?php $__currentLoopData = $data_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <a class="dropdown-item d-flex align-items-center" href="javascript:void(0)" onclick="read_notification('<?php echo e($val->TABLE_NAME); ?>','<?php echo e($val->COLUMN_NAME); ?>','<?php echo e($val->DOC_ID); ?>','<?php echo e($key); ?>')" >
    <div class="mr-3">
      <div class="icon-circle bg-primary" id="notify_<?php echo e($key); ?>" >
        <i class="fas fa-file-alt text-white"></i>
      </div>
    </div>
    <div>
      <div class="small text-gray-500"><?php echo e(date('d-M-Y',strtotime($val->DOC_DATE))); ?></div>
      <span class="font-weight-bold">A new <?php echo e($val->FORM_NAME); ?> No: <?php echo e($val->DOC_NO); ?> <?php echo e($val->BRANCH !=''?'from '.$val->BRANCH:''); ?> is ready to view!</span>
    </div>
  </a>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php else: ?>
  <a class="dropdown-item d-flex align-items-center" href="javascript:void(0)" >
    <div class="mr-3">
      <div class="icon-circle bg-info">
        <i class="fas fa-file-alt text-white"></i>
      </div>
    </div>
    <div>
      <div class="small text-gray-500"><?php echo e(date('d-M-Y')); ?></div>
      <span class="font-weight-bold">No any new notification record!</span>
    </div>
  </a>
  <?php endif; ?>

</div>



<?php /**PATH C:\xampp\htdocs\PROJECTS\ECW_DEV\resources\views/partials/notification.blade.php ENDPATH**/ ?>