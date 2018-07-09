<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\Currency;
use App\Services\CurrencyPresenter;
use App\Services\CurrencyRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    private $currencyRepository;

    /**
     * CurrencyController constructor.
     * @param CurrencyRepositoryInterface $currencyRepository
     */
    public function __construct(CurrencyRepositoryInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $allCurrencies = $this->currencyRepository->findAll();
        $currencies = [];
        foreach ($allCurrencies as $currency) {
            $currencies[] = CurrencyPresenter::present($currency);
        }

        return response()->json($currencies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        if ($request->isMethod('post'))
        $currency = new Currency(
            $this->currencyRepository->findAvailableId(),
            $request->input('name'),
            $request->input('short_name'),
            $request->input('actual_course'),
            \DateTime::createFromFormat('Y-m-d H-i-s', $request->input('actual_course_date')),
            $request->input('active')
        );

        $this->currencyRepository->save($currency);
        return response()->json(CurrencyPresenter::present($currency));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $currency = $this->currencyRepository->findById($id);
        if ($currency === null) {
            return response()->json(['message' => 'The currency was not found'], 404);
        }

        return response()->json(CurrencyPresenter::present($currency));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $currency = $this->currencyRepository->findById($id);
        if ($currency === null) {
            return response()->json(['message' => 'The currency was not found'], 404);
        }

        foreach ($request->all() as $field) {
            switch ($field) {
                case $request->input('name'):
                    $currency->setName($request->input('name'));
                    break;

                case $request->input('short_name'):
                    $currency->setShortName($request->input('short_name'));
                    break;

                case $request->input('actual_course'):
                    $currency->setActualCourse($request->input('actual_course'));
                    break;

                case $request->input('actual_course_date'):
                    $currency->setActualCourseDate(\DateTime::createFromFormat('Y-m-d H-i-s', $request->input('actual_course_date')));
                    break;

                case $request->input('active'):
                    $currency->setActive($request->input('active'));
                    break;

                default:
                    break;
            }
        }

        $this->currencyRepository->save($currency);
        return response()->json(CurrencyPresenter::present($currency));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currency = $this->currencyRepository->findById($id);
        if ($currency === null) {
            return response()->json(['message' => 'The currency was not found'], 404);
        }

        $this->currencyRepository->delete($currency);
    }
}
