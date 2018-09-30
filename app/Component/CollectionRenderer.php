<?php

declare(strict_types=1);


namespace App\Component;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Class CollectionRenderer
 * @package App\Component
 */
class CollectionRenderer
{
    /**
     * @var string
     */
    protected $title = 'Table';

    /**
     * @var array
     */
    protected $fields = [];

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var Collection
     */
    protected $items;

    /**
     * CollectionRenderer constructor.
     * @param string $title
     * @param array $fields
     * @param array $options
     */
    public function __construct(
        string $title = '',
        array $fields = [],
        array $options = []
    ) {
        $this->title = $title;
        $this->fields = $fields;
        $this->options = array_replace_recursive(
            config('chiron.collections'),
            $options
        );
    }

    /**
     * @param Collection $items
     */
    public function setCollection(Collection $items)
    {
        $this->items = $items;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        return view('list', [
            'chiron' => $this->toArray($this->items->paginate())
        ]);
    }

    /**
     * @param LengthAwarePaginator $items
     * @return array
     */
    public function toArray(LengthAwarePaginator $items)
    {
        return [
            'title' => $this->title,
            'fields' => $this->fields,
            'options' => $this->options,
            'collections' => $items->toArray(),
            'links' => $items->links('vendor.pagination.bootstrap-4')
        ];
    }
}