<?php

namespace App\Http\Requests\Game;

use App\Models\Game;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property Game $game
 */
class GameUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user() != null
            && $this->user()->can('update', $this->game);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3',
        ];
    }
}
