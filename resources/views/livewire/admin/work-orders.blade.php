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
                    <x-table.heading>Users</x-table.heading>
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
                            <span class="text-gray-900 font-medium">{{ $item->alamat }}</span>
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
                            @php
                                $arr_users = explode(",",$item->users_id);
                            @endphp
                            <span class="text-cool-gray-900 font-medium">
                            @foreach ($arr_users as $user )
                                @php $new_user = App\Models\User::where('id',$user)->first() @endphp
                                <li>
                                    {{ $new_user->name }}
                                </li>
                            @endforeach
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
                <x-input.group for="id_pelanggan" label="ID Pelanggan" :error="$errors->first('editing.id_pelanggan')">
                    <x-input.text wire:model="editing.id_pelanggan" id="id_pelanggan" placeholder="ID Pelanggan" />
                </x-input.group>

                <x-input.group for="nama_pelanggan" label="Nama Pelanggan" :error="$errors->first('editing.nama_pelanggan')">
                    <x-input.text wire:model="editing.nama_pelanggan" id="nama_pelanggan" placeholder="Nama Pelanggan" />
                </x-input.group>

                <x-input.group for="alamat" label="Alamat" :error="$errors->first('editing.alamat')">
                    <x-input.text wire:model="editing.alamat" id="alamat" placeholder="Alamat" />
                </x-input.group>

                <x-input.group for="latitude" label="Latitude" :error="$errors->first('editing.latitude')">
                    <x-input.text wire:model="editing.latitude" id="latitude" placeholder="Latitude" />
                </x-input.group>

                <x-input.group for="longitude" label="Longitude" :error="$errors->first('editing.longitude')">
                    <x-input.text wire:model="editing.longitude" id="longitude" placeholder="Longitude" />
                </x-input.group>

                <x-input.group for="tarif" label="Tarif" :error="$errors->first('editing.tarif')">
                    <x-input.text wire:model="editing.tarif" id="tarif" placeholder="Tarif" />
                </x-input.group>

                <x-input.group for="daya" label="Daya" :error="$errors->first('editing.daya')">
                    <x-input.text type="number" wire:model="editing.daya" id="daya" placeholder="Daya" />
                </x-input.group>

                <x-input.group for="rbm" label="RBM" :error="$errors->first('editing.rbm')">
                    <x-input.text type="number" wire:model="editing.rbm" id="rbm" placeholder="RBM" />
                </x-input.group>

                <x-input.group for="lgkh" label="LGKH" :error="$errors->first('editing.lgkh')">
                    <x-input.text type="number" wire:model="editing.lgkh" id="lgkh" placeholder="LGKH" />
                </x-input.group>

                <x-input.group for="fkm" label="FKM" :error="$errors->first('editing.fkm')">
                    <x-input.text type="number" wire:model="editing.fkm" id="fkm" placeholder="FKM" />
                </x-input.group>

                <x-input.group for="users_id" label="FKM" :error="$errors->first('editing.fkm')">
                        <x-input.select multiple wire:model="editing.users_id" id="users_id">
                            <option value="">Pilih Peserta</option>
                            @forelse ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @empty
                                <option value="">No Roles Exist</option>
                            @endforelse
                        </x-input.select>
                </x-input.group>

                

                <x-input.group for="keterangan_p2tl" label="Keterangan" :error="$errors->first('editing.keterangan_p2tl')">
                    <textarea id="keterangan_p2tl" rows="3" wire:model="editing.keterangan_p2tl" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Keterangan"></textarea>
                </x-input.group>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>

                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>
