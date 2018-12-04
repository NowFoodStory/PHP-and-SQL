<?php
echo('hello');
?>



<script>
var a=10;
var b=20;
</script>

"##宣告最終結果
FinalData = {}

##取出學生資料、課程資料 放入資料結構
Select * form table_student;
然後json_encode
studentdata = [{""student_id"":1,""name"":""jack""},....]

Select * form table_class;
然後json_encode
Classdata = [{""class_id"":1,""name"":""English""},...]

##用學生ID撈出所有成績資料

foreach ( 陣列 as $value )

foreach (student as $studentID){
$student_id = student[student_id]
$student_name = student[student_name]

Select table_class.name,Score form table_score,table_class where student_id = $student_id;
然後json_encode
scoredata =  [{""name"":English,""Score"":60},...]

FinalData.append({$student_id:scoredata})
}



FinalData就是你要的
