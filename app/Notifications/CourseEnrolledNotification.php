<?php

namespace App\Notifications;

use App\Models\Course;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CourseEnrolledNotification extends Notification
{
    use Queueable;

    public $course;
    public $student;    

    public function __construct(Course $course, User $student)
    {
        $this->course  = $course;
        $this->student = $student;
    }

    
    public function via($notifiable): array
    {
        if ($notifiable instanceof Teacher) {
            return ['database', 'mail'];
        }

        return ['database'];
    }

   
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('📚 New Course Enrollment')
            ->greeting('Hello '.$notifiable->name)
            ->line($this->student->name.' has enrolled in your course.')
            ->line('Course: '.$this->course->title)
            ->action('View Dashboard', url('/teacher/dashboard'))
            ->line('Thank you.');
    }

   
    public function toArray($notifiable): array
    {
        return [
            'title'      => 'New Course Enrollment',
            'message'    => $this->student->name.' enrolled in '.$this->course->title,
            'course_id'  => $this->course->id,
            'student_id' => $this->student->id,
        ];
    }
}
