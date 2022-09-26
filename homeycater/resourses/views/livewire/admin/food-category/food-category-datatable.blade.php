<div>
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="spinner-border spinner-border-sm float-right" role="status" wire:loading>
                    <span class="sr-only">{{ __('Loading') }}&hellip;</span>
                </div>
                <h5 class="card-title text-primary">
                    {{ __('Food Categories') }}
                </h5>
                <p class="card-text">
                    {{ __('List and manage food categories here.') }}
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
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Image') }}</th>
                            <th>{{ __('Slug') }}</th>
                            <th>{{ __('Description') }}</th>
                            <th>{{ __('Tags') }}</th>

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
                        @forelse ($foodCategories as $foodCategory)
                            <tr>
                                <td>{{ $foodCategory->id }}</td>
                                <td>{{ $foodCategory->name }}</td>
                                <td>
                                    @if ($foodCategory->image)
                                        <a href="{{ asset('storage/'.$foodCategory->image) }}" rel="noopener noreferrer" target="_blank">
                                            <figure class="figure">
                                                <img height="50px" src="{{ asset('storage/'.$foodCategory->image) }}" class="figure-img  rounded" alt="...">

                                            </figure>
                                        </a>
                                    @else
                                        <span class="text-muted">{{ __('None') }}</span>
                                    @endif
                                </td>
                                <td>{{ $foodCategory->slug }}</td>
                                <td>{{ $foodCategory->description }}</td>
                                <td>{{ $foodCategory->tags }}</td>

                                <td>{{ $foodCategory->created_at ? $foodCategory->created_at->format('d-m-Y H:i:s'): '' }}</td>
                                <td>
                                    {{-- <a class="btn btn-outline-dark btn-sm" href="{{ route('admin.dashboard', $foodCategory) }}">
                                        <i class="fas fa-eye"></i>
                                    </a> --}}
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.food.category.update', $foodCategory) }}">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a class="btn btn-danger btn-sm"
                                        wire:click.prevent="deleteId({{ $foodCategory->id }})"
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
                {{ __('Showing :from to :to of :total Contact.', ['from' => $foodCategories->firstItem() ?: 0, 'to' => $foodCategories->lastItem() ?: 0, 'total' => $foodCategories->total()]) }}

                @if ($foodCategories->hasPages())
                {{-- <div class="card-body border-top"> --}}
                    {{ $foodCategories->links('pagination::bootstrap-4') }}
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
        </div>
    </div>
</div>
