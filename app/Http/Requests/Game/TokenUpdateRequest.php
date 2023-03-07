<?php

namespace App\Http\Requests\Game;

use App\Models\Game;
use App\Models\Token;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property Game $game
 * @property Token $token
 */
class TokenUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->token);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'file' => 'sometimes|image|mimes:jpg,bmp,png',
            'name' => 'sometimes|string|min:3',
            'user_id' => [
                'sometimes',

                // The user ID must be in the player list
                function ($attribute, $value, $fail) {
                    if (!$this->game->players()->where('id', $value)->exists())
                        $fail('That user is not part of the game.');
                }
            ],
        ];
    }
}
