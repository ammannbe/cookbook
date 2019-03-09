<?php

namespace App\Policies;

use App\User;
use App\Rating;
use App\Recipe;
use Illuminate\Auth\Access\HandlesAuthorization;

class RatingPolicy
{
    use HandlesAuthorization;

    public function create(User $user, Recipe $recipe) {
        return ! Rating::where(['recipe_id' => $recipe->id, 'user_id' => $user->id])->exists();
    }

    public function update(User $user, Rating $rating) {
        return ($user->id === $rating->user_id);
    }

    public function delete(User $user, Rating $rating) {
        return ($user->id === $rating->user_id);
    }
}