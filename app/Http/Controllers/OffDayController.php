<?php

namespace App\Http\Controllers;

use App\Data\OffDay\OffDayRepository;
use App\Forms\OffDay\CreateOffDayForm;
use App\Forms\OffDay\UpdateOffDayForm;
use App\Lists\OffDayList;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class OffDayController
 * @package App\Http\Controllers
 */
class OffDayController extends Controller
{
    /**
     * @var OffDayRepository
     */
    private $offDayRepository;

    /**
     * OffDayController constructor.
     * @param OffDayRepository $offDayRepository
     */
    public function __construct(
        OffDayRepository $offDayRepository
    ) {
        $this->offDayRepository = $offDayRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $list = new OffDayList();
        $list->setCollection($this->offDayRepository->all());

        return $list->render();
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $createForm = new CreateOffDayForm();
        return $createForm->render();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $dates = explode(' to ', $request->get('off_date'));

        $current = Carbon::parse($dates[0]);
        $last = Carbon::parse($dates[1]);
        while($current->toDateString() != $last->toDateString()) {
            if ($current->isWeekday()) {
                $this->offDayRepository->create(['off_date' => $current->toDateString()]);
            }
            $current->addDay();
        }

        return redirect()->route('off-days.index');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $updateForm = new UpdateOffDayForm($id);
        $updateForm->setDefaultValues($this->offDayRepository->findById($id)->toArray());
        return $updateForm->render();
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->offDayRepository->update($id, $request->all());
        return redirect()->route('off-days.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->offDayRepository->destroy($id);
        return redirect()->route('off-days.index');
    }
}
