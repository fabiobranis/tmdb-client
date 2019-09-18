<?php


namespace Foundation\Database\Pagination;


use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

/**
 * This trait is used by Eloquent models to build a paginator instance
 * Trait MakePaginator
 * @package Foundation\Database\Pagination
 */
trait MakePaginator
{

    /**
     * Paginate and filter
     * @param PaginatorBuilder $paginatorBuilder
     * @param string $relation
     * @return LengthAwarePaginator
     */
    public static function buildPaginator(PaginatorBuilder $paginatorBuilder, string $relation = null): LengthAwarePaginator
    {
        Paginator::currentPageResolver(function () use ($paginatorBuilder) {
            return $paginatorBuilder->getPage();
        });

        $query = parent::query();
        if ($paginatorBuilder->getFilter()) {
            foreach ($paginatorBuilder->getFieldsToFilter() as $field) {
                $query->where($field, 'like', "%{$paginatorBuilder->getFilter()}%");
            }
        }

        if ($relation) {
            return $query->with($relation)->paginate($paginatorBuilder->getPageLength());
        }
        return $query->paginate($paginatorBuilder->getPageLength());
    }

}