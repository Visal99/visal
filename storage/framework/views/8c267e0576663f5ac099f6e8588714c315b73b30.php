
 <?php $__env->startSection('content'); ?>
 <tbody>
    <tr>
        <td style="font-size:0;padding:30px 30px 18px;" align="left">
            <div class="mj-content" style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:24px;line-height:22px;">Contact From Visitor!</div>
        </td>
    </tr>
    <tr>
        <td style="font-size:0;padding:0 30px 16px;" align="left">
            <div class="mj-content" style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:15px;line-height:22px;">Dear <b>sir!</b></div>
        </td>
    </tr>
   
    <tr>
        <td style="font-size:0;padding:0 30px 16px;" align="left">
            <div class="mj-content" style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:15px;line-height:22px;">
              <p>
                 From:<?php echo e($data['organization']); ?>

              </p>
              <p>
                Here is your information: 
                <ul>
                  <li>Name: <span style="border-bottom: solid 1px #b3bac1"><?php echo e($data['name']); ?> </span></li>
                  <li>Subject: <span style="border-bottom: solid 1px #b3bac1"><?php echo e($data['subject']); ?> </span></li>
                  <li>Position: <span style="border-bottom: solid 1px #b3bac1"><?php echo e($data['position']); ?> </span></li>
                  <li>E-mail: <span style="border-bottom: solid 1px #b3bac1"><?php echo e($data['email']); ?> </span></li>
                  <li>Phone: <span style="border-bottom: solid 1px #b3bac1"><?php echo e($data['phone']); ?> </span></li>
                  <li>Message: <?php echo e($data['message']); ?></li>
                  
                </ul>
              </p>
          </div>
        </td>
    </tr>
     <tr>
        <td style="font-size:0;padding:0 30px 16px;" align="left">
            <div class="mj-content" style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:15px;line-height:22px;">Best Regards, <br /> <b>MPWT Support Team</b></div>
        </td>
    </tr>
   
</tbody>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('emails.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>