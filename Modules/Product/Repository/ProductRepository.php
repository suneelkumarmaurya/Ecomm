<?php

namespace Modules\Product\Repository;

use Illuminate\Support\Arr;
use Modules\Core\Repositories\Repository;
use Modules\Product\Models\Product;

class ProductRepository extends Repository
{
    public $model = Product::class;

    /**
     * @param  $id
     * @param  array  $data
     *
     * @return mixed
     */
    public function update($id, array $data): mixed
    {
        $item = $this->findById($id);
        $item->fill($data);
        $item->save();

        return $item->fresh();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function findById($id): mixed
    {
        return $this->model::with('brand', 'categories', 'carts', 'condition', 'sizes', 'tags')->find($id);
    }

    const DEFAULT_ORDER_BY = 'id';
    const DEFAULT_SORT = 'desc';

    protected function withRelations()
    {
        return ['brand', 'categories', 'carts', 'condition', 'sizes', 'tags'];
    }

    public function search(array $data): mixed
    {
        $query = $this->model::query();

        $searchableFields = ['title', 'summary', 'description', 'color', 'stock', 'brand_id', 'price', 'discount', 'status'];
        foreach ($searchableFields as $field) {
            if (Arr::has($data, $field)) {
                $query->where($field, 'like', '%' . Arr::get($data, $field) . '%');
            }
        }

        if (Arr::has($data, 'all_included') && (bool)Arr::get($data, 'all_included') === true || empty($data)) {
            return $query->with($this->withRelations())->get();
        }

        $query->orderBy(Arr::get($data, 'order_by') ?? self::DEFAULT_ORDER_BY, Arr::get($data, 'sort') ?? self::DEFAULT_SORT);

        return $query->with($this->withRelations())->paginate(
            Arr::get($data, 'per_page') ?? (new $this->model)->getPerPage()
        );
    }

}
