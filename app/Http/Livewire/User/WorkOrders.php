<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Models\BeritaAcara;
use App\Models\Regu;
use App\Models\WorkOrder;
use App\Models\User;
use Livewire\WithFileUploads;
use App\Models\JamNyala;

class WorkOrders extends Component
{
    use WithPerPagePagination, WithSorting, WithBulkActions, WithCachedRows;

    use WithFileUploads;
    public $showEditModal = false;
    public $showFilters = false;
    public $filters = [
        'name' => '',
    ];

    public $upload_ba;
    public $upload_image;
    public $upload_video;
    public WorkOrder $editing;

    protected $queryString = ['sorts'];

    protected $listeners = ['refreshTransactions' => '$refresh'];

    public function rules() { return [
        'editing.keterangan_p2tl' => 'nullable',
    ]; }

    public function mount() { $this->editing = $this->makeBlankTransaction(); }
    public function updatedFilters() { $this->resetPage(); }

    public function makeBlankTransaction()
    {
        return WorkOrder::make();
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

    public function edit(WorkOrder $transaction)
    {
        $this->useCachedRows();

        if ($this->editing->isNot($transaction)) $this->editing = $transaction;

        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();

        // $new_users = $this->editing->users_id;
        
        // $this->editing->users_id = implode(",", $this->editing->users_id);

        if($this->upload_ba){
            BeritaAcara::create([
                'works_id' => $this->editing->id,
                'path_ba_pemeriksaan'  => $this->upload_ba->store('assets/ba_pemeriksaan','public'),
            ]);
        }

        if($this->upload_image){
            $this->editing->fill([
                'path_image' => $this->upload_image->store('assets/image','public'),
            ]);
        }

        if($this->upload_video){
            $this->editing->fill([
                'path_video' => $this->upload_video->store('assets/video','public'),
            ]);
        }
        
        $this->editing->save();

        

        $this->notify('Data telah tersimpan');

        $this->showEditModal = false;
    }

    public function resetFilters() { $this->reset('filters'); }

    public function getRowsQueryProperty()
    {
        $query = WorkOrder::query()
            ->when($this->filters['name'], fn($query, $name) => $query->where('name', 'like', '%'.$name.'%'));

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }


    public function download_berita_acara($id){
        $berkas = BeritaAcara::where('works_id', $id)->first();

        return response()->download(storage_path('app/public/'.$berkas->path_ba_pemeriksaan)); 
    }

    public function download_image($id){
        $berkas = WorkOrder::find($id);

        return response()->download(storage_path('app/public/'.$berkas->path_image)); 
    }

    public function download_video($id){
        $berkas = WorkOrder::find($id);

        return response()->download(storage_path('app/public/'.$berkas->path_video)); 
    }

    public function render()
    {
        $regus = Regu::all();
        $keterangan = WorkOrder::Keterangan;

        $jam_nyala = array();

        if($this->editing->id){
            $jam_nyala = JamNyala::where('works_id', $this->editing->id)->get();
        }

        return view('livewire.user.work-orders', [
            'items' => $this->rows,
            'keterangan' => $keterangan,
            'jam_nyala' => $jam_nyala,
        ]);
    }
}
