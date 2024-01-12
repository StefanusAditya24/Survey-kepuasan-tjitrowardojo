<?php

namespace App\Livewire\Landing;

use App\Repository\AgeRepository;
use App\Repository\EducationRepository;
use App\Repository\JobRepository;
use App\Repository\QuestionRepository;
use App\Repository\RespondentAnswerRepository;
use App\Repository\RespondentRepository;
use App\Repository\ServiceTypeRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    public Collection $ageDatas;
    public Collection $educationDatas;
    public Collection $jobDatas;
    public Collection $serviceTypeDatas;
    public Collection $questionDatas;

    public string $name = "";
    public string $phoneNumber = "";
    public string $gender = "";
    public string $ageId = "";
    public string $educationId = "";
    public string $job = "";
    public string $serviceTypeId = "";
    public $answers = [];

    public function __construct(
        protected AgeRepository $ageRepository = new AgeRepository(),
        protected EducationRepository $educationRepository = new EducationRepository(),
        protected JobRepository $jobRepository = new JobRepository(),
        protected ServiceTypeRepository $serviceTypeRepository = new ServiceTypeRepository(),
        protected QuestionRepository $questionRepository = new QuestionRepository(),
        protected RespondentRepository $respondentRepository = new RespondentRepository(),
        protected RespondentAnswerRepository $respondentAnswerRepository = new RespondentAnswerRepository(),
    ) {
    }

    public function mount(): void
    {
        $this->ageDatas = $this->ageRepository->getAges();
        $this->educationDatas = $this->educationRepository->getEducations();
        $this->jobDatas = $this->jobRepository->getJobs();
        $this->serviceTypeDatas = $this->serviceTypeRepository->getServiceTypes();
        $this->questionDatas = $this->questionRepository->getQuestions();
        foreach ($this->questionDatas as $question) {
            array_push($this->answers, [
                'id' => $question->id,
                'answer' => ''
            ]);
        }
    }

    public function save(): mixed
    {
        $respondentData = [
            'name' => $this->name,
            'phone_number' => $this->phoneNumber,
            'gender' => $this->gender,
            'age_id' => $this->ageId,
            'education_id' => $this->educationId,
            'job' => $this->job,
            'service_type_id' => $this->serviceTypeId,
        ];

        $validator = Validator::make($respondentData, [
            'name' => 'required',
            'phone_number' => 'required',
            'gender' => 'required',
            'age_id' => 'required',
            'education_id' => 'required',
            'job' => 'required',
            'service_type_id' => 'required',
        ]);

        if ($validator->fails())
            return $this->dispatch('showError', $validator->errors());

        DB::beginTransaction();
        try {
            $respondent = $this->respondentRepository->addRespondent($respondentData);
            foreach ($this->answers as $answer) {
                $this->respondentAnswerRepository->addRespondentAnswer([
                    'question_id' => $answer['id'],
                    'respondent_id' => $respondent->id,
                    'answer' => $answer['answer']
                ]);
            }
            DB::commit();
            return redirect(route('home'))->with('status', 'Survei berhasil diinput');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect(route('home'))->with('error', 'Survei gagal diinput');
        }
    }

    #[Layout('layouts.landing.app')]
    public function render(): View
    {
        return view('livewire.landing.index');
    }
}
