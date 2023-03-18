<div class="mt-8 min-h-screen" x-data="{
    selectedColumns: @entangle('selectedColumns').defer,
    columns: @entangle('columns').defer,
    hasColumn(column) {
        var columns = this.selectedColumns;
        var column = columns.find(e => {
            return e.toLowerCase() === column.toLowerCase()
        })
        return column != undefined;
    }
}">
    <div class="flex justify-between">
        <div class="text-2xl">Users</div>
        <button type="submit" wire:click="$emitTo('live-items-child', 'showCreateForm');" class="text-blue-500">
            <x-tall-crud-icon-add />
        </button>
    </div>

    <div class="mt-6">
        <div class="flex justify-between">
            <div class="flex">
                <x-tall-crud-input-search />
            </div>
            <div class="flex">

                <x-tall-crud-columns-dropdown />
                <x-tall-crud-page-dropdown />
            </div>
        </div>
        <table class="w-full whitespace-no-wrap mt-4 shadow-2xl text-xs" wire:loading.class.delay="opacity-50">
            <thead>
                <tr class="text-left font-bold bg-blue-400">
                    <td class="px-3 py-2" x-show="hasColumn('Id')">
                        <div class="flex items-center">
                            <button wire:click="sortBy('id')">Id</button>
                            <x-tall-crud-sort-icon sortField="id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </td>
                    <td class="px-3 py-2" x-show="hasColumn('Name')">
                        <div class="flex items-center">
                            <button wire:click="sortBy('name')">Name</button>
                            <x-tall-crud-sort-icon sortField="name" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </td>
                    <td class="px-3 py-2" x-show="hasColumn('Email')">Email</td>
                    <td class="px-3 py-2" x-show="hasColumn('Password')">Password</td>
                    <td class="px-3 py-2" x-show="hasColumn('Profile Photo Path')">Profile Photo Path</td>
                    <td class="px-3 py-2" x-show="hasColumn('Is Active')">
                        <div class="flex items-center">
                            <button wire:click="sortBy('is_active')">Is Active</button>
                            <x-tall-crud-sort-icon sortField="is_active" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </td>
                    <td class="px-3 py-2">Actions</td>
                </tr>
            </thead>
            <tbody class="divide-y divide-blue-400">
                @foreach($results as $result)
                <tr class="hover:bg-blue-300 {{ ($loop->even ) ? "bg-blue-100" : ""}}">
                    <td class="px-3 py-2" x-show="hasColumn('Id')">{{ $result->id }}</td>
                    <td class="px-3 py-2" x-show="hasColumn('Name')">{{ $result->name }}</td>
                    <td class="px-3 py-2" x-show="hasColumn('Email')">{{ $result->email }}</td>
                    <td class="px-3 py-2" x-show="hasColumn('Password')">{{ $result->password }}</td>
                    <td class="px-3 py-2" x-show="hasColumn('Profile Photo Path')">{{ $result->profile_photo_path }}</td>
                    <td class="px-3 py-2" x-show="hasColumn('Is Active')">{{ $result->is_active }}</td>
                    <td class="px-3 py-2">
                        <button type="submit" wire:click="$emitTo('live-items-child', 'showEditForm', {{ $result->id}});" class="text-green-500">
                            <x-tall-crud-icon-edit />
                        </button>
                        <button type="submit" wire:click="$emitTo('live-items-child', 'showDeleteForm', {{ $result->id}});" class="text-red-500">
                            <x-tall-crud-icon-delete />
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $results->links() }}
    </div>
    @livewire('live-items-child')
    @livewire('livewire-toast')
</div>