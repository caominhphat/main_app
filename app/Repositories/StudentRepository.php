<?php

namespace App\Repositories;

use App\Jobs\uploadFile;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;

class StudentRepository extends ModelRepository
{
    protected DocumentRepository $documentRepository;
    public function __construct(DocumentRepository $documentRepository)
    {
        $this->documentRepository = $documentRepository;
        parent::__construct();
    }

    public function getModel()
    {
        return Student::class;
    }

    public function getRules()
    {
       return [
           'add' => [
               'name' => 'required|max:255',
               'birth_day' => 'required',
           ],
           'edit' => [
               'name' => 'required|max:255',
               'birth_day' => 'required',
           ]
       ];
    }

    public function create($attributes)
    {
        $attributes['birth_day'] = $attributes['birth_day'] ? date('Y-m-d', strtotime($attributes['birth_day'])) : null;
        $item = $this->_model->create($attributes->toArray());
        if($attributes->hasFile('file')) {
            $originalFileName = $attributes->file('file')->getClientOriginalName();
            $fileName = $this->_model->getTable().'-'.$originalFileName.'-'.$item->id;
            Storage::disk('local')->put($fileName, $attributes->file('file')->getContent());
            dispatch(new uploadFile($originalFileName, $fileName, $item, $this->_model->getTable()))->onQueue('student');
        }
        return $item; // TODO: Change the autogenerated stub
    }

    public function resources($id) {
        $result = [
            'validation' => $this->getRules(),
        ];
        if($id) {
            $item = $this->_model->with(['documents'])->find($id);
            $result['object'] = $item;
        }
        return $result;
    }

    public function index($request)
    {
        $option = [
          'with' => 'documents'
        ];
        return $this->getUndeletedItems($request, $option);
    }
}
