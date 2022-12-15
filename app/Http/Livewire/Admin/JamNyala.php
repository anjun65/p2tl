<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
Use App\Models\JamNyala as JamNyalaModel;

class JamNyala extends Component
{
    public $post;
    public $jam_nyala_showEditModal = false;

    public $tanggal;
    public $jumlah;

    public function mount($post)
    {
        $this->post = JamNyalaModel::where('works_id', $post)->get();
    }

    public function rules() { return [
        'tanggal' => 'required',
        'jumlah' => 'required',
    ]; }

    public function jam_nyala_create()
    {
       $this->jam_nyala_showEditModal = true;
    }

    public function jam_nyala_save()
    {
        $this->validate();

        dd("test");
    }

    public function render()
    {
        return view('livewire.admin.jam-nyala', [
            'items' => $this->post,
        ]);
    }
}
