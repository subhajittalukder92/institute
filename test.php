<?php 
$value=5;
echo sprintf('%0' . 4 . 's', $value);
SELECT `date`,`receipt_no`,`course_id`,`student_id`,
SUM(CASE WHEN TRIM(`payment_type`) = 'Admission' THEN `payment_amt` ELSE 0 END) AS 'ADMISSION',
SUM(CASE WHEN TRIM(`payment_type`) = 'Installment' THEN `payment_amt` ELSE 0 END) AS 'INSTALLMENT',
SUM(CASE WHEN TRIM(`payment_type`) = 'Fine' THEN `payment_amt` ELSE 0 END) AS 'FINE',
SUM(CASE WHEN TRIM(`payment_type`) = 'Prospectus' THEN `payment_amt` ELSE 0 END) AS 'PROSPECTUS',
SUM(CASE WHEN TRIM(`payment_type`) = 'Exam Fees' THEN `payment_amt` ELSE 0 END) AS 'EXAM FEES'
FROM payment
GROUP BY `receipt_no`
?>