<?php echo $user_name;?>同学:

您好！
<?php 
	/* 教师一对一辅导申请 */
	if($type == 'teacher'): 
?>
感谢您预约七联就职教师1V1辅导课程，下面是您预约的具体信息，请确认。

===================================================
预约教师: <?php echo $title;?>

详情链接: <?php echo $entry_link?>

预约时间: <?php echo $this->DateFormat->makeDateFormat($starttime); ?> ~ <?php echo $this->DateFormat->makeDateFormat($endtime); ?> 

备注信息: <?php echo $note;?>

===================================================
<?php 
	/* 课程申请 */
	elseif($type == 'course'): 
?>
感谢您预约七联课程，下面是您预约课程的具体信息，请确认。

===================================================
课程名称: <?php echo $title;?>

课程链接: <?php echo $entry_link;?>

课程时间: 
<?php foreach($schedule as $s):?>
■<?php echo $this->DateFormat->makeDateFormat($s['Schedule']['datetime_from']).' ~ '.date("H:i", strtotime($s['Schedule']['datetime_to'])).' 【'.$s['Schedule']['name'].'】 '.PHP_EOL;?>
<?php endforeach;?>

备注信息: <?php echo $note;?>

===================================================
<?php 
	endif; 
?>