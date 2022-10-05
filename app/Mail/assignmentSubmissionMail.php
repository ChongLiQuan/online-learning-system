<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class assignmentSubmissionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $student_id, $assignment_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($student_id, $assignment_id)
    {
        $this->student_id = $student_id;
        $this->assignment_id = $assignment_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('assignmentSubmissionMail');
    }
}
