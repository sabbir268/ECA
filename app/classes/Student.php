<?php
/**
 *
 */
class Students extends Objects {

	protected $pdo;

	// construct $pdo
	function __construct($pdo) {
		$this->pdo = $pdo;
	}

	public function total_student() {
		$stmt = $this->pdo->prepare("SELECT * FROM student");
		$stmt->execute();
		$stmt->fetchAll(PDO::FETCH_OBJ);
		$count = $stmt->rowCount();
		return $count;
	}

	public function studentByDepartment($value,$sem)
	{
		$stmt = $this->pdo->prepare("SELECT * FROM student WHERE dept = :value AND sem = :sem AND seated IS NULL ");
		$stmt->bindParam(":value", $value);
		$stmt->bindParam(":sem", $sem);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}


	public function totalSeletedStudent($dept,$sem,$value,$value2)
	{
		$stmt = $this->pdo->prepare("SELECT * FROM `student` WHERE `dept` = :dept AND `sem` = :sem AND id BETWEEN :value AND :value2 ORDER BY roll ASC");
		$stmt->bindParam(":dept", $dept);
		$stmt->bindParam(":sem", $sem);
		$stmt->bindParam(":value", $value);
		$stmt->bindParam(":value2", $value2);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}


	public function updateStudentSeat($dept,$sem,$r1,$r2,$seat)
	{
		$stmt = $this->pdo->prepare("UPDATE `student` SET `seated` = :seat WHERE `dept` = :dept AND `sem` = :sem AND id BETWEEN :r1 AND :r2");
		$stmt->bindParam(":dept", $dept);
		$stmt->bindParam(":sem", $sem);
		$stmt->bindParam(":r1", $r1);
		$stmt->bindParam(":r2", $r2);
		$stmt->bindParam(":seat", $seat);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
}

?>

