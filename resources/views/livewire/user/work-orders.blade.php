<div>
    <div class="py-4 space-y-4">

        
        <!-- Top Bar -->
        <div class="flex justify-between">
            <div class="w-2/4 flex space-x-4">
                <x-input.text wire:model="filters.name" placeholder="Serach Invitation..." />
            </div>

            <div class="space-x-2 flex items-center">
                <x-input.group borderless paddingless for="perPage" label="Per Page">
                    <x-input.select wire:model="perPage" id="perPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </x-input.select>
                </x-input.group>

                <x-dropdown label="Bulk Actions">

                    <x-dropdown.item type="button" wire:click="$toggle('showDeleteModal')" class="flex items-center space-x-2">
                        <x-icon.trash class="text-cool-gray-400"/> <span>Delete</span>
                    </x-dropdown.item>
                </x-dropdown>

                <x-button.primary wire:click="create"><x-icon.plus/> New</x-button.primary>
            </div>
        </div>

        <!-- Products Table -->
        <div class="flex-col space-y-4">
            <x-table>
                <x-slot name="head">
                    <x-table.heading class="pr-0 w-8">
                        <x-input.checkbox wire:model="selectPage" />
                    </x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('id_pelanggan')" :direction="$sorts['id_pelanggan'] ?? null" class="w-full">ID Pelanggan</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('nama_pelanggan')" :direction="$sorts['nama_pelanggan'] ?? null">Nama Pelanggan</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('alamat')" :direction="$sorts['alamat'] ?? null">Alamat</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('tarif')" :direction="$sorts['tarif'] ?? null">Tarif</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('daya')" :direction="$sorts['daya'] ?? null">Daya</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('rbm')" :direction="$sorts['rbm'] ?? null">RBM</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('lgkh')" :direction="$sorts['lgkh'] ?? null">LGKH</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('fkm')" :direction="$sorts['fkm'] ?? null">FKM</x-table.heading>
                    <x-table.heading>Regu</x-table.heading>
                    <x-table.heading>Keterangan</x-table.heading>
                    <x-table.heading />
                </x-slot>

                <x-slot name="body">
                    @if ($selectPage)
                    <x-table.row class="bg-cool-gray-200" wire:key="row-message">
                        <x-table.cell colspan="6">
                            @unless ($selectAll)
                            <div>
                                <span>You have selected <strong>{{ $items->count() }}</strong> data, do you want to select all <strong>{{ $items->total() }}</strong>?</span>
                                <x-button.link wire:click="selectAll" class="ml-1 text-blue-600">Select All</x-button.link>
                            </div>
                            @else
                            <span>You are currently selecting all <strong>{{ $items->total() }}</strong> data.</span>
                            @endif
                        </x-table.cell>
                    </x-table.row>
                    @endif

                    @forelse ($items as $item)
                    <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $item->id }}">
                        <x-table.cell class="pr-0">
                            <x-input.checkbox wire:model="selected" value="{{ $item->id }}" />
                        </x-table.cell>

                        <x-table.cell>
                            <span class="text-gray-900 font-medium">{{ $item->id_pelanggan }} </span>
                        </x-table.cell>

                        <x-table.cell>
                            <span class="text-gray-900 font-medium">{{ $item->nama_pelanggan }} </span>
                        </x-table.cell>

                        <x-table.cell>
                            <span class="text-gray-900 font-medium">
                                {{ $item->alamat }} <br/>

                                {{ $item->latitude}},{{ $item->longitude}}
                            </span>
                        </x-table.cell>

                        <x-table.cell>
                            <span class="text-gray-900 font-medium">{{ $item->tarif }}</span>
                        </x-table.cell>
                        
                        <x-table.cell>
                            <span class="text-gray-900 font-medium">{{ $item->daya }}</span>
                        </x-table.cell>
                        <x-table.cell>
                            <span class="text-gray-900 font-medium">{{ $item->rbm }}</span>
                        </x-table.cell>
                        <x-table.cell>
                            <span class="text-gray-900 font-medium">{{ $item->lgkh }}</span>
                        </x-table.cell>
                        <x-table.cell>
                            <span class="text-gray-900 font-medium">{{ $item->fkm }}</span>
                        </x-table.cell>

                        <x-table.cell>
                            <span class="text-cool-gray-900 font-medium">
                                {{ $item->regu->nama_regu }}
                            </span>
                        </x-table.cell>

                        <x-table.cell>
                            <span class="text-gray-900 font-medium">{{ $item->keterangan_p2tl }}</span>
                        </x-table.cell>

                        <x-table.cell>
                            <x-button.link wire:click="edit({{ $item->id }})">Edit</x-button.link>
                        </x-table.cell>
                    </x-table.row>
                    @empty
                    <x-table.row>
                        <x-table.cell colspan="12">
                            <div class="flex justify-center items-center space-x-2">
                                <x-icon.inbox class="h-8 w-8 text-gray-400" />
                                <span class="font-medium py-8 text-gray-400 text-xl">No Work Order found...</span>
                            </div>
                        </x-table.cell>
                    </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>

            <div>
                {{ $items->links() }}
            </div>
        </div>
    </div>

    <!-- Save Product Modal -->
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model.defer="showEditModal">
            <x-slot name="title">Work Order</x-slot>
            
            <x-slot name="content">
                Jam Nyala <br/>
                <x-table>
                    <x-slot name="head">
                        <x-table.heading>Tanggal</x-table.heading>
                        <x-table.heading>Jumlah</x-table.heading>
                        <x-table.heading />
                    </x-slot>

                    <x-slot name="body">
                        @forelse ($jam_nyala as $nyala)
                        <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $nyala->id }}">
                            {{-- <x-table.cell class="pr-0">
                                <x-input.checkbox wire:model="selected" value="{{ $nyala->id }}" />
                            </x-table.cell> --}}

                            <x-table.cell>
                                @php
                                    $sebut = Illuminate\Support\Carbon::parse($nyala->tanggal)->format('F');
                                @endphp
                                <span class="text-gray-900 font-medium">{{ $sebut }} </span>
                            </x-table.cell>

                            <x-table.cell>
                                <span class="text-gray-900 font-medium">{{ $nyala->jumlah }} </span>
                            </x-table.cell>
                        </x-table.row>
                        @empty
                        <x-table.row>
                            <x-table.cell colspan="12">
                                <div class="flex justify-center items-center space-x-2">
                                    <x-icon.inbox class="h-8 w-8 text-gray-400" />
                                    <span class="font-medium py-8 text-gray-400 text-xl">Tidak ada jam nyala yang ditemukan...</span>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                        @endforelse
                    </x-slot>
                </x-table>

                <x-input.group for="keterangan_p2tl" label="Keterangan" :error="$errors->first('editing.keterangan_p2tl')">
                    <x-input.select wire:model="editing.keterangan_p2tl" id="keterangan_p2tl">
                        <option value="">Pilih keterangan</option>
                        @forelse ($keterangan as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @empty
                            <option value="">No Roles Exist</option>
                        @endforelse
                    </x-input.select>
                </x-input.group>

                @if ($editing->keterangan_p2tl == 'BA')
                    <x-input.group label="Upload Ba" for="upload_ba" :error="$errors->first('upload_ba')">
                        <x-input.file-upload wire:model="upload_ba" id="upload_ba" accept="application/pdf">
                                @if ($upload_ba)
                                    {{ $upload_ba->getClientOriginalName() }}
                                @endif
                        </x-input.file-upload>
                    </x-input.group>
                    
                    @if (!empty($this->editing->ba_pemeriksaan->path_ba_pemeriksaan))
                    <x-input.group label="Upload Ba" for="upload_ba" :error="$errors->first('upload_ba')">
                            <x-jet-button wire:click="download_berita_acara({{ $editing->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 pr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg> 
                                Download Berita Acara
                            </x-jet-button>
                        </span>
                    </x-input.group>
                    @endif
                @endif
                
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>

                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>
