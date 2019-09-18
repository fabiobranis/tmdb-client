<?php


namespace Foundation\Database\Pagination;

/**
 * A simple builder for pagination
 * Class PaginatorBuilder
 * @package Foundation\Database\Pagination
 */
class PaginatorBuilder
{

    /**
     * @var int
     */
    private $page = 1;

    /**
     * @var int
     */
    private $pageLength = 10;

    /**
     * @var string
     */
    private $filter;

    /**
     * @var array
     */
    private $fieldsToFilter = [];

    /**
     * @var string
     */
    private $orderBy;

    /**
     * @var bool
     */
    private $desc;

    /**
     * PaginatorBuilder constructor.
     * @param array|null $args
     */
    public function __construct(array $args = null)
    {

        if ($args) {
            $this->page = $args['page'] ?? 1;
            $this->pageLength = $args['page_length'] ?? 10;
            $this->filter = $args['filter'] ?? null;
            $this->orderBy = $args['order_by'] ?? 'id';
            $descending = isset($args['order']) ? $args['order'] === 'desc' : false;
            $this->desc = $descending;
        }
    }


    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getPageLength(): int
    {
        return $this->pageLength;
    }

    /**
     * @param int $pageLength
     */
    public function setPageLength(int $pageLength): void
    {
        $this->pageLength = $pageLength;
    }

    /**
     * @return string
     */
    public function getFilter(): ?string
    {
        return $this->filter;
    }

    /**
     * @param string $filter
     */
    public function setFilter(string $filter): void
    {
        $this->filter = $filter;
    }

    /**
     * @return array
     */
    public function getFieldsToFilter(): ?array
    {
        return $this->fieldsToFilter;
    }

    /**
     * @param array $fieldsToFilter
     */
    public function setFieldsToFilter(array $fieldsToFilter): void
    {
        $this->fieldsToFilter = $fieldsToFilter;
    }

    /**
     * @return string
     */
    public function getOrderBy(): ?string
    {
        return $this->orderBy;
    }

    /**
     * @param string $orderBy
     */
    public function setOrderBy(string $orderBy): void
    {
        $this->orderBy = $orderBy;
    }

    /**
     * @return bool
     */
    public function isDesc(): ?bool
    {
        return $this->desc;
    }

    /**
     * @param bool $desc
     */
    public function setDesc(bool $desc): void
    {
        $this->desc = $desc;
    }

}