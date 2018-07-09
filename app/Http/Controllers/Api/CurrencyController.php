<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CurrencyRepositoryInterface;
use App\Services\CurrencyPresenter;

class CurrencyController extends Controller
{
    /**
     * @param CurrencyRepositoryInterface $currencyRepository
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(CurrencyRepositoryInterface $currencyRepository)
    {
        $activeCurrencies = $currencyRepository->findActive();
        $currencies = [];
        foreach ($activeCurrencies as $currency) {
            $currencies[] = CurrencyPresenter::present($currency);
        }

        return response()->json($currencies);
    }

    /**
     * @param CurrencyRepositoryInterface $currencyRepository
     * @param                             $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(CurrencyRepositoryInterface $currencyRepository, int $id)
    {
        $currency = $currencyRepository->findById($id);
        if ($currency === null) {
            return response()->json(['message' => 'The currency was not found'], 404);
        }

        return response()->json(CurrencyPresenter::present($currency));
    }
}
