
<?php 
	/* 教师一对一辅导申请 */
	if($type == 'teacher'): 
?>

学生老师一对一辅导预约通知:
===================================================
学生姓名: <?php echo $user_name;?>

预约教师: <?php echo $title;?>

详情链接: <?php echo $entry_link?>

预约时间: <?php echo $this->DateFormat->makeDateFormat($starttime); ?> ~ <?php echo $this->DateFormat->makeDateFormat($endtime); ?> 

备注信息: <?php echo $note;?>

===================================================


<?php 
	/* 课程申请 */
	elseif($type == 'course'): 
?>
学生课程预约通知:
===================================================
学生姓名: <?php echo $user_name;?>

课程名称: <?php echo $title;?>

课程链接: <?php echo $entry_link?>

备注信息: <?php echo $note;?>

===================================================
<?php 
	endif; 
?>

