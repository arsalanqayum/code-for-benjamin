<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
		$dt = new Carbon();
		$before = $dt->subYears(13)->format('Y-m-d');
		
        $user = $request->user();

        $this->validate($request, [
            'nickname' => 'required|max:155|unique:users,nickname,'.$user->id,
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
			'date_of_birth' => 'required|date|before:'.$before,
            'city' => 'sometimes|nullable',
            'state' => 'sometimes|nullable',
            'postal_or_zip_code' => 'sometimes|nullable',
            'country' => 'sometimes|nullable',
            'timezone' => 'sometimes|nullable',
        ]);

        return tap($user)->update($request->only('nickname', 'name', 'email', 'date_of_birth', 'city', 'state', 'postal_or_zip_code', 'country', 'timezone'));
    }
}
