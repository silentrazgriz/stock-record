<?php

namespace App\Http\Controllers;

use App\Data\Quote\QuoteRepository;
use App\Lists\QuoteList;
use Illuminate\Http\Request;

/**
 * Class QuoteController
 * @package App\Http\Controllers
 */
class QuoteController extends Controller
{
    /**
     * @var QuoteRepository
     */
    private $quoteRepository;

    /**
     * QuoteController constructor.
     * @param QuoteRepository $quoteRepository
     */
    public function __construct(
        QuoteRepository $quoteRepository
    ) {
        $this->quoteRepository = $quoteRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $list = new QuoteList();
        $list->setCollection($this->quoteRepository->all());

        return $list->render();
    }
}
