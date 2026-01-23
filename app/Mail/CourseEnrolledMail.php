<?php

namespace App\Mail;

use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CourseEnrolledMail extends Mailable
{
    use Queueable, SerializesModels;

    public $course;
    public $student;

    public function __construct($course, $student)
    {
        $this->course = $course;
        $this->student = $student;
    }

    public function build()
    {
        return $this->subject('🎉 Course Enrollment Successful')
                    ->view('emails.course-enrolled');
    }
}
