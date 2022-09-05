<div>
    <div class="col-12">
        <div class="card">
            <div class="card-header border-bottom">
                <div class="d-flex">
                    <div class="mb-0">
                        <div>
                            <span class="badge bg-success text-lg">{{ $count }}</span> <span class="align-middle fs-4">Registered Dogs</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form  class=" needs-validation" novalidate>
                    <div class="row d-flex mb-3">
                        <div class="col-md-12 d-flex gap-2 flex-wrap">
                            <div><a wire:ignore  href="{{ route('coAdminDogs.create') }}" class="btn btn-md btn-success btn-sm-block"><i class="align-middle me-2" data-feather="folder-plus"></i>Register Dogs</a></div>
                            @if($allDogs != null)
                                @if(!$allDogs->isEmpty())
                                    <div>
                                        <button wire:click="export" wire:loading.attr="disabled" type="button" class="btn btn-md btn-info"><i class="align-middle me-1 fa-solid fa-circle-down"></i>
                                            <span wire:loading.remove wire:target="export">Export</span>
                                            <span wire:loading wire:target="export">Exporting..</span>
                                        </button></div>
                                    <div class="d-flex ms-auto">
                                        <input id="customSearch" type="search" class="form-control mr-2" placeholder="Search">
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </form>

                <div wire:init="dogs">
                    <table id="dogsTable" class="table table-responsive table-striped" style="width:100%">
                        <thead style="background: #CFCFCF; ">
                        <tr>
                            <th>ID Number</th>
                            <th>Image</th>
                            <th>Date Registered</th>
                            <th>Dog Name</th>
                            <th>Owner's Name</th>
                            <th>Contact Number</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allDogs as $dog)
                            <tr>
                                <td>{{ $dog->id_number }}</td>

                                @if($dog->dog_image === null)
                                    <td><img class="img-fluid" src="{{ asset('./storage/logo/dog-placeholder.jpg') }}" style="width: 50px; border-radius: 10px; height: 50px;"></td>
                                @else
                                    <td><img src="{{ asset('/storage/'. $dog->dog_image)  }}"  style="width: 50px; border-radius: 10px; height: 50px;"></td>
                                @endif
                                <td>{{ Carbon\Carbon::parse($dog->created_at)->toFormattedDateString() }}</td>
                                <td>{{ $dog->dog_name}}</td>
                                <td>{{ $dog->owner_name }}</td>
                                <td>{{ $dog->contact_number }}</td>
                                <td>{{ $dog->barangay->barangay_name }}</td>
                                <td>
                                    <a href="{{ url('co-admin/dog/edit/'. $dog->id) }}" class="btn btn-sm btn-info">View</a>
                                    <button wire:click="confirmDelete({{ $dog->id }})" class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
