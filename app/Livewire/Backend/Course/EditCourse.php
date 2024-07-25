<?php

namespace App\Livewire\Backend\Course;

use App\Livewire\Forms\Backend\Course\UpdateCourseForm;
use App\Services\Course\CourseService;
use App\Services\User\UserService;
use App\Traits\{LivewireMessageEvents, CloseModalTrait};
use Livewire\Attributes\On;
use Livewire\Component;

class EditCourse extends Component
{
    /**
     * This class uses the traits LivewireMessageEvents and CloseModalTrait.
     */
    use LivewireMessageEvents, CloseModalTrait;

    /**
     * The UpdateForm instance associated with this object.
     * @var UpdateCourseForm
     */
    public UpdateCourseForm $form;

    /**
     * The properties and groups associated with this object.
     */
    public $lecturers;

    /**
     * Initialize component state.
     */
    public function mount(CourseService $courseService, UserService $userService)
    {
        // Fetch all properties ordered by creation date
        $this->lecturers = $userService->getUsers('dosen');
    }

    /**
     * The properties of a courses object.
     */
    #[On('deliverCourseToEditComponent')]
    public function receiveAndProcessCourse(CourseService $courseService, $courseId)
    {
        $this->courseId = base64_decode($courseId);
        if (!$this->courseId) {
            throw new \InvalidArgumentException("Invalid ID provided.");
        }

        $course = $courseService->getCourseById($this->courseId);
        if ($course) {
            $this->form->setCourse($course);
        }
        $this->dispatch('show-modal');
    }

    public function render()
    {
        return view('livewire.backend.course.edit-course');
    }

    /**
     * Update a course course.
     * @param CourseService $courseService
     * @return void
     */
    public function updateCourse(CourseService $courseService)
    {
        $course = $this->form->storeOrUpdate($courseService);
        // Check if $course contains valid data or not.
        if ($course) {
            // Let other components know that a course was updated
            $this->dispatch('courseUpdated', $course);

            // Notify the frontend of success
            $this->dispatch('show-toast', ['type' => 'success', 'message' => 'Jadwal Mata Kuliah berhasil di perbaharui!']);
            // Let other components know that a setting was updated
            $this->dispatch('courseUpdated', $course);
        } else {
            // Notify the frontend of failure
            $this->dispatchErrorEvent('Gagal Mengubah Jadwal Mata Kuliah');
        }
        // Close the modal
        $this->closeModal();
    }

    public function resetFields()
    {
        $this->form->name = '';
        $this->form->courseId = '';
        $this->form->lecturerId = '';
    }
}
