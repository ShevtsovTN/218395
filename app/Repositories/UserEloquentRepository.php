<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryContract;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class UserEloquentRepository implements UserRepositoryContract
{
    public Builder $query;

    public function __construct()
    {
        $this->query = User::query();
    }

    public function model(): User
    {
        return new User;
    }

    public function getUsers(array $data): Collection|array
    {
        if (!empty($data['sort'])) {
            $this->orderByAttributes($data['sort']);
        }
        if (!empty($data['filter'])) {
            $this->filterByAttributes($data['filter']);
        }
        return $this->query->get();
    }

    public function filterByAttributes(array $data): Builder
    {
        $whereParam = [];
        if (!empty($data['model'])) {
            foreach ($data['model'] as $datum) {
                if ($datum['param'] == 'from_data') {
                    $whereParam[] = ['created_at', '>=', Carbon::make($datum['value'])];
                } elseif ($datum['param'] == 'to_data') {
                    $whereParam[] = ['created_at', '<=', Carbon::make($datum['value'])];
                } else {
                    $whereParam[] = [$datum['param'], $datum['value']];
                }
            }
            $this->query = $this->query->where($whereParam) ;
        }
        if (!empty($data['relations'])) {
            foreach ($data['relations'] as $relationName => $relationData) {
                if (isset($this->model()->$relationName)) {
                    $this->query = $this->query->whereHas($relationName, function (Builder $q) use ($relationData) {
                        foreach ($relationData as $relationDatum) {
                            if (isset($relationDatum['param']) && !empty($relationDatum['value'])) {
                                $q->where($relationDatum['param'], $relationDatum['value']);
                            }
                            if (isset($relationDatum['pivot'])) {
                                foreach ($relationDatum['pivot'] as $item) {
                                    $q = $q->where($item['param'], $item['value']);
                                }
                            }
                        }
                    });
                }
            }
        }

        return $this->query;
    }

    public function orderByAttributes(array $data): Builder
    {
        if (!empty($data)) {
            foreach ($data as $index => $datum) {
                $this->query = $this->query->orderBy($index, mb_strtoupper($datum));
            }
        }
        return $this->query;
    }
}
