<?php

namespace App\Services;

class CurrencyRepository implements CurrencyRepositoryInterface
{
    private $currencies;

    /**
     * @param Currency[]
     */
    public function __construct(array $currencies)
    {
        $this->currencies = $currencies;
    }

    public function findAll(): array
    {
        return $this->currencies;
    }

    public function findActive(): array
    {
        return array_filter($this->currencies, function ($currency) {
            /** @var $currency Currency */
            return $currency->isActive();
        });
    }

    public function findById(int $id): ?Currency
    {
        foreach ($this->currencies as $currency) {
            if ($currency->getId() === $id) {
                return $currency;
            }
        }

        return null;
    }

    public function save(Currency $currency): void
    {
        if ($this->findById($currency->getId()) === null) {
            $this->currencies[] = $currency;
        } else {
            $index = $this->findCurrencyIndex($currency);
            if ($index !== null) {
                $this->currencies[$index] = $currency;
            }
        }
    }

    public function delete(Currency $currency): void
    {
        foreach ($this->currencies as $key => $actualCurrency) {
            if ($actualCurrency->getId() === $currency->getId()) {
                unset($this->currencies[$key]);
                break;
            }
        }
    }

    public function findAvailableId(): int
    {
        for ($id = 1; $id <= $this->getCurrenciesCount(); $id++) {
            if ($this->findById($id) === null) {
                return $id;
            }
        }

        return $id;
    }

    private function findCurrencyIndex(Currency $currency): ?int
    {
        foreach ($this->currencies as $index => $actualCurrency) {
            if ($actualCurrency->getId() === $currency->getId()) {
                return $index;
            }
        }

        return null;
    }

    private function getCurrenciesCount(): int
    {
        return \count($this->currencies);
    }
}
