<div>
    {{-- <div class="container"> --}}
        <div class="card card-custom gutter-b shadow-sm">
            <div class="card-header border-0 py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">Gallery</span>
                    {{-- <span class="text-muted mt-3 font-weight-bold font-size-sm">More than 400+ new members</span> --}}
                </h3>
                <div class="card-toolbar">
                    <a href="#" data-toggle="modal"
                    data-target="#addGalleryModal" class="btn btn-info font-weight-bolder font-size-sm">Add Gallery</a>
                </div>
            </div>
            <div class="card-body">
                <div class="spinner-border spinner-border-sm float-right" role="status" wire:loading>
                    <span class="sr-only">{{ __('Loading') }}&hellip;</span>
                </div>
                <p class="card-text">
                    {{ __('List and manage gallery here.') }}
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
                            <th>{{ __('Image') }}</th>
                            <th>{{ __('Status') }}</th>
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
                        @forelse ($galleries as $gallery)
                            <tr>
                                <td>{{ $gallery->id }}</td>
                                <td>
                                    @if ($gallery->image)
                                        <a href="{{ asset('storage/'.$gallery->image) }}" rel="noopener noreferrer" target="_blank">
                                            <figure class="figure">
                                                <img height="150px" src="{{ asset('storage/'.$gallery->image) }}" class="figure-img  rounded" alt="...">
                                            </figure>
                                        </a>
                                    @else
                                        <span class="text-muted">{{ __('None') }}</span>
                                    @endif
                                </td>
                                <td>{{ $gallery->status }}</td>

                                <td>{{ $gallery->created_at ? $gallery->created_at->format('d-m-Y H:i:s'): '' }}</td>
                                <td>

                                    <a class="btn btn-danger btn-sm"
                                        wire:click="deleteId({{ $gallery->id }})"
                                        class="btn btn-danger"
                                        data-toggle="modal"
                                        data-target="#deleteGalleryModal"
                                        >
                                        <i class="fas fa-trash"></i>
                                    </a>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center text-muted" colspan="6">{{ __('Could not find any gallery to show.') }}</td>
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
                {{ __('Showing :from to :to of :total gallery.', ['from' => $galleries->firstItem() ?: 0, 'to' => $galleries->lastItem() ?: 0, 'total' => $galleries->total()]) }}

                @if ($galleries->hasPages())
                {{-- <div class="card-body border-top"> --}}
                    {{ $galleries->onEachSide(1)->links('pagination::bootstrap-4') }}
                {{-- </div> --}}
            @endif
            </div>

            <div wire:ignore.self class="modal fade" id="deleteGalleryModal" tabindex="-1" role="dialog" aria-labelledby="deleteGalleryModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteGalleryModalLabel">Delete Confirm</h5>
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


            <div wire:ignore.self class="modal fade" id="addGalleryModal" tabindex="-1" role="dialog" aria-labelledby="addGalleryModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form wire:submit.prevent='saveGallery()'>
                            <div class="modal-header">
                                <h5 class="modal-title" id="addGalleryModalLabel">Add Gallery</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true close-btn">×</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="form-group row">
                                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="status" wire:model="status" wire:ignore>
                                            <option value="published" >published</option>
                                            <option value="draft" >draft</option>
                                        </select>
                                        @error('status') <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="image" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10" >
                                        <input type="file" class="form-control" id="image" wire:model="image">
                                        @error('image') <span class="text-danger error">{{ $message }}</span>@enderror
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

    @endpush
</div>
