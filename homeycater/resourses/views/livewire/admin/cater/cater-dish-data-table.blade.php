<div>
    {{-- <div class="container"> --}}
        <div class="card card-custom gutter-b shadow-sm">
            <div class="card-header border-0 py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">Dishes</span>
                    {{-- <span class="text-muted mt-3 font-weight-bold font-size-sm">More than 400+ new members</span> --}}
                </h3>
                <div class="card-toolbar">
                    <a href="#" data-toggle="modal"
                    data-target="#addModal" class="btn btn-info font-weight-bolder font-size-sm">Add Dishes</a>
                </div>
            </div>
            <div class="card-body">
                <div class="spinner-border spinner-border-sm float-right" role="status" wire:loading>
                    <span class="sr-only">{{ __('Loading') }}&hellip;</span>
                </div>
                <p class="card-text">
                    {{ __('List and manage dishes here.') }}
                    <a href="" wire:click.prevent="filter()">
                        {{ __($filtering ? 'Hide filters?' : 'Show filters?') }}
                    </a>
                </p>
            </div>

            @if ($filtering)
            <div class="card-body border-top">
                <div class="row">

                    <div class="col-sm-6 col-md-4 col-lg-3 ">
                        <div class="form-group mb-0">
                            <label for="filter-length">{{ __('Length') }}</label>
                            <select id="filter-length" class="form-control" wire:model="length">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 offset-md-4 offset-lg-6">
                        <div class="form-group mb-sm-0">
                            <label for="filter-search">{{ __('Search') }}</label>
                            <input id="filter-search" class="form-control" placeholder="{{ __('Enter name or slugs or description or tags') }}&hellip;" wire:model.debounce.500ms="search">
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>{{ __('Dish') }}</th>
                            <th>{{ __('Rate') }}</th>
                            <th>
                                @if (($order['created_at'] ?? null) === 'asc')
                                    <a class="text-body" href="" wire:click.prevent="sort('created_at', 'desc')">{{ __('Created at') }}</a>
                                    <i class="fas fa-sort-amount-down-alt ml-1"></i>
                                @elseif (($order['created_at'] ?? null) === 'desc')
                                    <a class="text-body" href="" wire:click.prevent="sort('created_at', false)">{{ __('Created at') }}</a>
                                    <i class="fas fa-sort-amount-down ml-1"></i>
                                @else
                                    <a class="text-body" href="" wire:click.prevent="sort('created_at', 'asc')">{{ __('Created at') }}</a>
                                @endif
                            </th>
                            <th>Actions </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($dishes as $dish)
                            <tr>
                                <td>{{ $dish->id }}</td>
                                <td>{{ $dish->dish->name }}</td>
                                <td>{{ $dish->rate }}</td>

                                <td>{{ $dish->created_at ? $dish->created_at->format('d-m-Y H:i:s'): '' }}</td>
                                <td>

                                    <a class="btn btn-danger btn-sm"
                                        wire:click="deleteId({{ $dish->id }})"
                                        class="btn btn-danger"
                                        data-toggle="modal"
                                        data-target="#deleteModal"
                                        >
                                        <i class="fas fa-trash"></i>
                                    </a>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center text-muted" colspan="6">{{ __('Could not find any food categories to show.') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- @if ($foodCategories->hasPages())
                <div class="card-body border-top">
                    {{ $foodCategories->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            @endif --}}
            <div class="card-body border-top d-flex justify-content-between">
                {{ __('Showing :from to :to of :total Food Categories.', ['from' => $dishes->firstItem() ?: 0, 'to' => $dishes->lastItem() ?: 0, 'total' => $dishes->total()]) }}

                @if ($dishes->hasPages())
                {{-- <div class="card-body border-top"> --}}
                    {{ $dishes->onEachSide(1)->links('pagination::bootstrap-4') }}
                {{-- </div> --}}
            @endif
            </div>

            <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Confirm</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true close-btn">×</span>
                            </button>
                        </div>
                       <div class="modal-body">
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                            <button type="button" wire:click.prevent="destroy()" class="btn btn-danger close-modal" data-dismiss="modal">Yes, Delete</button>
                        </div>
                    </div>
                </div>
            </div>


            <div wire:ignore.self class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form wire:submit.prevent='saveDish()'>
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLabel">Add Menu</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true close-btn">×</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="form-group row">
                                    <label for="dishes" class="col-sm-2 col-form-label">Dishes</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="dishes" wire:model="userDish" wire:ignore>
                                            @forelse ($foodDishes as $foodDish)
                                                <option value="{{ $foodDish->id }}">{{ $foodDish->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                        @error('userDish') <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="rate" class="col-sm-2 col-form-label">Rate</label>
                                    <div class="col-sm-10" >
                                        <input type="text" class="form-control" id="rate" wire:model="rate">
                                        @error('rate') <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info" >Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    {{-- </div> --}}

    @push('sjs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" ></script>
    <script>

        // document.addEventListener('livewire:load', function () {
            // $('#dishes').select2({
            //     placeholder: 'Select a dish',
            //     minimumResultsForSearch: -1
            // });
        // });
        // $('#dishes').on('select2:select', (e) => {
        //     @this.emit('userMenusSelected', $('#dishes').select2('val'));
        // });

        // $('#dishes').val(@this.get('userMenus')).trigger('change');

    </script>

@endpush
</div>
