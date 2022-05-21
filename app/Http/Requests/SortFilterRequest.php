<?php

namespace App\Http\Requests;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class SortFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'sort' => [
                'array:name,email'
            ],
            'sort.name' => [
                'string',
                Rule::in(['asc', 'desc'])
            ],
            'sort.email' => [
                'string',
                Rule::in(['asc', 'desc'])
            ],
            'filter' => [
                'array',
            ],
            'filter.model' => [
                'array',
                'min:1'
            ],
            'filter.model.*' => [
                'array',
                'min:1',
                'required_array_keys:param,value'
            ],
            'filter.model.*.param' => [
                Rule::in((new User)->getFillable()),
            ],
            'filter.model.*.value' => [
                'sometimes',
            ],
            'filter.relations' => [
                'array',
                'min:1'
            ],
            'filter.relations.roles' => [
                'array',
            ],
            'filter.relations.roles.*' => [
                'array',
                'required_array_keys:param,value'
            ],
            'filter.relations.roles.*.param' => [
                Rule::in((new Role)->getFillable()),
                'required_with:filter.relations.roles.param',
            ],
            'filter.relations.roles.*.value' => [
                'sometimes'
            ],
            'filter.relations.roles.*.pivot' => [
                'array',
                'min:1'
            ],
            'filter.relations.roles.*.pivot.*' => [
                'array',
                'required_array_keys:param,value'
            ],
            'filter.relations.roles.*.pivot.*.param' => [
                Rule::in(Schema::getColumnListing('role_user'))
            ],
            'filter.relations.roles.*.pivot.*.value' => [
                'sometimes'
            ],
        ];
    }
}
