<?php

namespace App\QueryBuilders;

use App\Http\Requests\TransactionHistoryGetRequest;
use App\Models\TransactionHistory;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

final class TransactionHistoryBuilder extends Builder
{
    /**
     * Current HTTP Request object.
     *
     * @var NewsGetRequest
     */
    protected $request;

    /**
     * TagBuilder constructor.
     *
     * @param TagGetRequest $request
     */
    public function __construct(TransactionHistoryGetRequest $request)
    {
        $this->request = $request;
        $this->builder = QueryBuilder::for (TransactionHistory::class, $request);
    }

    /**
     * Get a list of allowed columns that can be selected.
     *
     * @return string[]
     */
    protected function getAllowedFields(): array
    {
        return [
            'id', 'user_id'
            , 'transaction_type',
        ];
    }

    /**
     * Get a list of allowed columns that can be selected.
     *
     * @return string[]
     */
    protected function getAllowedFilters(): array
    {
        return [
            AllowedFilter::exact('id'), 'user_id', 'transaction_type',
        ];
    }

    /**
     * Get a list of allowed columns that can be selected.
     *
     * @return string[]
     */
    protected function getAllowedIncludes(): array
    {
        return [
            'user',
        ];
    }
    /**
     * Get a list of allowed columns that can be selected.
     *
     * @return string[]
     */
    protected function getAllowedSearch(): array
    {
        return [];
    }

    /**
     * Get a list of allowed columns that can be selected.
     *
     * @return string[]
     */
    protected function getAllowedSorts(): array
    {
        return ['id', 'user_id', 'transaction_type', 'created_at', 'value'];
    }

    /**
     * Get a list of allowed columns that can be appended.
     *
     * @return string[]
     */
    protected function allowedAppends(): array
    {
        return [];
    }

    /**
     * Get the default sort column that will be used in any sort operation.
     *
     * @return string
     */
    protected function getDefaultSort(): string
    {
        return 'id';
    }

    /**
     * Get the paginated results of current API get request.
     *
     * @return LengthAwarePaginator
     */
    public function paginate(): LengthAwarePaginator
    {
        $user = Auth::user();
        return $this->query()
            ->where('user_id', $user->id)
            ->jsonPaginate();
    }

    /**
     * Find the cms admin model based on the given id number.
     *
     * @param mixed $key
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return mixed
     */
    public function find($key)
    {
        $user = Auth::user();
        return $this->query()->where('user_id', $user->id)->find($key);
    }
}
