<?php


class AttendanceController extends Attendance {
    public function setStudentAttendance($studentID, $courseID, $attended)
    {
        return parent::setStudentAttendance($studentID, $courseID, $attended); // TODO: Change the autogenerated stub
    }

    public function setLecturerAttendance($lecturerID, $courseID, $attended)
    {
        return parent::setLecturerAttendance($lecturerID, $courseID, $attended); // TODO: Change the autogenerated stub
    }

    public function deleteAttendanceForThisLecturer($id)
    {
        parent::deleteAttendanceForThisLecturer($id); // TODO: Change the autogenerated stub
    }

    public function deleteAttendanceForThisStudent($id)
    {
        parent::deleteAttendanceForThisStudent($id); // TODO: Change the autogenerated stub
    }


}