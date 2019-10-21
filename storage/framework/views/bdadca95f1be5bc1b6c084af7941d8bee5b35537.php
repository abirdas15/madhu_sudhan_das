<table class="table table-bordered">
        <thead>
            <tr>
                <th>Group Name</th>
                <th class="text-center">Group Type</th>
                <th class="text-center">Account Name</th>
                <th>Post Text</th>
                <th class="text-center">Time</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $bufferPosting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($row->groupInfo['name']); ?></td>
                <td class="text-center"><?php echo e($row->groupInfo['type']); ?></td>
                <td class="text-center"><img width="50px" style="border-radius: 50%;" src="<?php echo e(asset($row->accountInfo['avatar'])); ?>"></td>
                <td><?php echo e($row->post_text); ?></td>
                <td><?php echo e(date("d M, Y H:i a", strtotime($row->sent_at))); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <div>
            <?php echo e($bufferPosting->links()); ?>

        </div>