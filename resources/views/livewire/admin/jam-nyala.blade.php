<div>
    <div class="py-4 space-y-4">

        
        <!-- Top Bar -->
        <div class="flex justify-between">
            <div class="space-x-2 flex items-center">
                <x-input.group borderless paddingless for="perPage" label="Per Page">
                    <x-input.select wire:model="perPage" id="perPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </x-input.select>
                </x-input.group>

                <x-button.primary wire:click="jam_nyala_create"><x-icon.plus/> Jam Nyala Baru</x-button.primary>
            </div>
        </div>

        <!-- Products Table -->
        <div class="flex-col space-y-4">
            <x-table>
                <x-slot name="head">
                    <x-table.heading class="w-full">Tanggal</x-table.heading>
                    <x-table.heading>Jumlah</x-table.heading>
                    
                    <x-table.heading />
                </x-slot>

                <x-slot name="body">

                    @forelse ($items as $item)
                    <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $item->id }}">
                        <x-table.cell class="pr-0">
                            <x-input.checkbox wire:model="selected" value="{{ $item->id }}" />
                        </x-table.cell>

                        <x-table.cell>
                            <span class="text-cool-gray-900 font-medium">{{ $item->tanggal }} </span>
                        </x-table.cell>

                        <x-table.cell>
                            <span class="text-cool-gray-900 font-medium">{{ $item->jumlah }}</span>
                        </x-table.cell>

                        <x-table.cell>
                            <x-button.link wire:click="edit({{ $item->id }})">Edit</x-button.link>
                        </x-table.cell>
                    </x-table.row>
                    @empty
                    <x-table.row>
                        <x-table.cell colspan="8">
                            <div class="flex justify-center items-center space-x-2">
                                <x-icon.inbox class="h-8 w-8 text-cool-gray-400" />
                                <span class="font-medium py-8 text-cool-gray-400 text-xl">Tidak ada jam nyala yang ditemukan...</span>
                            </div>
                        </x-table.cell>
                    </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>

        </div>
    </div>

    <!-- Save Product Modal -->
    <form wire:submit.prevent="jam_nyala_save">
        <x-modal.dialog wire:model.defer="jam_nyala_showEditModal">
            <x-slot name="title">Jam Nyala</x-slot>

            <x-slot name="content">

                <x-input.group for="tanggal" label="Tanggal" :error="$errors->first('editing.tanggal')">
                    <x-.datepicker wire:model="tanggal" placeholder="Tanggal" />
                </x-input.group>

                <x-input.group for="jumlah" label="Jumlah" :error="$errors->first('editing.jumlah')">
                    <x-input.text wire:model="jumlah" placeholder="Jumlah" />
                </x-input.group>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('jam_nyala_showEditModal', false)">Cancel</x-button.secondary>

                <x-button.primary wire:click="jam_nyala_save({{ $jumlah }}, '{{ $tanggal }}')">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>
