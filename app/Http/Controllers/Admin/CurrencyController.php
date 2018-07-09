<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CurrencyPresenter;
use App\Services\CurrencyRepositoryInterface;
use Illuminate\Http\JsonResponse;

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
        $activeCurrencies = $this->currencyRepository->findActive();
        $currencies = [];
        foreach ($activeCurrencies as $currency) {
            $currencies[] = CurrencyPresenter::present($currency);
        }

        return response()->json($currencies);
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

}
