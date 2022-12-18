<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;

use Livewire\WithFileUploads;


use App\Models\Pelanggaran;
use App\Models\WorkOrder;



class Pelanggarans extends Component
{
    use WithPerPagePagination, WithSorting, WithBulkActions, WithCachedRows;

    use WithFileUploads;

    public $showEditModal = false;
    public $showFilters = false;
    public $filters = [
        'name' => '',
    ];

    public Pelanggaran $editing;

    public $path_ba_pengambilan_bb;
    public $path_ba_serah_terima_bb;
    public $path_image;
    public $path_video;

    protected $queryString = ['sorts'];

    protected $listeners = ['refreshTransactions' => '$refresh'];

    public function rules() { return [
        'editing.works_id' => 'required',
        'path_ba_pengambilan_bb' => 'required',
        'path_ba_serah_terima_bb' => 'nullable',
        'path_image' => 'nullable',
        'path_video' => 'nullable',
    ]; }

    public function mount() { $this->editing = $this->makeBlankTransaction(); }
    public function updatedFilters() { $this->resetPage(); }

    public function makeBlankTransaction()
    {
        return Pelanggaran::make();
    }

    public function toggleShowFilters()
    {
        $this->useCachedRows();

        $this->showFilters = ! $this->showFilters;
    }



    
    public function create()
    {
        $this->useCachedRows();

        if ($this->editing->getKey()) $this->editing = $this->makeBlankTransaction();

        $this->showEditModal = true;
    }

    public function edit(Pelanggaran $transaction)
    {
        $this->useCachedRows();

        if ($this->editing->isNot($transaction)) $this->editing = $transaction;

        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->path_ba_pengambilan_bb){
            $this->editing->path_ba_pengambilan_bb = $this->path_ba_pengambilan_bb->store('assets/ba/pelanggaran/pengambilan','public');
        }

        if ($this->path_ba_serah_terima_bb){
            $this->editing->path_ba_serah_terima_bb = $this->path_ba_serah_terima_bb->store('assets/ba/pelanggaran/serah','public');
        }

        if ($this->path_image){
            $this->editing->path_image = $this->path_image->store('assets/ba/pelanggaran/path_image','public');
        }

        if ($this->path_video){
            $this->editing->path_video = $this->path_video->store('assets/ba/pelanggaran/path_video','public');
        }

        $this->editing->fill([
            'path_ba_pengambilan_bb' => $this->editing->path_ba_pengambilan_bb,
            'path_ba_serah_terima_bb' => $this->editing->path_ba_serah_terima_bb,
            'path_image' => $this->editing->path_image,
            'path_video' => $this->editing->path_video,
        ]);

        $this->editing->save();

        $this->notify('Data telah tersimpan');

        $this->showEditModal = false;
    }

    public function download_ambil($id){
        $item = Pelanggaran::findorFail($id);

        return response()->download(storage_path('app/public/'.$item->path_ba_pengambilan_bb));

    }

    public function download_serahterima($id){
        $item = Pelanggaran::findorFail($id);

        return response()->download(storage_path('app/public/'.$item->path_ba_serah_terima_bb));

    }


    public function download_image($id){
        $item = Pelanggaran::findorFail($id);

        return response()->download(storage_path('app/public/'.$item->patitemh_image));

    }


    public function download_video($id){
        $item = Pelanggaran::findorFail($id);

        return response()->download(storage_path('app/public/'.$item->path_video));

    }


    public function resetFilters() { $this->reset('filters'); }

    public function getRowsQueryProperty()
    {
        $query = Pelanggaran::query()
            ->when($this->filters['name'], fn($query, $name) => $query->where('name', 'like', '%'.$name.'%'));

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    public function render()
    {

        $work_orders= WorkOrder::all();
        
        return view('livewire.admin.pelanggarans', [
            'items' => $this->rows,
            'work_orders' => $work_orders,
        ]);
    }
    
}
