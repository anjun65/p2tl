<div>
    <div class="py-4 space-y-4">

        
        <!-- Top Bar -->
        <div class="flex justify-between">
            <div class="w-2/4 flex space-x-4">
                <x-input.text wire:model="filters.name" placeholder="Search ..." />
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
                    <x-table.heading sortable multi-column wire:click="sortBy('works_id')" :direction="$sorts['works_id'] ?? null">Work Order</x-table.heading>
                    <x-table.heading>BA Pengambilan BB</x-table.heading>
                    <x-table.heading>BA Serah Terima BB</x-table.heading>
                    <x-table.heading>Image</x-table.heading>
                    <x-table.heading>Video</x-table.heading>
                    <x-table.heading>Status</x-table.heading>
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
                            <span class="text-gray-900 font-medium">{{ $item->work->nama_pelanggan }}</span>
                        </x-table.cell>

                            <x-table.cell>
                                <span class="text-cool-gray-900 font-medium">
                                @if ( $item->path_ba_pengambilan_bb)
                                    <x-jet-button wire:click="download_ambil({{ $item->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 pr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                        </svg>
                                        Download
                                    </x-jet-button>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-red-700 w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Belum terupload
                                @endif
                                </span>
                            </x-table.cell>


                            <x-table.cell>
                                <span class="text-cool-gray-900 font-medium">
                                @if ( $item->path_ba_serah_terima_bb)
                                    <x-jet-button wire:click="download_serahterima({{ $item->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 pr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                        </svg>
                                        Download
                                    </x-jet-button>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-red-700 w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Belum terupload
                                @endif
                                </span>
                            </x-table.cell>

                            <x-table.cell>
                                <span class="text-cool-gray-900 font-medium">
                                @if ( $item->path_image)
                                    <x-jet-button wire:click="download_image({{ $item->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 pr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                        </svg>
                                        Download
                                    </x-jet-button>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-red-700 w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Belum terupload
                                @endif
                                </span>
                            </x-table.cell>

                            <x-table.cell>
                                <span class="text-cool-gray-900 font-medium">
                                @if ( $item->path_video)
                                    <x-jet-button wire:click="download_video({{ $item->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 pr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                        </svg>
                                        Download
                                    </x-jet-button>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-red-700 w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Belum terupload
                                @endif
                                </span>
                            </x-table.cell>
                        
                            <x-table.cell>
                                <span class="text-gray-900 font-medium">{{ $item->status }}</span>
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
                                <span class="font-medium py-8 text-gray-400 text-xl">Tidak ada pelanggaran yang ditemukan...</span>
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
            <x-slot name="title">Pelanggaran</x-slot>

            <x-slot name="content">
                <x-input.group for="works_id" label="Work Order" :error="$errors->first('editing.works_id')">
                    <x-input.select wire:model="editing.works_id" id="works_id">
                        <option value="">Pilih Work Order</option>
                        @forelse ($work_orders as $work)
                            <option value="{{ $work->id }}">{{ $work->id_pelanggan }} | {{ $work->nama_pelanggan }}</option>
                        @empty
                            <option value="">Tidak ada work order</option>
                        @endforelse
                    </x-input.select>
                </x-input.group>
                
                {{-- <x-input.group label="Upload BA Pengambilan BB" for="path_ba_pengambilan_bb" :error="$errors->first('path_ba_pengambilan_bb')">
                    <x-input.file-upload wire:model="path_ba_pengambilan_bb" id="path_ba_pengambilan_bb" accept="image/png, image/jpeg, application/pdf">
                            @if ($path_ba_pengambilan_bb)
                                {{ $path_ba_pengambilan_bb->getClientOriginalName() }}
                            @endif
                    </x-input.file-upload>
                </x-input.group>

                <x-input.group label="Upload BA Serah Terima BB" for="path_ba_serah_terima_bb" :error="$errors->first('path_ba_serah_terima_bb')">
                    <x-input.file-upload wire:model="path_ba_serah_terima_bb" id="path_ba_serah_terima_bb" accept="image/png, image/jpeg, application/pdf">
                            @if ($path_ba_serah_terima_bb)
                                {{ $path_ba_serah_terima_bb->getClientOriginalName() }}
                            @endif
                    </x-input.file-upload>
                </x-input.group>

                <x-input.group label="Upload Gambar" for="path_image" :error="$errors->first('path_image')">
                    <x-input.file-upload wire:model="path_image" id="path_image" accept="image/png, image/jpeg, application/pdf">
                            @if ($path_image)
                                {{ $path_image->getClientOriginalName() }}
                            @endif
                    </x-input.file-upload>
                </x-input.group>

                <x-input.group label="Upload Video" for="path_video" :error="$errors->first('path_video')">
                    <x-input.file-upload wire:model="path_video" id="path_video" accept="video/mp4,video/x-m4v,video/*">
                            @if ($path_video)
                                {{ $path_video->getClientOriginalName() }}
                            @endif
                    </x-input.file-upload>
                </x-input.group>

                <x-input.group label="Upload Video" for="path_video" :error="$errors->first('path_video')">
                    <x-input.file-upload wire:model="path_video" id="path_video" accept="video/mp4,video/x-m4v,video/*">
                            @if ($path_video)
                                {{ $path_video->getClientOriginalName() }}
                            @endif
                    </x-input.file-upload>
                </x-input.group> --}}

                <x-input.group for="status" label="Status" :error="$errors->first('editing.status')">
                    <x-input.select wire:model="editing.status" id="status">
                        <option value="">Pilih Status</option>
                        @forelse ($statuses as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @empty
                            <option value="">Tidak ada status yang diset</option>
                        @endforelse
                    </x-input.select>
                </x-input.group>

            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>

                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>


    <form wire:submit.prevent="jam_nyala_save">
        <x-modal.dialog wire:model.defer="jam_nyala_showEditModal">
            <x-slot name="title">Jam Nyala</x-slot>

            <x-slot name="content">

                <x-input.group for="tanggal" label="Tanggal" :error="$errors->first('editing.tanggal')">
                    <x-.datepicker wire:model="nyala_model.tanggal" placeholder="Tanggal" />
                </x-input.group>

                <x-input.group for="jumlah" label="Jumlah" :error="$errors->first('editing.jumlah')">
                    <x-input.text wire:model="nyala_model.jumlah" placeholder="Jumlah" />
                </x-input.group>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('jam_nyala_showEditModal', false)">Cancel</x-button.secondary>

                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>
