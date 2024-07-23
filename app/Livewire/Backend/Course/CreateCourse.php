<?php

namespace App\Livewire\Backend\Course;

use App\Livewire\Forms\Backend\Course\CreateCourseForm;
use App\Services\Course\CourseService;
use App\Services\User\UserService;
use App\Traits\{LivewireMessageEvents, CloseModalTrait};
use Livewire\Component;

class CreateCourse extends Component
{
    use LivewireMessageEvents, CloseModalTrait;

    public $lecturers;

    /**
     * The CreateCourseForm instance associated with this object.
     * @var CreateCourseForm
     */
    public CreateCourseForm $form;

    public function mount(UserService $userService)
    {
        $lectureId = auth()->user()->id;
        $roleAlias = auth()->user()->role->name_alias;
        if ($roleAlias == 'dosen') {
            $lecturer = $userService->getUserById($lectureId);
            $this->lecturers = collect([$lecturer]);
            $this->form->lecturerId = $lectureId;
        } else {
            $this->lecturers = $userService->getUsers('dosen');
        }
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function render()
    {
        return view('livewire.backend.course.create-course');
    }

    /**
     * Store a new course.
     * @param CourseService $courseService
     * @return void
     */
    public function storeNewCourse(CourseService $courseService)
    {
        $course = $this->form->storeOrUpdate($courseService);
        // Check if $course contains valid data or not.
        if ($course) {
            // Let other components know that a course was created

            // Notify the frontend of success
            $this->dispatch('show-toast', ['type' => 'success', 'message' => 'Mata Kuliah berhasil ditambahkan!']);
            // Let other components know that a setting was updated
            $this->dispatch('courseCreated', $course);
        } else {
            // Notify the frontend of failure
            $this->dispatchErrorEvent('Gagal Menambahkan Mata Kuliah');
        }
        // Close the modal
        $this->closeModal();
    }

    public function resetFields()
    {
        $this->form->name = '';
        $lectureId = auth()->user()->id;
        $roleAlias = auth()->user()->role->name_alias;
        if ($roleAlias == 'dosen') {
            $this->form->lecturerId = $lectureId;
        } else {
            $this->form->lecturerId = '';
        }
    }
}
