<?php

declare(strict_types=1);

namespace App\Request;

use Hyperf\Validation\Request\FormRequest;
use Hyperf\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * @var string[]
     */
    protected $scenes = [
        'store' => ['name', 'email', 'password', 'assets'],
        'update' => ['name', 'password', 'assets', 'id'],
    ];

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer',
            'name' => 'required|max:20',
            'email' => [
                'required', 'email', 'email', 'max:32',
            ],
            'password' => 'required',
            'assets' => 'required|integer',
        ];
    }
}
