<?php

namespace App\Repositories;

use App\Models\CashTransaction;
use Illuminate\Support\Collection as SupportCollection;

class CashTransactionRepository
{
    public function __construct(
        private CashTransaction $model
    ) {
    }

    /**
     * Retrieve cash transaction counts grouped by year.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCountsPerYear(): SupportCollection
    {
        return $this->model->selectRaw('EXTRACT(YEAR FROM date_paid) AS year, COUNT(*) AS count')
            ->groupBy('year')
            ->get()
            ->pluck('count', 'year');
    }

    /**
     * Retrieve cash transaction counts for a specific year grouped by month.
     *
     * @param int $year
     * @return \Illuminate\Support\Collection
     */
    public function getCountsSpecificYear(int $year): SupportCollection
    {
        return $this->model->selectRaw('EXTRACT(MONTH FROM date_paid) AS month, COUNT(*) AS count')
            ->whereYear('date_paid', $year)
            ->groupBy('month')
            ->get()
            ->pluck('count', 'month');
    }

    /**
     * Retrieve the total sum of amounts paid for each year.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getTotalAmountsPerYear(): SupportCollection
    {
        return $this->model->selectRaw('EXTRACT(YEAR FROM date_paid) AS year, SUM(amount) AS amount')
            ->groupBy('year')
            ->orderBy('year')
            ->get()
            ->pluck('amount', 'year');
    }

    /**
     * Get the total amount paid each month for a specific year.
     *
     * @param int $year
     * @return \Illuminate\Support\Collection
     */
    public function getTotalAmountsSpecificYear(int $year): SupportCollection
    {
        return $this->model->selectRaw('EXTRACT(MONTH FROM date_paid) AS month, SUM(amount) AS amount')
            ->whereYear('date_paid', $year)
            ->groupBy('month')
            ->get()
            ->pluck('amount', 'month');
    }
}
