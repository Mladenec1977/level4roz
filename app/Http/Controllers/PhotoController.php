<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $img = $request->file('image')->store('uploads', 'public');
        $newPeopleFilms = Photo::create([
            'people_id' => $id,
            'name_photos' => $img
        ]);
        return redirect()->route('photoList', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedRows = Photo::find($id);
        $people_id = $deletedRows->people_id;
        $deletedRows->delete();

        return redirect()->route('photoList', $people_id);
    }
}
