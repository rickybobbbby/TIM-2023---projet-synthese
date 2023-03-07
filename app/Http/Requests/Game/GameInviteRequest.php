<?php

namespace App\Http\Requests\Game;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Game;
use Illuminate\Validation\Rule;

/**
 * @property Game $game
 */
class GameInviteRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'email' => ($this->email !== null) ? strtolower($this->email) : null
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',

                // Cannot be the same email as the game owner
                function ($attribute, $value, $fail) {
                    if ($value === $this->game->owner->email)
                        $fail('You cannot invite yourself to your own game.');
                },

                // The email must not already have been invited
                Rule::unique('game_invitations', 'email')
                    ->where('game_id', $this->game->id),

                // The player must not already be in the game
                function ($attribute, $value, $fail) {
                    if ($this->game->players()->where('email', $value)->exists()) {
                        $fail('You cannot invite a user that is already part of the game.');
                    }
                },
            ],
        ];
    }
}
